<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lap_penjualan extends CI_Controller {
	
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
			'title' => 'Laporan Penjualan',
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
			'js'	=> 'lap_penjualan.js',
			'view'	=> 'view_lap_penjualan'
		];

		$this->template_view->load_view($content, $data);
	}

	public function detail($id)
	{
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);
		$data_detail = $this->t_checkout->get_detail_by_id($id);

		if($data_detail){
			$txt_email = "<p>Kepada Yth.</p>";
			$txt_email .= "<ul>";
			$txt_email .= "<li>Nama :&nbsp;$data_detail->nama</li>";
			$txt_email .= "<li>Email :&nbsp;$data_detail->email</li>";
			$txt_email .= "<li>Order id :&nbsp;$data_detail->order_id</li>";
			$txt_email .= "</ul>";
			$txt_email .= "<p>Terima kasih telah melakukan pendaftaran kelas $data_detail->keterangan. Berikut link Zoom beserta jadwal kursus.</p>";
			$txt_email .= "<ul>";
			$txt_email .= "<li><strong>Jadwal : Hari / DD-MM-YYYY Pukul HH:MM</strong></li>";
			$txt_email .= "<li><strong>Link: www.zoom.com/asoy</strong></li>";
			$txt_email .= "</ul>";
			$txt_email .= "<p>&nbsp;Salam Sukses.</p>";
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
			'txt_email' => $txt_email
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

	public function list_laporan()
	{
		$obj_date = new DateTime();
		$tgl_awal = $obj_date->createFromFormat('d/m/Y', $this->input->post('tgl_awal'))->format('Y-m-d');
		$tgl_akhir = $obj_date->createFromFormat('d/m/Y', $this->input->post('tgl_akhir'))->format('Y-m-d');

		$list = $this->t_checkout->get_data_laporan($tgl_awal, $tgl_akhir);
		$data = array();
		
		$row_satu[] = $tgl_awal;
		$row_satu[] = '-';
		$row_satu[] = '-';
		$row_satu[] = '-';
		$row_satu[] = 'Saldo Awal';
		$row_satu[] = $this->t_checkout->get_saldo_awal_lap($tgl_awal.' 00:00:00');
		$data[] = $row_satu;

		$saldo_akhir = 0;
		foreach ($list as $key => $val) {
			$saldo_akhir = $saldo_akhir + (float)$val->harga;
			$row = array();
			//loop value tabel db
			$row[] = $obj_date->createFromFormat('Y-m-d H:i:s', $val->created_at)->format('Y-m-d');
			$row[] = $val->email;
			$row[] = $val->keterangan;
			$row[] = "Rp " . number_format($val->harga,0,',','.');
			$row[] = 'Penerimaan Dari '.$val->nama;
			$row[] = "Rp " . number_format($saldo_akhir,0,',','.');
			$data[] = $row;
		}//end loop

		$row_akhir[] = $tgl_akhir;
		$row_akhir[] = '-';
		$row_akhir[] = '-';
		$row_akhir[] = '-';
		$row_akhir[] = 'Saldo Akhir';
		$row_akhir[] = "Rp " . number_format($saldo_akhir,0,',','.');
		$data[] = $row_akhir;

		$output = [
			// "draw" => $_POST['draw'],
			// "recordsTotal" => $this->t_checkout->count_all(),
			// "recordsFiltered" => $this->t_checkout->count_filtered(),
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
			$send_email = $this->send_email(trim($cek->email), 'Undangan Meeting Zoom', $txt_email);
			if($send_email){
				$update_checkout = $this->t_checkout->update(['id' => $cek->id], ['is_confirm' => 1, 'status_confirm' => 'diterima']);
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
		$sender_email = 'admin@majangdapatuang.com';
		$user_password = '@admin12329A';
		$username = 'admin@majangdapatuang.com';

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

	/**
	 * isi kolom deleted at dengan datetime now()
	 * dan isi data baru sama persis tanpa diskon
	 */
	public function stop_diskon()
	{
		$id = $this->input->post('id');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		
		//get old data
		$oldData = $this->t_harga->get_by_id($id);
		
		//sofdelete dulu yg lama
		$del = $this->t_harga->softdelete_by_id($id);

		//insert data baru
		$new_id = $this->t_harga->get_max_id();

		$datanew['id'] = $new_id;
		$datanew['jenis_harga'] = $oldData->jenis_harga;
		$datanew['nilai_harga'] = $oldData->nilai_harga;
		$datanew['id_talent'] = $oldData->id_talent;
		$datanew['created_at'] =  $timestamp;

		$insert = $this->t_harga->save($datanew);

		if ($insert) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Diskon sukses distop';
		} else {
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Diskon gagal distop';
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
}
