<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verify_klaim extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('t_checkout');
		$this->load->model('t_klaim_agen');
		$this->load->model('t_klaim_verify');
		$this->load->model('tbl_requesttransaksi');
		$this->load->model('m_global');
		$this->load->model('master_user/m_user');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Data Verifikasi Klaim',
			'data_user' => $data_user
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
			'js'	=> 'verify_klaim.js',
			'view'	=> 'view_verifikasi_klaim'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_klaim()
	{
		$obj_date = new DateTime();
		$tgl_awal = $obj_date->createFromFormat('d/m/Y', $this->input->post('tgl_awal'))->format('Y-m-d');
		$tgl_akhir = $obj_date->createFromFormat('d/m/Y', $this->input->post('tgl_akhir'))->format('Y-m-d');
		$status = $this->input->post('status');

		$list = $this->t_klaim_agen->get_datatable($tgl_awal, $tgl_akhir, $status);
		
		$data = array();
		// $no =$_POST['start'];
		foreach ($list as $val) {
			// $no++;
			$row = array();
			//loop value tabel db
			$row[] = $val->created_at;
			$row[] = $val->nama_lengkap;
			$row[] = $val->email;
			$row[] = "Rp " . number_format($val->jumlah_klaim,0,',','.');
			$row[] = ($val->id_user_verify) ? '<span style="color:blue;">Sudah Diverifikasi</span>' : '<span style="color:red;">Belum Diverifikasi</span>';
			$row[] = $val->kode_klaim;
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">';
			
			$str_aksi .= '<a class="dropdown-item" href="'.base_url('verify_klaim/detail_klaim/').$val->id.'">
							<i class="la la-check"></i> detail_klaim
						</a>';
			
			$str_aksi .= '</div></div>';
			$row[] = $str_aksi;
			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->t_checkout->count_all(),
			"recordsFiltered" => $this->t_checkout->count_filtered($tgl_awal, $tgl_akhir, $status),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function detail_klaim($id_klaim)
	{
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);
		
		$select = "ka.*, mu.nama_lengkap as nama_agen, mu.bank, mu.email, mu.rekening, mu.no_telp, kv.bank as bank_verify, kv.rekening as rek_verify, kv.nilai_transfer, kv.bukti as bukti_verify";
		$join = [ 
			[
				'table' => 'm_user mu',
				'on'	=> 'ka.kode_agen = mu.kode_agen'
			],
			[
				'table' => 't_klaim_verify kv',
				'on'	=> 'ka.id = kv.id_klaim_agen'
			],
		];

		$data_klaim =  $this->m_global->single_row($select, ['ka.id' => $id_klaim], 't_klaim_agen ka', $join);
		if($data_klaim->bukti_verify) {
			$url_foto = '../'.$data_klaim->bukti_verify;
			$foto = base64_encode(file_get_contents($url_foto));  
		}else{
			$foto = false;
		}
		
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Data Verifikasi Klaim',
			'data_user' => $data_user,
			'data_klaim' => $data_klaim,
			'foto_encoded' => $foto
		);

		
		// echo "<pre>";
		// print_r ($data);
		// echo "</pre>";
		// exit;

		/**
		 * content data untuk template
		 * param (css : link css pada direktori assets/css_module)
		 * param (modal : modal komponen pada modules/nama_modul/views/nama_modal)
		 * param (js : link js pada direktori assets/js_module)
		 */
		$content = [
			'css' 	=> null,
			'modal' => null,
			'js'	=> 'verify_klaim.js',
			'view'	=> 'view_detail_klaim'
		];

		$this->template_view->load_view($content, $data);
	}

	public function verifikasi_klaim()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');

		$id_klaim_agen = $this->input->post('id_klaim_agen');
		$nama_agen = $this->input->post('nama_agen');
		$foto = $this->input->post('foto');
		$id = $this->m_global->gen_uuid();
		$namafileseo = $this->seoUrl($nama_agen.' '.time());
		$bank = trim(strtoupper(strtolower($this->input->post('bank'))));
		$rekening = $this->input->post('rekening');
		$jml_transfer = $this->input->post('jml_transfer');

		$arr_valid = $this->rule_validasi();

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();
		
		$file_mimes = ['image/png', 'image/x-citrix-png', 'image/x-png', 'image/x-citrix-jpeg', 'image/jpeg', 'image/pjpeg'];

		if(isset($_FILES['foto']['name']) && in_array($_FILES['foto']['type'], $file_mimes)) {
						
			if (!file_exists('../files/img/bukti_verifikasi/')) {
				mkdir('../files/img/bukti_verifikasi/', 0777, true);
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
			}
		}else{
			$data['inputerror'][] = 'foto';
			$data['error_string'][] = 'Wajib Mengisi Foto';
			$data['status'] = FALSE;
			echo json_encode($data);
			return;
		}


		## insert t_klaim_verify
		$datanya = [
			'id' => $id,
			'id_klaim_agen' => $id_klaim_agen,
			'id_user' => $this->session->userdata('id_user'),
			'tanggal_verify' => $timestamp,
			'bank' => $bank,
			'rekening' => $rekening,
			'nilai_transfer' => $jml_transfer,
			'is_aktif' => 1,
			'bukti'	=> 'files/img/bukti_verifikasi/'.$namafileseo,
			'bukti_thumb' => 'files/img/bukti_verifikasi/thumbs/'.$output_thumb,
			'kode_verify' => $this->generate_kode_verify()
		];

		$insert = $this->t_klaim_verify->save($datanya);

		## update t_checkout
		$data_upd = ['is_verify_klaim' => 1];
		$upd = $this->t_checkout->update(['id_klaim_agen' => $id_klaim_agen], $data_upd);

		##update t_klaim_agen
		$data_upd2 = ['id_user_verify' => $this->session->userdata('id_user'), 'datetime_verify' => $timestamp];
		$upd2 = $this->t_klaim_agen->update(['id' => $id_klaim_agen], $data_upd2);

		if ($this->db->trans_status() === FALSE) {
			$this->db->trans_rollback();
			$status = FALSE;
		} else {
			$this->db->trans_commit();			
			$status = TRUE;
		}

		$retval = [
			'status' => $status
		];

		echo json_encode($retval);
	}

	/////////////////////////////////////////////

	private function konfigurasi_upload_img($nmfile)
	{ 
		//konfigurasi upload img display
		$config['upload_path'] = '../files/img/bukti_verifikasi/';
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
		if (!file_exists('../files/img/bukti_verifikasi/thumbs')) {
			mkdir('../files/img/bukti_verifikasi/thumbs', 0777, true);
		}

		//konfigurasi image lib
	    $config2['image_library'] = 'gd2';
	    $config2['source_image'] = '../files/img/bukti_verifikasi/'.$filename;
	    $config2['create_thumb'] = TRUE;
	 	$config2['thumb_marker'] = '_thumb';
	    $config2['maintain_ratio'] = FALSE;
	    $config2['new_image'] = '../files/img/bukti_verifikasi/thumbs/'.$filename;
	    $config2['overwrite'] = TRUE;
	    $config2['quality'] = '100%';
	 	$config2['width'] = 45;
	 	$config2['height'] = 45;
	    $this->load->library('image_lib',$config2); //load image library
	    $this->image_lib->initialize($config2);
	    $this->image_lib->resize();
	    return $output_thumb = $gbr['raw_name'].'_thumb'.$gbr['file_ext'];	
	}

	// ===============================================
	private function rule_validasi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('bank') == '') {
			$data['inputerror'][] = 'bank';
            $data['error_string'][] = 'Wajib Mengisi Bank';
			$data['status'] = FALSE;
			$data['err'] = FALSE;
		}

		if ($this->input->post('rekening') == '') {
			$data['inputerror'][] = 'rekening';
            $data['error_string'][] = 'Wajib Mengisi rekening';
			$data['status'] = FALSE;
			$data['err'] = FALSE;
		}

		if ($this->input->post('jml_transfer') == '') {
			$data['inputerror'][] = 'jml_transfer';
            $data['error_string'][] = 'Wajib Mengisi Jumlah Transfer';
			$data['status'] = FALSE;
			$data['err'] = FALSE;
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

	private function generate_kode_verify() {

		$chars = array(
			'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M',
			'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z',
			'0', '1', '2', '3', '4', '5', '6', '7', '8', '9',
		);
	
		shuffle($chars);
	
		$num_chars = count($chars) - 1;
		$token = '';
	
		for ($i = 0; $i < 5; $i++){ // <-- $num_chars instead of $len
			$token .= $chars[mt_rand(0, $num_chars)];
		}
		
		##cek kode ref is exist 
		$cek_exist_kode = $this->t_klaim_verify->get_by_condition(['kode_verify' => $token], true);
		if($cek_exist_kode) {
			$this->generate_kode_verify();
		}else{
			return $token;
		}
	}
}
