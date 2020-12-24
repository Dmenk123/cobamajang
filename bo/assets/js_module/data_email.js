var save_method;
var table;

$(document).ready(function() {
    table = $('#tabel_email').DataTable({
        // destroy: true,
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: true,
        ajax: {
            url  : base_url + "data_email/list_email",
            type : "POST"
        },
        //set column definition initialisation properties
        columnDefs: [
            {
                targets: [-1], //last column
                orderable: false, //set not orderable
            },
        ],
    });    

    $('#pesan_email').ckeditor();

    //force integer input in textfield
    $('input.numberinput').bind('keypress', function (e) {
        return (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57) && e.which != 46) ? false : true;
    });

});	

function kirim_email(){
    var form = $('#form_email')[0];
    var data = new FormData(form);
    var value = CKEDITOR.instances['pesan_email'].getData()
    data.append('pesan_email', value);

    $("#btn_email").prop("disabled", true);
    $('#btn_email').text('Menyimpan Data'); //change button text
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: base_url + 'data_email/kirim_email_manual',
        data: data,
        dataType: "JSON",
        processData: false, // false, it prevent jQuery form transforming the data into a query string
        contentType: false, 
        cache: false,
        timeout: 600000,
        success: function (data) {
            if(data.status) {
                swal.fire("Sukses!!", "Konfirmasi Berhasil", "success");         
                window.location = base_url+"data_email";
            }else {
                if(data.err){
                    swal.fire("Gagal!!", "Terjadi Kesalahan", "warning");
                }else{
                    for (var i = 0; i < data.inputerror.length; i++) 
                    {
                        //ikut style global
                        $('[name="'+data.inputerror[i]+'"]').next().text(data.error_string[i]).addClass('invalid-feedback-select');
                    }
                }
                
                $("#btn_email").prop("disabled", false);
                $('#btn_email').text('Kirim Email');
            }
        },
        error: function (e) {
            console.log("ERROR : ", e);
            $("#btn_email").prop("disabled", false);
            $('#btn_email').text('Kirim Email');

            reset_modal_form();
            $(".modal").modal('hide');
        }
    });
}
