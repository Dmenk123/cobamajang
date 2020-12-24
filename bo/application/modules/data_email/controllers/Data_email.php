<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_email extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('t_email');
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
			'title' => 'Data Email',
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
			'js'	=> 'data_email.js',
			'view'	=> 'view_data_email'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_email()
	{
		$obj_date = new DateTime();
		$list = $this->t_email->get_datatable();
		// echo $this->db->last_query();exit;
		$data = array();
		// $no =$_POST['start'];
		foreach ($list as $val) {
			// $no++;
			$row = array();
			//loop value tabel db
			$row[] = $val->created_at;
			$row[] = (isset($val->order_id)) ? $val->order_id : '-'; 
			$row[] = $val->isi_email;
			$row[] = $val->email;
			$row[] = $val->nama;
			if($val->tipe_kirim == 'Manual'){
				$row[] = '<span class="tag-success">'.$val->tipe_kirim.'</span>';
			}else{
				$row[] = '<span class="tag-primary">'.$val->tipe_kirim.'</span>';
			}
			
			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->t_email->count_all(),
			"recordsFiltered" => $this->t_email->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function add()
	{
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);

		$txt_email = "<p>Kepada Yth.</p>";
		$txt_email .= "<ul>";
		$txt_email .= "<li>Nama : </li>";
		$txt_email .= "<li>Email : </li>";
		$txt_email .= "</ul>";
		$txt_email .= "<p>Terima kasih telah melakukan pendaftaran kelas bla-bla-bla. Berikut link Zoom beserta jadwal kursus.</p>";
		$txt_email .= "<ul>";
		$txt_email .= "<li><strong>Jadwal : Hari / DD-MM-YYYY Pukul HH:MM</strong></li>";
		$txt_email .= "<li><strong>Link: www.zoom.com/asoy</strong></li>";
		$txt_email .= "</ul>";
		$txt_email .= "<p> Salam Sukses.</p>";

		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Tulis Email',
			'data_user' => $data_user,
			'txt_email' => $txt_email
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
			'js'	=> 'data_email.js',
			'view'	=> 'view_add_data_email'
		];

		$this->template_view->load_view($content, $data);
	}

	public function kirim_email_manual()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$nama = $this->input->post('nama');
		$email = $this->input->post('email');
		$subjek = $this->input->post('subjek');
		$pesan_email = $this->input->post('pesan_email');
		$txt_email = strip_tags($pesan_email);

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();

		$send_email = $this->send_email(trim($email), trim($subjek), $txt_email);
		if($send_email){
			$data_mail['isi_email'] = $pesan_email;
			$data_mail['created_at'] = $timestamp;
			$insert = $this->m_global->store($data_mail, 't_email');
		}
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal Kirim Email';
			$dataret['err'] = TRUE;
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses Kirim Email';
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
            $data['error_string'][] = 'Wajib Mengisi email';
			$data['status'] = FALSE;
		}

		if ($this->input->post('subjek') == '') {
			$data['inputerror'][] = 'subjek';
            $data['error_string'][] = 'Wajib Mengisi subjek';
			$data['status'] = FALSE;
		}
		
		if ($this->input->post('pesan_email') == '') {
			$data['inputerror'][] = 'pesan_email';
            $data['error_string'][] = 'Wajib Mengisi Email';
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
