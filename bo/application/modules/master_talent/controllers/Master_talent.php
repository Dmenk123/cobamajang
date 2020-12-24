<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_talent extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}
		$this->load->model('m_global');
		$this->load->model('master_user/m_user');
		$this->load->model('m_talent');
		$this->load->model('t_file_talent');
		$this->load->model('t_video_talent');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user'); 
		$data_user = $this->m_user->get_detail_user($id_user);
			
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Pengelolaan Data Talent',
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
			'modal' => 'modal_master_talent',
			'js'	=> 'master_talent.js',
			'view'	=> 'view_master_talent'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_talent()
	{
		$list = $this->m_talent->get_datatable();
		$data = array();
		// $no =$_POST['start'];
		foreach ($list as $val) {
			// $no++;
			$row = array();
			//loop value tabel db
			$row[] = '<div class="kt-widget__media"><img src="'.'../'.$val->foto_thumb.'"/></div>';
			$row[] = $val->nama;
			$row[] = $val->deskripsi;
			$row[] = ($val->akun_fb) ? $val->akun_fb : '-';
			$row[] = ($val->akun_ig) ? $val->akun_ig : '-';
			$row[] = ($val->akun_tw) ? $val->akun_tw : '-';
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="edit_talent(\''.$val->id.'\')">
							<i class="la la-pencil"></i> Edit talent
						</button>
						<button class="dropdown-item" onclick="delete_talent(\''.$val->id.'\')">
							<i class="la la-trash"></i> Hapus
						</button>
						<a class="button dropdown-item" href="'.base_url("master_talent/detail_talent/$val->id").'" target="_blank">
							<i class="la la-paperclip"></i> Galeri Foto
						</a>
						<a class="button dropdown-item" href="'.base_url("master_talent/video_talent/$val->id").'" target="_blank">
							<i class="la la-file-video-o"></i> Video
						</a>
			';

			// if ($val->status == 1) {
			// 	$str_aksi .=
			// 	'<button class="dropdown-item btn_edit_status" title="aktif" id="'.$val->id.'" value="aktif"><i class="la la-check">
			// 	</i> Aktif</button>';
			// }else{
			// 	$str_aksi .=
			// 	'<button class="dropdown-item btn_edit_status" title="nonaktif" id="'.$val->id.'" value="nonaktif"><i class="la la-close">
			// 	</i> Non Aktif</button>';
			// }	

			$str_aksi .= '</div></div>';
			$row[] = $str_aksi;

			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->m_talent->count_all(),
			"recordsFiltered" => $this->m_talent->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function edit_talent()
	{
		$this->load->library('Enkripsi');
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);
	
		$id = $this->input->post('id');
		$oldData = $this->m_talent->get_by_id($id);

		// $select = "m_user.*, m_role.nama as nama_role";
		// $where = ['m_user.id' => $id];
		// $table = 'm_user';
		// $join = [ 
		// 	[
		// 		'table' => 'm_role',
		// 		'on'	=> 'm_user.id_role = m_role.id'
		// 	]
		// ];

		// $oldData = $this->m_global->single_row($select, $where, $table, $join, 'm_user.kode_user');
		
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}
		
		$url_foto = '../'.$oldData->foto;
		$foto = base64_encode(file_get_contents($url_foto));  
		
		$data = array(
			'data_user' => $data_user,
			'old_data'	=> $oldData,
			'foto_encoded' => $foto
		);
		
		echo json_encode($data);
	}

	public function add_data_talent()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$nama = trim($this->input->post('nama'));
		$txt_deskripsi = trim($this->input->post('txt_deskripsi'));
		$akun_fb = trim($this->input->post('akun_fb'));
		$akun_ig = trim($this->input->post('akun_ig'));
		$akun_tw = trim($this->input->post('akun_tw'));

		$id = $this->m_talent->get_max_id();
		$namafileseo = $this->seoUrl($nama.' '.time());

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}


		$this->db->trans_begin();
		
		$file_mimes = ['image/png', 'image/x-citrix-png', 'image/x-png', 'image/x-citrix-jpeg', 'image/jpeg', 'image/pjpeg'];

		if(isset($_FILES['foto']['name']) && in_array($_FILES['foto']['type'], $file_mimes)) {
						
			if (!file_exists('../files/img/talent_img/'.$id)) {
				mkdir('../files/img/talent_img/'.$id, 0777, true);
			}

			$this->konfigurasi_upload_img($namafileseo, $id);
			//get detail extension
			$pathDet = $_FILES['foto']['name'];
			$extDet = pathinfo($pathDet, PATHINFO_EXTENSION);
			
			if ($this->file_obj->do_upload('foto')) 
			{
				$gbrBukti = $this->file_obj->data();
				$nama_file_foto = $gbrBukti['file_name'];
				$output_thumb = $this->konfigurasi_image_thumb($nama_file_foto, $gbrBukti, $id);
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

		$data_talent = [
			'id' => $id,
			'nama' => $nama,
			'deskripsi' => $txt_deskripsi,
			'akun_fb' => $akun_fb,
			'akun_ig' => $akun_ig,
			'akun_tw' => $akun_tw,
			'created_at' => $timestamp,
			'foto'	=> 'files/img/talent_img/'.$id.'/'.$namafileseo,
			'foto_thumb' => 'files/img/talent_img/'.$id.'/'.'thumbs'.'/'.$output_thumb
		];
		
		$insert = $this->m_talent->save($data_talent);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan talent';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan talent';
		}

		echo json_encode($retval);
	}

	public function update_data_talent()
	{
		$obj_date = new DateTime();
		$sesi_id_user = $this->session->userdata('id_user'); 
		$id_user = $this->input->post('id_user');

		$timestamp = $obj_date->format('Y-m-d H:i:s');
		
		$id = trim($this->input->post('id_talent'));
		$nama = trim($this->input->post('nama'));
		$txt_deskripsi = trim($this->input->post('txt_deskripsi'));
		$akun_fb = trim($this->input->post('akun_fb'));
		$akun_ig = trim($this->input->post('akun_ig'));
		$akun_tw = trim($this->input->post('akun_tw'));
		$namafileseo = $this->seoUrl($nama.' '.time());

		$this->db->trans_begin();

		$file_mimes = ['image/png', 'image/x-citrix-png', 'image/x-png', 'image/x-citrix-jpeg', 'image/jpeg', 'image/pjpeg'];

		if(isset($_FILES['foto']['name']) && in_array($_FILES['foto']['type'], $file_mimes)) {
			$this->konfigurasi_upload_img($namafileseo, $id);
			//get detail extension
			$pathDet = $_FILES['foto']['name'];
			$extDet = pathinfo($pathDet, PATHINFO_EXTENSION);
			
			if ($this->file_obj->do_upload('foto')) 
			{
				$gbrBukti = $this->file_obj->data();
				$nama_file_foto = $gbrBukti['file_name'];
				$output_thumb = $this->konfigurasi_image_thumb($nama_file_foto, $gbrBukti, $id);
				$this->image_lib->clear();
				## replace nama file + ext
				$namafileseo = $namafileseo.'.'.$extDet;
				$foto = $namafileseo;
			} else {
				$error = array('error' => $this->file_obj->display_errors());
				var_dump($error);exit;
			}
		}else{
			$foto = null;
		}

		$data_talent = [
			'nama' => $nama,
			'deskripsi' => $txt_deskripsi,
			'akun_fb' => $akun_fb,
			'akun_ig' => $akun_ig,
			'akun_tw' => $akun_tw,
			'updated_at' => $timestamp
		];

		if($foto != null) {
			$data_talent['foto'] = 'files/img/talent_img/'.$id.'/'.$foto;
			$data_talent['foto_thumb'] = 'files/img/talent_img/'.$id.'/'.'thumbs'.'/'.$output_thumb;
		}

		$where = ['id' => $id];
		$update = $this->m_talent->update($where, $data_talent);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal update Master Talent';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses update Master Talent';
		}
		
		echo json_encode($data);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_talent()
	{
		$id = $this->input->post('id');
		$del = $this->m_talent->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master Talent dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master Talent dihapus';
		}

		echo json_encode($retval);
	}

	public function detail_talent($id)
	{
		$data_talent = $this->m_talent->get_by_condition("id = '$id' and deleted_at is null", true);
		$data_gallery = $this->t_file_talent->get_by_condition("id_talent = '$id' and deleted_at is null");

		if($data_talent){
			$id_user = $this->session->userdata('id_user'); 
			$data_user = $this->m_user->get_detail_user($id_user);
			
			$url_foto = '../'.$data_talent->foto;
			$foto = base64_encode(file_get_contents($url_foto));  
			/**
			 * data passing ke halaman view content
			 */
			$data = array(
				'title' => 'Detail Data Talent',
				'data_user' => $data_user,
				'data_talent' => $data_talent,
				'foto_encode' => $foto,
				'data_gallery' => $data_gallery
			);
			
			/**
			 * content data untuk template
			 * param (css : link css pada direktori assets/css_module)
			 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
			 * param (js : link js pada direktori assets/js_module)
			 */
			$content = [
				'css' 	=> null,
				'modal' => null,
				'js'	=> 'master_talent.js',
				'view'	=> 'view_master_talent_det'
			];

			$this->template_view->load_view($content, $data);
			
		}else{
			return redirect('master_talent');
		}
	}

	public function video_talent($id)
	{
		$data_talent = $this->m_talent->get_by_condition("id = '$id' and deleted_at is null", true);
		$data_video = $this->t_video_talent->get_by_condition("id_talent = '$id' and deleted_at is null");

		if($data_talent){
			$id_user = $this->session->userdata('id_user'); 
			$data_user = $this->m_user->get_detail_user($id_user);
			
			$url_foto = '../'.$data_talent->foto;
			$foto = base64_encode(file_get_contents($url_foto));  
			/**
			 * data passing ke halaman view content
			 */
			$data = array(
				'title' => 'Gallery Video Talent',
				'data_user' => $data_user,
				'data_talent' => $data_talent,
				'foto_encode' => $foto,
				'data_video' => $data_video
			);
			
			/**
			 * content data untuk template
			 * param (css : link css pada direktori assets/css_module)
			 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
			 * param (js : link js pada direktori assets/js_module)
			 */
			$content = [
				'css' 	=> null,
				'modal' => null,
				'js'	=> 'master_talent.js',
				'view'	=> 'view_master_talent_video'
			];

			$this->template_view->load_view($content, $data);
			
		}else{
			return redirect('master_talent');
		}
	}

	public function simpan_detail_talent()
	{
		$obj_date = new DateTime();
		$id = $this->t_file_talent->get_max_id();
		$id_talent = $this->input->post('id_talent');
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$data_talent = $this->m_talent->get_by_id($id_talent);
		$namafileseo = $this->seoUrl($id.'-'.$data_talent->nama.' '.time());

		$this->db->trans_begin();

		$file_mimes = ['image/png', 'image/x-citrix-png', 'image/x-png', 'image/x-citrix-jpeg', 'image/jpeg', 'image/pjpeg'];

		if(isset($_FILES['foto_det']['name']) && in_array($_FILES['foto_det']['type'], $file_mimes)) {
						
			$this->konfigurasi_upload_img($namafileseo, $id_talent);
			//get detail extension
			$pathDet = $_FILES['foto_det']['name'];
			$extDet = pathinfo($pathDet, PATHINFO_EXTENSION);
			
			if ($this->file_obj->do_upload('foto_det')) 
			{
				$gbrBukti = $this->file_obj->data();
				$nama_file_foto = $gbrBukti['file_name'];
				$this->konfigurasi_image_resize($nama_file_foto, $gbrBukti, $id_talent);
				$output_thumb = $this->konfigurasi_image_thumb($nama_file_foto, $gbrBukti, $id_talent);
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

		$datanya = [
			'id' => $id,
			'id_talent' => $id_talent,
			'created_at' => $timestamp,
			'path_file'	=> 'files/img/talent_img/'.$id_talent.'/'.$namafileseo,
			'path_file_thumb' => 'files/img/talent_img/'.$id_talent.'/'.'thumbs'.'/'.$output_thumb
		];

		$insert = $this->t_file_talent->save($datanya);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan file gallery';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan file gallery';
		}

		echo json_encode($retval);
	}

	public function simpan_video_talent()
	{
		$obj_date = new DateTime();
		$id = $this->t_video_talent->get_max_id();
		$id_talent = $this->input->post('id_talent');
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$data_talent = $this->m_talent->get_by_id($id_talent);
		$namafileseo = $this->seoUrl($id.'-video-'.$data_talent->nama.' '.time());

		$this->db->trans_begin();

		$file_mimes = ['video/mp4'];

		if(isset($_FILES['video']['name']) && in_array($_FILES['video']['type'], $file_mimes)) {
						
			$this->konfigurasi_upload_video($namafileseo, $id_talent);
			//get detail extension
			$pathDet = $_FILES['video']['name'];
			$extDet = pathinfo($pathDet, PATHINFO_EXTENSION);
			
			if ($this->file_obj->do_upload('video')) 
			{
				$data_file = $this->file_obj->data();
				$nama_file_video = $data_file['file_name'];
				## replace nama file + ext
				$namafileseo = $namafileseo.'.'.$extDet;
			} else {
				$error = array('error' => $this->file_obj->display_errors());
			}
		}else{
			$data['inputerror'][] = 'video';
			$data['error_string'][] = 'Wajib Mengisi video';
			$data['status'] = FALSE;
			echo json_encode($data);
			return;
		}

		$datanya = [
			'id' => $id,
			'id_talent' => $id_talent,
			'created_at' => $timestamp,
			'path_video' => 'files/img/talent_img/'.$id_talent.'/'.$namafileseo
		];

		$insert = $this->t_video_talent->save($datanya);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan file Video';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan file Video';
		}

		echo json_encode($retval);
	}

	public function delete_gallery()
	{
		$id = $this->input->post('id');
		$del = $this->t_file_talent->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master Talent dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master Talent dihapus';
		}

		echo json_encode($retval);
	}

	public function delete_video()
	{
		$id = $this->input->post('id');
		$del = $this->t_video_talent->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Video Talent dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Video Talent dihapus';
		}

		echo json_encode($retval);
	}
	/**
	 * get data untuk select2 (dipakai dimana-mana)
	 */
	public function get_select_talent()
	{
		$term = $this->input->get('term');
		$data_talent = $this->m_global->multi_row('*', ['deleted_at' => null, 'nama like' => '%'.$term.'%'], 'm_talent', null, 'nama');
		if($data_talent) {
			foreach ($data_talent as $key => $value) {
				$row['id'] = $value->id;
				$row['text'] = $value->nama;
				$retval[] = $row;
			}
		}else{
			$retval = false;
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


		if ($this->input->post('txt_deskripsi') == '') {
			$data['inputerror'][] = 'role';
            $data['error_string'][] = 'Wajib Mengisi Deskripsi';
            $data['status'] = FALSE;
		}

		if ($this->input->post('nama') == '') {
			$data['inputerror'][] = 'status';
            $data['error_string'][] = 'Wajib Mengisi Nama';
            $data['status'] = FALSE;
		}

        return $data;
	}

	private function konfigurasi_upload_img($nmfile, $folder)
	{ 
		//konfigurasi upload img display
		$config['upload_path'] = '../files/img/talent_img/'.$folder;
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

	private function konfigurasi_upload_video($nmfile, $folder)
	{ 
		//konfigurasi upload video display
		$config['upload_path'] = '../files/img/talent_img/'.$folder;
		$config['allowed_types'] = 'mp4';
		$config['overwrite'] = TRUE;
		$config['remove_spaces'] = TRUE;
		$config['max_size'] = '0';//in KB (4MB)
		$config['max_width']  = '0';//zero for no limit 
		$config['max_height']  = '0';//zero for no limit
		$config['file_name'] = $nmfile;
		//load library with custom object name alias
		$this->load->library('upload', $config, 'file_obj');
		$this->file_obj->initialize($config);
	}

	private function konfigurasi_image_resize($nmfile,$gbr, $folder)
	{
		//konfigurasi image lib
	    $config['image_library'] = 'gd2';
	    $config['source_image'] = '../files/img/talent_img/'.$folder.'/'.$nmfile;
	    $config['create_thumb'] = FALSE;
	    $config['maintain_ratio'] = FALSE;
	    $config['new_image'] = '../files/img/talent_img/'.$folder.'/'.$nmfile;
	    $config['overwrite'] = TRUE;
	    $config['width'] = 480; //resize
	    $config['height'] = 600; //resize
	    $this->load->library('image_lib',$config); //load image library
	    $this->image_lib->initialize($config);
		$this->image_lib->resize();
	}

	private function konfigurasi_image_thumb($filename, $gbr, $folder)
	{
		//buat folder
		if (!file_exists('../files/img/talent_img/'.$folder.'/thumbs')) {
			mkdir('../files/img/talent_img/'.$folder.'/thumbs', 0777, true);
		}

		//konfigurasi image lib
	    $config2['image_library'] = 'gd2';
	    $config2['source_image'] = '../files/img/talent_img/'.$folder.'/'.$filename;
	    $config2['create_thumb'] = TRUE;
	 	$config2['thumb_marker'] = '_thumb';
	    $config2['maintain_ratio'] = FALSE;
	    $config2['new_image'] = '../files/img/talent_img/'.$folder.'/'.'thumbs'.'/'.$filename;
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
