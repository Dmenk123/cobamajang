<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Confirm_jual extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('t_checkout');
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
			'title' => 'Konfirmasi Penjualan',
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
			'modal' => 'modal_confirm_jual',
			'js'	=> 'confirm_jual.js',
			'view'	=> 'view_confirm_jual'
		];

		$this->template_view->load_view($content, $data);
	}

	public function detail($id)
	{
		$kode_aff = $this->generate_kode_ref();
		$link_affiliate = str_ireplace("bo/","",base_url('home/aff/').$kode_aff); 
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);
		$data_detail = $this->t_checkout->get_detail_by_id($id);
		
		$is_manual = ($data_detail->is_manual == '1') ? true : false ;
		
		if($is_manual) {
			$url_foto = '../'.$data_detail->path_file;
			$bukti = base64_encode(file_get_contents($url_foto));   
		}else{
			$bukti = false;
		}

		if($data_detail){
			$txt_email = "<p>Kepada Yth.</p>";
			$txt_email .= "<ul>";
			$txt_email .= "<li>Nama : $data_detail->nama</li>";
			$txt_email .= "<li>Email : $data_detail->email</li>";
			$txt_email .= "<li>Order id : $data_detail->order_id</li>";
			$txt_email .= "</ul>";
			$txt_email .= "<p>Terima kasih telah melakukan pendaftaran sebagai BRAND AMBASSADOR. Berikut adalah link Affiliate Anda</p>";
			$txt_email .= "<ul>";
			$txt_email .= "<li><strong>Link Affiliate: $link_affiliate </strong></li>";
			$txt_email .= "</ul>";
			$txt_email .= "<p>Anda dapat melihat link Affiliate anda pada member area. Login sesuai User Dan Password anda. Salam Sukses</p>";
		}else{
			$txt_email = "";
		}
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Konfirmasi Penjualan',
			'data_user' => $data_user,
			'data_detail' => $data_detail,
			'txt_email' => $txt_email,
			'foto_encode' => $bukti,
			'kode_aff' => $kode_aff,
			'link_affiliate' => $link_affiliate
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
			'modal' => 'modal_confirm_jual',
			'js'	=> 'confirm_jual.js',
			'view'	=> 'view_detail_confirm_jual'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_penjualan()
	{
		$obj_date = new DateTime();
		$tgl_awal = $obj_date->createFromFormat('d/m/Y', $this->input->post('tgl_awal'))->format('Y-m-d');
		$tgl_akhir = $obj_date->createFromFormat('d/m/Y', $this->input->post('tgl_akhir'))->format('Y-m-d');
		$status = $this->input->post('status');
		$is_manual = ($this->input->post('status') == 'manual') ? '1' : '';

		$list = $this->t_checkout->get_datatable($tgl_awal, $tgl_akhir, $status, $is_manual);
		
		$data = array();
		// $no =$_POST['start'];
		foreach ($list as $val) {
			// $no++;
			$row_manual = false;
			$row = array();
			//loop value tabel db
			$row[] = $val->created_at;
			$row[] = $val->order_id;
			$row[] = $val->email;
			$row[] = $val->nama;
			$row[] = $val->telp;
			$row[] = "Rp " . number_format($val->harga,0,',','.');
			if($val->transaction_status == 'settlement'){
				$row[] = '<span class="tag-success">'.$val->transaction_status.'</span>';
			}else if($val->transaction_status == 'failure'){
				$row[] = '<span class="tag-danger">'.$val->transaction_status.'</span>';
			}else if($val->transaction_status == ''){
				if($val->is_manual == '1' && $val->is_confirm == '') {
					$row_manual = true;
					$row[] = '<span class="tag-warning">transfer</span>';
				}else{
					$row[] = '<span class="tag-danger">failure</span>';
				}
			}else if($val->transaction_status == 'capture'){
				$row[] = '<span class="tag-primary">'.$val->transaction_status.'</span>';
			}else{
				$row[] = $val->transaction_status;
			}
			
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<a class="dropdown-item" href="'.base_url('confirm_jual/detail/').$val->id.'">
							<i class="la la-paste"></i> Detail
						</a>
						
			';
			
			if($row_manual) {
				$str_aksi .= '<button class="dropdown-item" onclick="set_failure(\'' . $val->id . '\')">
							<i class="la la-ban"></i> Flag Ke Failure
						</button>';
			}else{
				$str_aksi .= '<button class="dropdown-item" onclick="update_trans(\'' . $val->order_id . '\')">
							<i class="la la-trash"></i> Update Transaksi
						</button>';
			}
			
			
			$str_aksi .= '</div></div>';
			$row[] = $str_aksi;
			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->t_checkout->count_all(),
			"recordsFiltered" => $this->t_checkout->count_filtered($tgl_awal, $tgl_akhir, $status, $is_manual),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	/////////////////////////////////////////////

	public function konfirmasi_penjualan()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$id_checkout = $this->input->post('id_checkout');
		$kode_aff = $this->input->post('kode_aff');
		$pesan_email = $this->input->post('pesan_email');
		$txt_email = strip_tags($pesan_email);

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();

		//cek data existing
		$cek = $this->t_checkout->get_by_condition("is_confirm is null and id = '$id_checkout' and deleted_at is null", true);
		if(!$cek) {
			$dataret['inputerror'][] = '';
            $dataret['error_string'][] = '';
			$dataret['status'] = FALSE;
			$dataret['err'] = TRUE;
			echo json_encode($dataret);
			return;
		}else{
			// $send_email = $this->send_email(trim($cek->email), 'Undangan Meeting Zoom', $txt_email);
			$send_email = true;
			if($send_email){
				$update_checkout = $this->t_checkout->update(['id' => $cek->id], ['is_confirm' => 1, 'status_confirm' => 'diterima']);
				## cek user apakah aktif ?
				$user_data = $this->m_global->single_row('*', ['kode_agen' => $cek->kode_agen], 'm_user');
				if($user_data) {
					## aktifkan user
					if($user_data->status == null) {
						$upd = $this->m_global->update('m_user', ['status' => 1, 'updated_at' => $timestamp], ['id' => $user_data->id]);
					}
					## isi affiliate
					else{
						$update_user = $this->m_global->update('m_user', ['kode_affiliate' => $kode_aff, 'updated_at' => $timestamp], ['id' => $user_data->id]);
					}
				}
				if($update_checkout) {
					$data_mail['id_checkout'] = $cek->id;
					$data_mail['isi_email'] = $pesan_email;
					$data_mail['created_at'] = $timestamp;
					$insert = $this->m_global->store($data_mail, 't_email');
				}
			}
		}

		
	
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal Konfirmasi';
			$dataret['err'] = TRUE;
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses Konfirmasi';
			$dataret['err'] = FALSE;
		}

		echo json_encode($retval);
	}

	public function send_email($receiver_email, $subject, $message)
	{
		// Storing submitted values
		$sender_email = 'admin@sarasdavina.com';
		$user_password = 'admin@sarasdavina.com';
		$username = 'admin@sarasdavina.com';

		// Configure email library
		$config['protocol'] = 'http';
		$config['smtp_host'] = 'mx1.hostinger.in';
		$config['smtp_timeout'] = '7';
		$config['smtp_port'] = 110;
		$config['charset']    = 'utf-8';
		$config['newline']    = "\r\n";
		$config['mailtype'] = 'text'; // or html
		//$config['validation'] = TRUE; // bool whether to validate email or not
		$config['smtp_user'] = $sender_email;
		$config['smtp_pass'] = $user_password;

		// Load email library and passing configured values to email library
		$this->load->library('email', $config);
		$this->email->set_newline("\r\n");

		// Sender email address
		$this->email->from($sender_email, $username);
		// Receiver email address
		$this->email->to($receiver_email);
		// Subject of email
		$this->email->subject($subject);
		// Message in email
		$this->email->message($message);

		if ($this->email->send()) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function set_failure()
	{
		$id = $this->input->post('id');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		
		//get old data
		$oldData = $this->t_checkout->get_by_id($id);
		
		$data['is_confirm'] = 1;
		$data['status_confirm'] = 'dibatalkan';
		$data['updated_at'] =  $timestamp;
		$upd = $this->t_checkout->update(['id' => $id], $data);
		
		if ($upd) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Transaksi sukses Flag';
		} else {
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Transaksi gagal Flag';
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

		if ($this->input->post('pesan_email') == '') {
			$data['inputerror'][] = 'pesan_email';
            $data['error_string'][] = 'Wajib Mengisi Email';
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

	private function generate_kode_ref() {

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
		$cek_exist_koderef = $this->t_checkout->get_by_condition(['kode_ref' => $token], true);
		if($cek_exist_koderef) {
			$this->generate_kode_ref();
		}else{
			return $token;
		}
	}
}
