<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Master_diskon extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('m_diskon');
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
			'title' => 'Pengelolaan Data Diskon',
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
			'modal' => 'modal_master_diskon',
			'js'	=> 'master_diskon.js',
			'view'	=> 'view_master_diskon'
		];

		$this->template_view->load_view($content, $data);
	}

	public function list_diskon()
	{
		$obj_date = new DateTime();
		$list = $this->m_diskon->get_datatable();
		$data = array();
		$no =$_POST['start'];
		foreach ($list as $val) {
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = $val->nama;
			$row[] = $val->kode_ref_diskon;
			$row[] = $val->besaran.' %';
			// $row[] = $obj_date->createFromFormat('d-m-Y H:i:s', $val->tgl_mulai_diskon)->format('d/m/Y');
			// $row[] = $obj_date->createFromFormat('d-m-Y H:i:s', $val->tgl_akhir_diskon)->format('d/m/Y');
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">
						<button class="dropdown-item" onclick="edit_diskon(\''.$val->id.'\')">
							<i class="la la-pencil"></i> Edit Diskon
						</button>
						<button class="dropdown-item" onclick="delete_diskon(\''.$val->id.'\')">
							<i class="la la-trash"></i> Hapus
						</button>
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
			"recordsTotal" => $this->m_diskon->count_all(),
			"recordsFiltered" => $this->m_diskon->count_filtered(),
			"data" => $data
		];
		
		echo json_encode($output);
	}

	public function edit_diskon()
	{
		$this->load->library('Enkripsi');
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);
	
		$id = $this->input->post('id');
		$oldData = $this->m_diskon->get_by_id($id);
		
		if(!$oldData){
			return redirect($this->uri->segment(1));
		}
		
		$data = array(
			'data_user' => $data_user,
			'old_data'	=> $oldData
		);
		
		echo json_encode($data);
	}

	public function add_data_diskon()
	{
		$this->load->library('Enkripsi');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$nama = trim($this->input->post('nama'));
		$besaran = trim($this->input->post('besaran'));
		$kode_ref = trim($this->input->post('kode_ref'));

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}
		
		$this->db->trans_begin();

		$datanya = [
			'nama' => $nama,
			'besaran' => $besaran,
			'kode_ref_diskon' => $kode_ref,
			'created_at' => $timestamp,
		];
		
		$insert = $this->m_diskon->save($datanya);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal menambahkan diskon';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses menambahkan diskon';
		}

		echo json_encode($retval);
	}

	public function update_data_diskon()
	{
		$sesi_id_user = $this->session->userdata('id_user'); 
		
		$this->load->library('Enkripsi');
		$obj_date = new DateTime();
		
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		
		
		$arr_valid = $this->rule_validasi();

		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$id_diskon = $this->input->post('id_diskon');
		$nama = trim($this->input->post('nama'));
		$besaran = trim($this->input->post('besaran'));
		$kode_ref = trim($this->input->post('kode_ref'));
		
		$this->db->trans_begin();

		$datanya = [
			'nama' => $nama,
			'besaran' => $besaran,
			'kode_ref_diskon' => $kode_ref
		];

		$where = ['id' => $id_diskon];

		$update = $this->m_diskon->update($where, $datanya);

		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$data['status'] = false;
			$data['pesan'] = 'Gagal update Master Diskon';
		}else{
			$this->db->trans_commit();
			$data['status'] = true;
			$data['pesan'] = 'Sukses update Master Diskon';
		}
		
		echo json_encode($data);
	}

	/**
	 * Hanya melakukan softdelete saja
	 * isi kolom updated_at dengan datetime now()
	 */
	public function delete_diskon()
	{
		$id = $this->input->post('id');
		$del = $this->m_diskon->softdelete_by_id($id);
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Master Diskon dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Master Diskon dihapus';
		}

		echo json_encode($retval);
	}

	/**
	 * get data untuk select2 (dipakai dimana-mana)
	 */
	public function get_select_diskon()
	{
		$term = $this->input->get('term');
		$data_diskon = $this->m_global->multi_row('*', ['deleted_at' => null, 'nama like' => '%'.$term.'%'], 'm_diskon', null, 'nama');
		if($data_diskon) {
			foreach ($data_diskon as $key => $value) {
				$row['id'] = $value->id;
				$row['text'] = $value->nama.' - '.$value->kode_ref_diskon.' ['.$value->besaran.'%]';
				$row['nama'] = $value->nama;
				$row['koderef'] = $value->kode_ref_diskon;
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

		if ($this->input->post('nama') == '') {
			$data['inputerror'][] = 'nama';
            $data['error_string'][] = 'Wajib Memilih Nama Diskon';
            $data['status'] = FALSE;
		}

		if ($this->input->post('kode_ref') == '') {
			$data['inputerror'][] = 'kode_ref';
            $data['error_string'][] = 'Wajib Memilih Kode Ref';
            $data['status'] = FALSE;
		}

		if ($this->input->post('besaran') == '') {
			$data['inputerror'][] = 'besaran';
            $data['error_string'][] = 'Wajib Memilih Besaran';
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
