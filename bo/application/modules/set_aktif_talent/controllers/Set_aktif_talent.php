<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_aktif_talent extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('t_aktif_talent');
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
			'title' => 'Setting Aktif Talent',
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
			'modal' => 'modal_set_aktif_talent',
			'js'	=> 'set_aktif_talent.js',
			'view'	=> 'view_set_aktif_talent'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_data()
	{
		$obj_date = new DateTime();
		$list = $this->t_aktif_talent->get_datatable();
		$data = array();
		// $no =$_POST['start'];
		foreach ($list as $val) {
			// $no++;
			$row = array();
			$row[] = '<div class="kt-widget__media"><img src="'.'../'.$val->foto_thumb.'"/></div>';
			$row[] = $val->nama_talent;
			$row[] = $obj_date->createFromFormat('Y-m-d H:i:s', $val->created_at)->format('d/m/Y');
			$data[] = $row;
		}//end loop

		$output = [
			"draw" => $_POST['draw'],
			"recordsTotal" => $this->t_aktif_talent->count_all(),
			"recordsFiltered" => $this->t_aktif_talent->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function add_data()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$id_talent = $this->input->post('talent');
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();

		//ambil data existing
		$cek = $this->t_aktif_talent->get_by_condition("id_talent = '$id_talent' and deleted_at is null", true);
		if($cek) {	
			//set deleted_at is null
			$this->t_aktif_talent->update(['id' => $cek->id], ['deleted_at' => $timestamp]);
		}

		$id = $this->t_aktif_talent->get_max_id();
		
		$datanya['id'] = $id;
		$datanya['id_talent'] = $id_talent;
		$datanya['created_at'] = $timestamp;
		
		$insert = $this->t_aktif_talent->save($datanya);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal setting Aktif Talent';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses setting Aktif Talent';
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

		if ($this->input->post('talent') == '') {
			$data['inputerror'][] = 'talent';
            $data['error_string'][] = 'Wajib Memilih Nama Talent';
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
