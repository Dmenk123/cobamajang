var save_method;
var table;

$(document).ready(function() {
    filter_tabel();
    filter_tabel_selesai();
    $('#pesan_email').ckeditor();

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

   	
    $("#foto").change(function() {
        readURL(this);
    });

    //change menu status
    $(document).on('click', '.btn_edit_status', function(){
        var id = $(this).attr('id');
        var status = $(this).val();
        swalConfirm.fire({
            title: 'Ubah Status Data User ?',
            text: "Apakah Anda Yakin ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Ya, Ubah Status!',
            cancelButtonText: 'Tidak, Batalkan!',
            reverseButtons: true
          }).then((result) => {
            if (result.value) {
                $.ajax({
                    url : base_url + 'master_user/edit_status_user/'+ id,
                    type: "POST",
                    dataType: "JSON",
                    data : {status : status},
                    success: function(data)
                    {
                        swalConfirm.fire('Berhasil Ubah Status User!', data.pesan, 'success');
                        table.ajax.reload();
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        Swal.fire('Terjadi Kesalahan');
                    }
                });
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
              swalConfirm.fire(
                'Dibatalkan',
                'Aksi Dibatalakan',
                'error'
              )
            }
        });
    });

    $(".modal").on("hidden.bs.modal", function(){
        reset_modal_form();
        reset_modal_form_import();
    });
});	

 //datatables
function filter_tabel() {
    var tgl_awal = $('#tgl_filter_mulai').val();
    var tgl_akhir = $('#tgl_filter_akhir').val();
    var status = $('#status_filter').val();
    
    table = $('#tabel_confirm_jual').DataTable({
        destroy: true,
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ajax: {
            url  : base_url + "confirm_jual/list_penjualan",
            type : "POST",
            data : {tgl_awal:tgl_awal, tgl_akhir:tgl_akhir, status:status},
            dataType : 'JSON',
        },
        //set column definition initialisation properties
        columnDefs: [
            {
                targets: [-1], //last column
                orderable: false, //set not orderable
            },
        ],
    });    
}

function filter_tabel_selesai() {
    var tgl_awal = $('#tgl_filter_mulai').val();
    var tgl_akhir = $('#tgl_filter_akhir').val();
    var status = $('#status_filter').val();
    
    table = $('#tabel_confirm_jual_selesai').DataTable({
        destroy: true,
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ajax: {
            url  : base_url + "penjualan_selesai/list_penjualan",
            type : "POST",
            data : {tgl_awal:tgl_awal, tgl_akhir:tgl_akhir, status:status},
            dataType : 'JSON',
        },
        //set column definition initialisation properties
        columnDefs: [
            {
                targets: [-1], //last column
                orderable: false, //set not orderable
            },
        ],
    });    
}

function add_menu()
{
    reset_modal_form();
    save_method = 'add';
	$('#modal_user_form').modal('show');
	$('#modal_title').text('Tambah User Baru'); 
}

function edit_user(id)
{
    reset_modal_form();
    save_method = 'update';
    //Ajax Load data from ajax
    $.ajax({
        url : base_url + 'master_user/edit_user',
        type: "POST",
        dataType: "JSON",
        data : {id:id},
        success: function(data)
        {
            // data.data_menu.forEach(function(dataLoop) {
            //     $("#parent_menu").append('<option value = '+dataLoop.id+' class="append-opt">'+dataLoop.nama+'</option>');
            // });
            $('#div_pass_lama').css("display","block");
            $('#div_preview_foto').css("display","block");
            $('#div_skip_password').css("display", "block");
            $('[name="id_user"]').val(data.old_data.id);
            $('[name="username"]').val(data.old_data.username).attr('disabled', true);
            $('[name="role"]').val(data.old_data.id_role);
            $('[name="status"]').val(data.old_data.status);
            // $("#pegawai").val(data.old_data.id_pegawai).trigger("change");
            $('#preview_img').attr('src', 'data:image/jpeg;base64,'+data.foto_encoded);
            $('#modal_user_form').modal('show');
	        $('#modal_title').text('Edit User'); 

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            alert('Error get data from ajax');
        }
    });
}

function reload_table()
{
    table.ajax.reload(null,false); //reload datatable ajax 
}

function konfirmasi_penjualan(){
    var form = $('#form-konfirmasi')[0];
    var data = new FormData(form);
    var value = CKEDITOR.instances['pesan_email'].getData()
    data.append('pesan_email', value);

    $("#btn_confirm").prop("disabled", true);
    $('#btn_confirm').text('Menyimpan Data'); //change button text
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url + 'confirm_jual/konfirmasi_penjualan',
        data: data,
        dataType: "JSON",
        processData: false, // false, it prevent jQuery form transforming the data into a query string
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (data) {
            if(data.status) {
                swal.fire("Sukses!!", "Konfirmasi Berhasil", "success");
                $("#btn_confirm").prop("disabled", false);
                $('#btn_confirm').text('Konfirmasi');                
                window.location = base_url+"confirm_jual";
            }else {
                if(data.err){
                    swal.fire("Gagal!!", "Terjadi Kesalahan", "warning");
                }else{
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        //ikut style global
                        $('[name="'+data.inputerror[i]+'"]').next().next().text(data.error_string[i]).addClass('invalid-feedback-select');
                    }
                }
                
                $("#btn_confirm").prop("disabled", false);
                $('#btn_confirm').text('Konfirmasi');
            }
        },
        error: function (e) {
            console.log("ERROR : ", e);
            $("#btn_confirm").prop("disabled", false);
            $('#btn_confirm').text('Konfirmasi');

            reset_modal_form();
            $(".modal").modal('hide');
        }
    });
}


function reset_modal_form()
{
    $('#form-user')[0].reset();
    $('.append-opt').remove(); 
    $('div.form-group').children().removeClass("is-invalid invalid-feedback");
    $('span.help-block').text('');
    $('#div_pass_lama').css("display","none");
    $('#div_preview_foto').css("display","none");
    $('#div_skip_password').css("display", "none");
    $('#label_foto').text('Pilih gambar yang akan diupload');
    $('#username').attr('disabled', false);
}

function readURL(input) {
    if (input.files && input.files[0]) {
      var reader = new FileReader();
      reader.onload = function(e) {
        $('#div_preview_foto').css("display","block");
        $('#preview_img').attr('src', e.target.result);
      }
      reader.readAsDataURL(input.files[0]);
    } else {
        $('#div_preview_foto').css("display","none");
        $('#preview_img').attr('src', '');
    }
}

function update_trans(order_id){
    swalConfirmDelete.fire({
        title: 'Ubah Ingin Mengupdate Data ?',
        text: "Apakah Anda Yakin ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, !',
        cancelButtonText: 'Tidak, !',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + '../transaction/status',
                type: "POST",
                dataType: "JSON",
                data : {order_id : order_id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil !', data.pesan, 'success');
                    table.ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    Swal.fire('Terjadi Kesalahan');
                }
            });
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalConfirm.fire(
            'Dibatalkan',
            'Aksi Dibatalakan',
            'error'
          )
        }
    });
}

function set_failure(id){
    swalConfirmDelete.fire({
        title: 'Set Ke Failure ?',
        text: "Data Akan Diset ke Failure ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Lakukan !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'confirm_jual/set_failure',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil !', 'Berhasil Set Failure', 'success');
                    table.ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    Swal.fire('Terjadi Kesalahan');
                }
            });
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalConfirm.fire(
            'Dibatalkan',
            'Aksi Dibatalakan',
            'error'
          )
        }
    });
}

function batalkan_transaksi(id){
    swalConfirmDelete.fire({
        title: 'Batalkan Transaksi ?',
        text: "Transaksi Member akan dibatalkan, dan member akan di nonaktifkan ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Lakukan !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'penjualan_selesai/batalkan_transaksi',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil !', 'Transaksi Berhasil Dibatalkan', 'success');
                    table.ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    Swal.fire('Terjadi Kesalahan');
                }
            });
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalConfirm.fire(
            'Dibatalkan',
            'Aksi Dibatalakan',
            'error'
          )
        }
    });
}

function kembalikan_transaksi(id){
    swalConfirmDelete.fire({
        title: 'Kembalikan Transaksi ?',
        text: "Data akan di kembalikan ke tahap awal ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Ya, Lakukan !',
        cancelButtonText: 'Tidak, Batalkan!',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {
            $.ajax({
                url : base_url + 'confirm_jual/kembalikan_transaksi',
                type: "POST",
                dataType: "JSON",
                data : {id:id},
                success: function(data)
                {
                    swalConfirm.fire('Berhasil !', 'Berhasil Set Failure', 'success');
                    table.ajax.reload();
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    Swal.fire('Terjadi Kesalahan');
                }
            });
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {
          swalConfirm.fire(
            'Dibatalkan',
            'Aksi Dibatalakan',
            'error'
          )
        }
    });
}