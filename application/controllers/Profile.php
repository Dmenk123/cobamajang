<?php
//defined('BASEPATH ') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('m_user');
		$sess = $this->session->all_userdata();
		if($sess['logged_in'] == false || $sess['is_agen'] == false) {
			return redirect('auth');
		}
	}

	public function index()
	{	
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$tanggal = $obj_date->format('Y-m-d');
		
		$sess = $this->session->all_userdata();

		$join = [ 
			[
				'table' => 't_checkout',
				'on'	=> 'm_user.kode_agen = t_checkout.kode_agen'
			]
		];

		$profile = $this->m_global->single_row('m_user.*, t_checkout.is_confirm, t_checkout.status_confirm',['m_user.id' => $sess['id_user'], 'm_user.status' => 1], 'm_user', $join);

		$kode_agen = $profile->kode_agen;
		$kode_affiliate = $profile->kode_affiliate;
		$email_agen = $profile->email;

		$arr_komisi = $this->list_komisi_history($kode_affiliate);
		$q = $this->m_user->get_komisi_belum_tarik($kode_affiliate );
		// echo $this->db->last_query();exit;
		
		$qq = $this->m_user->get_komisi_sudah_tarik($kode_affiliate );
		$qqq = $this->m_user->get_komisi_pending_tarik($kode_affiliate );
		$qqqq = $this->m_user->cek_status_sudah_verify_agen($email_agen);

		if($qqqq){
			if($qqqq->is_confirm == '1'){
				$sts = TRUE;       
			}else{
				$sts = FALSE;
			}    
		}else{
			$sts = FALSE;
		}

		$arr_batine_agen = [
			'komisi_belum' => $q->total_laba,
			'komisi_sudah' => $qq->total_laba,
			'komisi_pending' => $qqq->total_laba
		];
		
		$data = [
			'profile' => $profile,
			'data_komisi' => $arr_komisi,
			'data_laba_agen' => $arr_batine_agen,
			'status_konfirm' => $sts
		];

		
		// echo "<pre>";
		// print_r ($data);
		// echo "</pre>";
		// exit;

		$this->load->view('v_template', $data, FALSE);
	}

	public function list_komisi_history($id_agen)
	{
		$list = $this->m_user->get_data_komisi($id_agen);
		
		$data = array();
		$no = 0;
		foreach ($list as $datalist) {
			$link_detail = site_url('profile/komisi_detail/') . $datalist->id;
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = date('d-m-Y H:i', strtotime($datalist->created_at));
			$row[] = "Rp. ".number_format($datalist->laba_agen_total,0,",",".");
			$row[] = $datalist->kode_ref;
			$data[] = $row;
		} //end loop

		return $data;
	}

	public function list_pre_komisi_history($id_agen)
	{
		$list = $this->m_user->get_data_pre_komisi($id_agen);

		$data = array();
		$no = 0;
		foreach ($list as $datalist) {
			$link_detail = site_url('profile/komisi_detail/') . $datalist->id;
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = date('d-m-Y H:i', strtotime($datalist->created_at));
			$row[] = "Rp. " . number_format($datalist->laba_agen_total, 0, ",", ".");
			$row[] = $datalist->kode_klaim;
			$data[] = $row;
		} //end loop

		return $data;
	}

	public function list_after_komisi_history($id_agen)
	{
		$list = $this->m_user->get_data_after_komisi($id_agen);
		$data = array();
		$no = 0;
		foreach ($list as $datalist) {
			$link_detail = site_url('profile/komisi_detail/') . $datalist->id;
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = date('d-m-Y H:i', strtotime($datalist->tanggal_verify));
			$row[] = "Rp. " . number_format($datalist->laba_agen_total, 0, ",", ".");
			$row[] = $datalist->kode_verify;
			$row[] = $datalist->bukti_bayar;
			$data[] = $row;
		} //end loop

		return $data;
	}

	public function rincian_komisi()
	{
		$arr_komisi = [];
		$arr_komisi_pre =[];
		$id_user = clean_string($this->session->userdata('id_user'));

		if ($this->session->userdata('id_role') != '3') {
			return redirect('home','refresh');
		}

		//userdata
		$userdata = $this->m_user->get_by_condition(['status' => 1, 'id' => $id_user], true);

		// var_dump($userdata);exit;
		$kode_agen = $userdata->kode_agen;
		$kode_affiliate = $userdata->kode_affiliate;
		$arr_komisi_belum = $this->list_komisi_history($kode_affiliate);
		$arr_komisi_pre = $this->list_pre_komisi_history($kode_affiliate);
		$arr_komisi_after = $this->list_after_komisi_history($kode_affiliate);
	
		$data = [
			'data_user' => $userdata,
			'data_komisi_belum' => $arr_komisi_belum,
			'data_komisi_pre' => $arr_komisi_pre,
			'data_komisi_after' => $arr_komisi_after
		];

		// echo "<pre>";
		// print_r ($data);
		// echo "</pre>";
		// exit;

		$this->load->view('v_template', $data, FALSE);
	}

	public function bulan_indo($bulan)
	{
		$arr_bulan =  [
			1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
		];

		return $arr_bulan[(int) $bulan];
	}

	private function generate_kode_ref() {

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
	
		return $token;
	}

	public function aff($uri='')
	{
		$cek_agen = $this->pengecekan_agen($uri);
		if ($cek_agen) {
			return redirect('home', 'refresh');
		}
	}

	public function pengecekan_agen($uri)
	{
		/*
		* cek ada tidaknya sesi level
		* ketika tidak ada maka dibuatkan sesi agen
		* ketika ada, dicek levelnya jika bukan customer maka akan di unset
		* ada return value, sebagai flag untuk redirect
		*/
	
		$retval = FALSE;

		if ($this->session->userdata('id_role') == null) 
		{
			$param_sess = $uri;
			$cek_sess = $this->m_global->cek_sesi_agen($param_sess);
			if ($cek_sess) {
				$this->session->unset_userdata('kode_affiliate');
				$this->session->set_userdata(
					array(
						'kode_affiliate' => $cek_sess->kode_affiliate
					)
				);

				$retval = TRUE;
			}
		}
		else
		{
			if ((int)$this->session->userdata('id_role') > 2) {
				if ($uri != '') {
					$param_sess = $uri;
					$cek_sess = $this->m_global->cek_sesi_agen($param_sess);
					
					if ($cek_sess) {
						$this->session->unset_userdata('kode_affiliate');
						$this->session->set_userdata(
							array(
								'kode_affiliate' => $cek_sess->kode_affiliate
							)
						);

						$retval = TRUE;
					}
				}
			}else{
				if ($this->session->userdata('kode_affiliate') != null) {
					$this->session->unset_userdata('kode_affiliate');
				}
			}
		}

		return $retval;
	}

	public function tarik_komisi()
	{
		$kode_klaim = $this->generate_kode_ref();
		
        $cek = $this->m_global->single_row('*',['kode_klaim' => $kode_klaim], 't_klaim_agen', NULL);
        if($cek) {
            //recursive
            $this->tarik_komisi();
		}else{
			$id_user = clean_string($this->session->userdata('id_user'));
			$userdata = $this->m_user->get_by_condition(['status' => 1, 'id' => $id_user], true);
			$kode_agen = $userdata->kode_agen;
			$kode_affiliate = $userdata->kode_affiliate;

			$q = $this->m_user->get_komisi_belum_tarik($kode_affiliate);
			$qq = $this->m_user->get_komisi_sudah_tarik($kode_affiliate);

			if ((int)$q->total_laba == 0) {
				echo json_encode([
					'status' => FALSE
				]);
				return;
			}
			
			$this->db->trans_begin();
			$id_klaim_agen = $this->m_global->gen_uuid();
			
			//update flag is tarik
			$update_flag_tarik = $this->m_user->set_komisi_sudah_klaim($kode_affiliate, $id_klaim_agen);
			
			//catat ke t_klaim_agen
			if ($qq->total_laba) {
				$saldo_sebelum = $qq->total_laba; 
			}else{
				$saldo_sebelum = 0;
			}

			$data = array(
				'id' => $id_klaim_agen,
				'kode_agen' => $kode_agen,
				'saldo_sebelum' => $saldo_sebelum,
				'jumlah_klaim' => (int)$q->total_laba,
				'saldo_sesudah' => (int)$qq->total_laba + (int)$q->total_laba,
				'datetime_klaim' => date('Y-m-d H:i:s'),
				'created_at' => date('Y-m-d H:i:s'),
				'kode_klaim' => $kode_klaim
			);

			$insert = $this->m_global->store($data, 't_klaim_agen');

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$status = FALSE;
			} else {
				$this->db->trans_commit();			
				$status = TRUE;
			}

			echo json_encode([
				'status' => $status,
				'kode_klaim' => $kode_klaim
			]);
		}
	}
	
	public function edit_profil()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$tanggal = $obj_date->format('Y-m-d');
		
		$sess = $this->session->all_userdata();

		$join = [ 
			[
				'table' => 't_checkout',
				'on'	=> 'm_user.kode_agen = t_checkout.kode_agen'
			]
		];
		
		$profile = $this->m_global->single_row('m_user.*, t_checkout.is_confirm, t_checkout.status_confirm',['m_user.id' => $sess['id_user'], 'm_user.status' => 1], 'm_user', $join);

		$data = [
			'profile' => $profile
		];

		
		// echo "<pre>";
		// print_r ($data);
		// echo "</pre>";
		// exit;

		$this->load->view('v_template', $data, FALSE);
	}


	public function update_profile()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$tanggal = $obj_date->format('Y-m-d');

	    $this->load->library('Enkripsi');
		$flag_upload_foto = FALSE;
		$flag_ganti_pass = FALSE;
		
		$arr_valid = $this->_validate();

		if ($arr_valid['status'] == FALSE) {
			echo json_encode(['status' => FALSE, 'inputerror' => $arr_valid['inputerror'], 'error_string' => $arr_valid['error_string']]);
			return;
		}

		$id_user = $this->session->userdata('id_user');
		$password = $this->input->post('password');
		$repassword = $this->input->post('repassword');
		$password_lama = $this->input->post('password_lama');
		$telp = $this->input->post('telp');
		$email = $this->input->post('email');
		$rekening = $this->input->post('rekening');
		$bank = strtoupper(strtolower($this->input->post('bank')));
		$nama_lengkap = $this->input->post('nama');
		$namafileseo = $this->seoUrl($nama_lengkap.' '.time());

		$old_data = $this->m_user->get_by_id($id_user);
		
		$this->db->trans_begin();
		
		if ($this->input->post('ceklistpwd') != 'Y') {
			$flag_ganti_pass = TRUE;
			$hasil_password = $this->enkripsi->enc_dec('encrypt', $password);
			$hasil_password_lama = $this->enkripsi->enc_dec('encrypt', $password_lama);

			if ($old_data->password != $hasil_password_lama) {
				$data['inputerror'][] = 'password_lama';
				$data['error_string'][] = 'Password Lama Salah';
				$data['status'] = FALSE;
				echo json_encode($data);
				return;
			}

			if ($password != $repassword) {
				$data['inputerror'][] = 'password';
				$data['error_string'][] = 'Password baru Tidak Sama';
				$data['status'] = FALSE;

				$data['inputerror'][] = 'repassword';
				$data['error_string'][] = 'Password baru Tidak Sama';
				$data['status'] = FALSE;
				echo json_encode($data);
				return;
			}
		}

		$this->db->trans_begin();
		
		$file_mimes = ['image/png', 'image/x-citrix-png', 'image/x-png', 'image/x-citrix-jpeg', 'image/jpeg', 'image/pjpeg'];

		if(isset($_FILES['foto']['name']) && in_array($_FILES['foto']['type'], $file_mimes)) {
			$flag_upload_foto = TRUE;		
			if (!file_exists('./files/img/user_img/')) {
				mkdir('./files/img/user_img/', 0777, true);
			}

			$this->konfigurasi_upload_img($namafileseo);
			//get detail extension
			$pathDet = $_FILES['foto']['name'];
			$extDet = pathinfo($pathDet, PATHINFO_EXTENSION);
			
			if ($this->file_obj->do_upload('foto')) 
			{
				$gbrBukti = $this->file_obj->data();
				$nama_file_foto = $gbrBukti['file_name'];
				$output_thumb = $this->konfigurasi_image_thumb($nama_file_foto, $gbrBukti);
				$this->image_lib->clear();
				## replace nama file + ext
				$namafileseo = $namafileseo.'.'.$extDet;
			} else {
				$error = array('error' => $this->file_obj->display_errors());
				//var_dump($error);exit;
			}
		}

		//data input array
		$input = ['updated_at' => date('Y-m-d H:i:s')];

		if ($flag_ganti_pass) {
			$input['password'] = $hasil_password;
		}

		$input = [
			'nama_lengkap'=> $nama_lengkap,
			'no_telp' => $telp,
			'email' => $email,
			'bank' => $bank,
			'rekening' => $rekening,
			'updated_at' => $timestamp
		];

		if ($flag_upload_foto == TRUE) {
			$input['gambar'] = "files/img/user_img/".$namafileseo;
			$input['thumb_gambar'] = "files/img/user_img/thumbs/".$output_thumb;
		}

		//update to db
		$upd = $this->m_user->update(['id' => $id_user], $input);

		$this->db->trans_complete();
		// was there any update or error?
		// if ($this->db->affected_rows() == '1') {
		// 	echo $this->db->last_query();exit;
		// } else {
		// 	// any trans error?
		// 	if ($this->db->trans_status() === FALSE) {
		// 		var_dump('error');
		// 	}
		// 	var_dump($this->db->error());
		// }
		// exit;
		
        
		
		// var_dump($upd);exit;
		

        if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$status = FALSE;
		} else {
			$this->db->trans_commit();			
			$status = TRUE;
		}

		echo json_encode([
			'status' => $status,
			'redirect' => base_url('profile')
		]);
	}

	private function konfigurasi_upload_img($nmfile)
	{ 
		//konfigurasi upload img display
		$config['upload_path'] = './files/img/user_img/';
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

	private function konfigurasi_image_thumb($filename, $gbr)
	{
		//buat folder
		if (!file_exists('./files/img/user_img/thumbs')) {
			mkdir('./files/img/user_img/thumbs', 0777, true);
		}

		//konfigurasi image lib
	    $config2['image_library'] = 'gd2';
	    $config2['source_image'] = './files/img/user_img/'.$filename;
	    $config2['create_thumb'] = TRUE;
	 	$config2['thumb_marker'] = '_thumb';
	    $config2['maintain_ratio'] = FALSE;
	    $config2['new_image'] = './files/img/user_img/thumbs/'.$filename;
	    $config2['overwrite'] = TRUE;
	    $config2['quality'] = '100%';
	 	$config2['width'] = 45;
	 	$config2['height'] = 45;
	    $this->load->library('image_lib',$config2); //load image library
	    $this->image_lib->initialize($config2);
	    $this->image_lib->resize();
	    return $output_thumb = $gbr['raw_name'].'_thumb'.$gbr['file_ext'];	
	}
	

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('ceklistpwd') != 'Y') {
			if ($this->input->post('password') == '') {
				$data['inputerror'][] = 'password';
				$data['error_string'][] = 'Wajib mengisi password Baru';
				$data['status'] = FALSE;
			}

			if ($this->input->post('repassword') == null) {
				$data['inputerror'][] = 'repassword';
				$data['error_string'][] = 'Wajib mengisi ulang Password Baru';
				$data['status'] = FALSE;
			}

			if ($this->input->post('password_lama') == null) {
				$data['inputerror'][] = 'password_lama';
				$data['error_string'][] = 'Wajib mengisi password Lama';
				$data['status'] = FALSE;
			}
		}

		if ($this->input->post('nama') == '') {
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Wajib mengisi nama';
			$data['status'] = FALSE;
		}

		if ($this->input->post('telp') == '') {
				$data['inputerror'][] = 'telp';
				$data['error_string'][] = 'Wajib mengisi Nomor Telepon';
				$data['status'] = FALSE;
		}

		if ($this->input->post('email') == '') {
				$data['inputerror'][] = 'email';
				$data['error_string'][] = 'Wajib mengisi Email';
				$data['status'] = FALSE;
		}

		if ($this->input->post('rekening') == '') {
				$data['inputerror'][] = 'rekening';
				$data['error_string'][] = 'Wajib mengisi Rekening';
				$data['status'] = FALSE;
		}

		if ($this->input->post('bank') == '') {
				$data['inputerror'][] = 'bank';
				$data['error_string'][] = 'Wajib mengisi Bank';
				$data['status'] = FALSE;
		}

		return $data;
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
