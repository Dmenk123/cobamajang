<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_harga extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('t_harga');
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
			'title' => 'Pengelolaan Harga',
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
			'modal' => 'modal_set_harga',
			'js'	=> 'set_harga.js',
			'view'	=> 'view_set_harga'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_harga()
	{
		$obj_date = new DateTime();
		$list = $this->t_harga->get_datatable();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $val) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = "Rp " . number_format($val->nilai_harga,0,',','.');
			$row[] = ($val->harga_coret) ? "Rp " . number_format($val->harga_coret,0,',','.') : '-';
			$row[] = ($val->laba_agen) ? "Rp " . number_format($val->laba_agen,0,',','.') : '-';
			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->t_harga->count_all(),
			"recordsFiltered" => $this->t_harga->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function add_data()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		$harga = trim($this->input->post('harga'));
		$harga_coret = $this->input->post('harga_coret');
		$laba = $this->input->post('laba');
		$laba_persen = $this->input->post('laba_persen');

		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();

		//ambil data existing
		$cek = $this->t_harga->get_by_condition("deleted_at is null", true);
		if($cek) {	
			//set deleted_at is null
			$this->t_harga->update(['id' => $cek->id], ['deleted_at' => $timestamp]);
		}

		$id = $this->t_harga->get_max_id();
		
		$datanya['id'] = $id;
		$datanya['nilai_harga'] = $harga;
		$datanya['harga_coret'] = $harga_coret;
		$datanya['laba_agen'] = $laba;
		$datanya['laba_agen_persen'] = $laba_persen;
		$datanya['created_at'] = $timestamp;	
		
		$insert = $this->t_harga->save($datanya);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal setting harga';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses setting harga';
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

		if ($this->input->post('harga') == '') {
			$data['inputerror'][] = 'harga';
            $data['error_string'][] = 'Wajib Mengisi Harga';
            $data['status'] = FALSE;
		}
		
		if ($this->input->post('laba') == '') {
			$data['inputerror'][] = 'laba';
			$data['error_string'][] = 'Wajib Memilih Laba';
			$data['status'] = FALSE;
		}

		if ($this->input->post('laba_persen') == '') {
			$data['inputerror'][] = 'laba_persen';
			$data['error_string'][] = 'Wajib Memilih Laba Persen';
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
