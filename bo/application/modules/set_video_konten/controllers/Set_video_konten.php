<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Set_video_konten extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('logged_in') === false) {
			return redirect('login');
		}

		$this->load->model('t_video_konten');
		$this->load->model('m_global');
		$this->load->model('master_user/m_user');
	}

	public function index()
	{
		$id_user = $this->session->userdata('id_user');
		$data_user = $this->m_user->get_by_id($id_user);

		$select = "tvk.*, mt.nama as nama_talent, tvt.path_video";
		$where = ['tvk.id_talent' => 1, 'tvk.deleted_at' => null];
		$join = [ 
			['table' => 'm_talent mt', 'on' => 'tvk.id_talent = mt.id'],
			['table' => 't_video_talent tvt', 'on' => 'tvk.id_t_video_talent = tvt.id'],
		];
		$data_galeri = $this->m_global->multi_row($select, $where, 't_video_konten as tvk', $join, 'tvk.urutan');
		
		/**
		 * data passing ke halaman view content
		 */
		$data = array(
			'title' => 'Setting Video Konten',
			'data_user' => $data_user,
			'data_galeri' => $data_galeri
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
			'js'	=> 'set_video_konten.js',
			'view'	=> 'view_set_video_konten'
		];

		$this->template_view->load_view($content, $data);
	}

 	/**
	 * get data untuk select2 (dipakai dimana-mana)
	 */
	public function select_video_konten()
	{
		$term = $this->input->get('term');
		$select = "m_talent.id as id_talent, m_talent.nama, t_video_talent.id, t_video_talent.path_video";
		$join = [ 
			['table' => 't_video_talent', 'on' => 'm_talent.id = t_video_talent.id_talent']
		];
		$data_galeri = $this->m_global->multi_row($select, ['m_talent.id' => 1, 't_video_talent.deleted_at' => null, 't_video_talent.path_video like' => '%'.$term.'%'], 'm_talent', $join, 't_video_talent.id');
		
		// echo "<pre>";
		// print_r ($data_galeri);
		// echo "</pre>";
		// exit;

		if($data_galeri) {
			foreach ($data_galeri as $key => $value) {
				$row['id'] = $value->id;
				$row['text'] = $value->nama.' - '.$value->path_video;
				$row['path'] = $value->path_video;
				$retval[] = $row;
			}
		}else{
			$retval = false;
		}
		echo json_encode($retval);
	}

	public function add_data()
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$arr_valid = $this->rule_validasi();
		
		$urutan = $this->input->post('urutan');
		$id_t_video_talent = $this->input->post('sel_video');
		$id_talent = 1; //cuma 1 aja
		
		if ($arr_valid['status'] == FALSE) {
			echo json_encode($arr_valid);
			return;
		}

		$this->db->trans_begin();

		//ambil data existing
		$cek = $this->t_video_konten->get_by_condition("id_talent = '$id_talent' and urutan = '$urutan' and deleted_at is null", true);
		if($cek) {	
			$data['inputerror'][] = 'urutan';
            $data['error_string'][] = 'Urutan Sudah ada';
            $data['status'] = FALSE;
			echo json_encode($data);
			return;
		}

		$id = $this->t_video_konten->get_max_id();
		
		$datanya['id'] = $id;
		$datanya['id_talent'] = $id_talent;
		$datanya['id_t_video_talent'] = $id_t_video_talent;
		$datanya['urutan'] = $urutan;
		$datanya['created_at'] = $timestamp;
		
		$insert = $this->t_video_konten->save($datanya);
		
		if ($this->db->trans_status() === FALSE){
			$this->db->trans_rollback();
			$retval['status'] = false;
			$retval['pesan'] = 'Gagal setting Video Konten';
		}else{
			$this->db->trans_commit();
			$retval['status'] = true;
			$retval['pesan'] = 'Sukses setting Video Konten';
		}

		echo json_encode($retval);
	}

	public function delete_data()
	{
		$id = $this->input->post('id');
		$del = $this->t_video_konten->softdelete_by_id($id);
		
		if($del) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Video Sukses dihapus';
		}else{
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Video Gagal dihapus';
		}

		echo json_encode($retval);
	}

	private function rule_validasi()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('urutan') == '') {
			$data['inputerror'][] = 'urutan';
            $data['error_string'][] = 'Wajib Memilih Nama Urutan';
            $data['status'] = FALSE;
		}

		if ($this->input->post('sel_video') == '') {
			$data['inputerror'][] = 'sel_video';
            $data['error_string'][] = 'Wajib Memilih Nama Video';
            $data['status'] = FALSE;
		}
        return $data;
	}

	///////////////////////////////////////////////////////

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
