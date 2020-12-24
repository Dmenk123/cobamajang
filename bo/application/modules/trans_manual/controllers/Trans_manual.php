<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Trans_manual extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}
		$this->load->model('m_global');
		$this->load->model('master_user/m_user');
		$this->load->model('t_checkout');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Data Transaksi Manual',
			'data_user' => $data_user,
		);

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => 'modal_trans_manual',
			'js'	=> 'trans_manual.js',
			'view'	=> 'view_trans_manual'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_transaksi()
	{
		$list = $this->t_checkout->get_datatable_trans_manual();
		$data = array();
		// $no =$_POST['start'];
		foreach ($list as $val) {
			// $no++;
			$row = array();
			//loop value tabel db
			$row[] = '<div class="kt-widget__media"><img src="'.'../'.$val->path_thumb.'"/></div>';
			$row[] = $val->created_at;
			$row[] = $val->order_id;
			$row[] = $val->email;
			$row[] = $val->nama;
			$row[] = $val->telp;
			$row[] = $val->keterangan;
			$row[] = $val->harga;
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="edit_trans(\''.$val->id.'\')">
							<i class="la la-pencil"></i> Edit
						</button>
						<button class="dropdown-item" onclick="delete_trans(\''.$val->id.'\')">
							<i class="la la-trash"></i> Hapus
						</button>
			';

			$str_aksi .= '</div></div>';
			$row[] = $str_aksi;

			$data[] = $row;
		}//end loop

		$output = [
			// "draw" => $_POST['draw'],
			// "recordsTotal" => $this->m_talent->count_all(),
			// "recordsFiltered" => $this->m_talent->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function get_data_harga()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');

		$jenis = $this->input->get('jenis');
		if($jenis == 'reg') {
			$harga = $this->m_global->single_row('*',['id_talent' => 1, 'jenis_harga' => 1, 'deleted_at' => null], 't_harga', NULL);
		}else{
			$harga = $this->m_global->single_row('*',['id_talent' => 1, 'jenis_harga' => 2, 'deleted_at' => null], 't_harga', NULL);
		}

		if($harga->is_diskon) {
			// cek tanggal
			$tgl_mulai_diskon = $obj_date->createFromFormat('Y-m-d H:i:s', $harga->tgl_mulai_diskon.' 00:00:00')->format('Y-m-d H:i:s');
			$tgl_akhir_diskon = $obj_date->createFromFormat('Y-m-d H:i:s', $harga->tgl_akhir_diskon.' 00:00:00')->format('Y-m-d H:i:s');
			$diskon = $this->m_global->single_row('*', ['id' => $harga->id_m_diskon], 'm_diskon');
			//jika harga normal (timestamp > tgl_akhir diskon)
			if(strtotime($timestamp) > strtotime($tgl_akhir_diskon)) {
				$harga_fix = (float)$harga->nilai_harga;
			}else{
				//cek apakah sudah masuk tgl diskon ?
				if(strtotime($timestamp) >= strtotime($tgl_mulai_diskon)) {
					$harga_fix = (float)$harga->nilai_harga - ((float)$harga->nilai_harga * (float)$diskon->besaran / 100);
				}
				// jika belum berarti harganya masih normal
				else{
					$harga_fix = (float)$harga->nilai_harga;
				}
			}
		}else{
			$harga_fix = (float)$harga->nilai_harga;
		}

		echo json_encode($harga_fix);
	}

	public function add_data_trans()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$nama = trim($this->input->post('nama'));
		$email = trim($this->input->post('email'));
		$telp = trim($this->input->post('telp'));
		$jenis = trim($this->input->post('jenis'));
		$bayar = trim($this->input->post('bayar'));
		$alamat = trim($this->input->post('alamat'));

		$id = $this->t_checkout->get_max_id();
		$namafileseo = $this->seoUrl($nama.' '.time());

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();
		
		$file_mimes = ['image/png', 'image/x-citrix-png', 'image/x-png', 'image/x-citrix-jpeg', 'image/jpeg', 'image/pjpeg'];

		if(isset($_FILES['foto']['name']) && in_array($_FILES['foto']['type'], $file_mimes)) {
						
			if (!file_exists('../files/img/bukti_bayar')) {
				mkdir('../files/img/bukti_bayar', 0777, true);
			}

			$this->konfigurasi_upload_img($namafileseo);
			//get detail extension
			$pathDet = $_FILES['foto']['name'];
			$extDet = pathinfo($pathDet, PATHINFO_EXTENSION);
			
			if ($this->file_obj->do_upload('foto')) 
			{
				$gbrBukti = $this->file_obj->data();
				$nama_file_foto = $gbrBukti['file_name'];
				$resize = $this->konfigurasi_image_resize($nama_file_foto);
				$output_thumb = $this->konfigurasi_image_thumb($nama_file_foto, $gbrBukti);
				$this->image_lib->clear();
				## replace nama file + ext
				$namafileseo = $namafileseo.'.'.$extDet;
			} else {
				$error = array('error' => $this->file_obj->display_errors());
			}
		}else{
			$data['inputerror'][] = 'foto';
			$data['error_string'][] = 'Wajib Mengisi Foto';
			$data['status'] = FALSE;
			echo json_encode($data);
			return;
		}

		if($jenis == 'reg'){
			$keterangan = 'reguler';
		}else{
			$keterangan = 'eksklusif';
		}
		
		$data_trans = [
			'id' => $id,
			'nama' => $nama,
			'email' => $email,
			'telp' => $telp,
			'keterangan' => $keterangan,
			'harga' => (float)$bayar,
			'harga_bruto' => (float)$bayar,
			'order_id' => $this->generate_order_id_manual(),
			'alamat' => $alamat,
			'created_at' => $timestamp,
			'path_file'	=> 'files/img/bukti_bayar/'.$namafileseo,
			'path_thumb' => 'files/img/bukti_bayar/thumbs/'.$output_thumb,
			'is_manual' => 1,
		];
		
		$insert = $this->t_checkout->save($data_trans);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan transaksi';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan transaksi';
		}

		echo json_encode($retval);
	}

	private function generate_order_id_manual() {

		$chars = array(
			'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm',
			'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z',
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
			'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
			'0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
		);
	
		shuffle($chars);
	
		$num_chars = count($chars) - 1;
		$token = '';
	
		for ($i = 0; $i < 8; $i++){ // <-- $num_chars instead of $len
			$token .= $chars[mt_rand(0, $num_chars)];
		}
	
		return 'MT-'.$token;
	}

	public function edit_trans()
	{
		$this->load->library('Enkripsi');
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);
	
		$id = $this->input->post('id');
		$oldData = $this->t_checkout->get_by_id($id);
		
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}

		if($oldData->keterangan == 'reguler'){
			$val_jenis = 'reg';
		}else{
			$val_jenis = 'vip';
		}
		
		$url_foto = '../'.$oldData->path_file;
		$foto = base64_encode(file_get_contents($url_foto));  
		
		$data = array(
			'data_user' => $data_user,
			'old_data'	=> $oldData,
			'foto_encoded' => $foto,
			'val_jenis' => $val_jenis
		);
		
		echo json_encode($data);
	}
	//////////////////////////////////////////////////////////////

	

	public function update_data_trans()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		
		$id = trim($this->input->post('id_checkout'));
		$nama = trim($this->input->post('nama'));
		$email = trim($this->input->post('email'));
		$telp = trim($this->input->post('telp'));
		$jenis = trim($this->input->post('jenis'));
		$bayar = trim($this->input->post('bayar'));
		$alamat = trim($this->input->post('alamat'));
		$namafileseo = $this->seoUrl($nama.' '.time());
		$arr_valid = $this->rule_validasi();
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();

		$file_mimes = ['image/png', 'image/x-citrix-png', 'image/x-png', 'image/x-citrix-jpeg', 'image/jpeg', 'image/pjpeg'];

		if(isset($_FILES['foto']['name']) && in_array($_FILES['foto']['type'], $file_mimes)) {
			$this->konfigurasi_upload_img($namafileseo);
			//get detail extension
			$pathDet = $_FILES['foto']['name'];
			$extDet = pathinfo($pathDet, PATHINFO_EXTENSION);
			
			if ($this->file_obj->do_upload('foto')) 
			{
				$gbrBukti = $this->file_obj->data();
				$nama_file_foto = $gbrBukti['file_name'];
				$resize = $this->konfigurasi_image_resize($nama_file_foto);
				$output_thumb = $this->konfigurasi_image_thumb($nama_file_foto, $gbrBukti);
				$this->image_lib->clear();
				## replace nama file + ext
				$namafileseo = $namafileseo.'.'.$extDet;
				$foto = $namafileseo;
			} else {
				$error = array('error' => $this->file_obj->display_errors());
			}
		}else{
			$foto = null;
		}
		
		if($jenis == 'reg'){
			$keterangan = 'reguler';
		}else{
			$keterangan = 'eksklusif';
		}

		$data_trans = [
			'nama' => $nama,
			'email' => $email,
			'telp' => $telp,
			'keterangan' => $keterangan,
			'harga' => (float)$bayar,
			'harga_bruto' => (float)$bayar,
			'alamat' => $alamat,
			'updated_at' => $timestamp
		];

		if($foto != null) {
			$data_trans['path_file'] = 'files/img/bukti_bayar/'.$foto;
			$data_trans['path_thumb'] = 'files/img/bukti_bayar/thumbs/'.$output_thumb;
		}

		$where = ['id' => $id];
		$update = $this->t_checkout->update($where, $data_trans);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal update Transaksi Manual';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses update Transaksi Manual';
		}
		
		echo json_encode($data);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_transaksi()
	{
		$id = $this->input->post('id');
		$del = $this->t_checkout->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Transaksi dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Transaksi dihapus';
		}

		echo json_encode($retval);
	}

	// ===============================================
	private function rule_validasi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if ($this->input->post('nama') == '') {
			$data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Wajib Mengisi nama';
            $data['status'] = FALSE;
		}

		if ($this->input->post('email') == '') {
			$data['inputerror'][] = 'email';
            $data['error_string'][] = 'Wajib Mengisi Email';
            $data['status'] = FALSE;
		}

		if ($this->input->post('telp') == '') {
			$data['inputerror'][] = 'telp';
            $data['error_string'][] = 'Wajib Mengisi telp';
            $data['status'] = FALSE;
		}
		
		if ($this->input->post('jenis') == '') {
			$data['inputerror'][] = 'jenis';
            $data['error_string'][] = 'Wajib Mengisi Jenis';
            $data['status'] = FALSE;
		}

		if ($this->input->post('harga') == '') {
			$data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Wajib Mengisi Harga';
            $data['status'] = FALSE;
		}

		if ($this->input->post('bayar') == '') {
			$data['inputerror'][] = 'bayar';
            $data['error_string'][] = 'Wajib Mengisi Jumlah Bayar';
            $data['status'] = FALSE;
		}
		
        return $data;
	}

	private function konfigurasi_upload_img($nmfile)
	{ 
		//konfigurasi upload img display
		$config['upload_path'] = '../files/img/bukti_bayar';
		$config['allowed_types'] = 'gif|jpg|png|jpeg|bmp';
		$config['overwrite'] = TRUE;
		$config['max_size'] = '4000';//in KB (4MB)
		$config['max_width']  = '0';//zero for no limit 
		$config['max_height']  = '0';//zero for no limit
		$config['file_name'] = $nmfile;
		//load library with custom object name alias
		$this->load->library('upload', $config, 'file_obj');
		$this->file_obj->initialize($config);
	}

	private function konfigurasi_image_resize($nmfile)
	{
		//konfigurasi image lib
	    $config['image_library'] = 'gd2';
	    $config['source_image'] = '../files/img/bukti_bayar/'.$nmfile;
	    $config['create_thumb'] = FALSE;
	    $config['maintain_ratio'] = FALSE;
	    $config['new_image'] = '../files/img/bukti_bayar/'.$nmfile;
	    $config['overwrite'] = TRUE;
	    $config['width'] = 480; //resize
	    $config['height'] = 600; //resize
	    $this->load->library('image_lib',$config); //load image library
	    $this->image_lib->initialize($config);
		$this->image_lib->resize();
	}

	private function konfigurasi_image_thumb($filename, $gbr)
	{
		//buat folder
		if (!file_exists('../files/img/bukti_bayar/thumbs')) {
			mkdir('../files/img/bukti_bayar/thumbs', 0777, true);
		}

		//konfigurasi image lib
	    $config2['image_library'] = 'gd2';
	    $config2['source_image'] = '../files/img/bukti_bayar/'.$filename;
	    $config2['create_thumb'] = TRUE;
	 	$config2['thumb_marker'] = '_thumb';
	    $config2['maintain_ratio'] = FALSE;
	    $config2['new_image'] = '../files/img/bukti_bayar/thumbs'.'/'.$filename;
	    $config2['overwrite'] = TRUE;
	    $config2['quality'] = '100%';
	 	$config2['width'] = 45;
	 	$config2['height'] = 45;
	    $this->load->library('image_lib',$config2); //load image library
	    $this->image_lib->initialize($config2);
	    $this->image_lib->resize();
	    return $output_thumb = $gbr['raw_name'].'_thumb'.$gbr['file_ext'];	
	}

	private function seoUrl($string) {
	    //Lower case everything
	    $string = strtolower($string);
	    //Make alphanumeric (removes all other characters)
	    $string = preg_replace("/[^a-z0-9_\s-]/", "", $string);
	    //Clean up multiple dashes or whitespaces
	    $string = preg_replace("/[\s-]+/", " ", $string);
	    //Convert whitespaces and underscore to dash
	    $string = preg_replace("/[\s_]/", "-", $string);
	    return $string;
	}
}
