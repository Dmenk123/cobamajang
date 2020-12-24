<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Penjualan_selesai extends CI_Controller {
	
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
			'title' => 'Data Penjualan Selesai',
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
			'js'	=> 'confirm_jual.js',
			'view'	=> 'view_penjualan_selesai'
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

		$list = $this->t_checkout->get_datatable($tgl_awal, $tgl_akhir, $status, $is_manual, true);
		
		$data = array();
		// $no =$_POST['start'];
		foreach ($list as $val) {
			// $no++;
			$row = array();
			//loop value tabel db
			$row[] = $val->created_at;
			$row[] = $val->order_id;
			$row[] = $val->email;
			$row[] = $val->nama;
			$row[] = $val->telp;
			$row[] = "Rp " . number_format($val->harga,0,',','.');
			
			
			$str_aksi = '
				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> Opsi</button>
					<div class="dropdown-menu">';
			
			$str_aksi .= '<button class="dropdown-item" onclick="batalkan_transaksi(\'' . $val->id . '\')">
							<i class="la la-ban"></i> Batalkan Konfirmasi
						</button>';
			
			$str_aksi .= '<button class="dropdown-item" onclick="kembalikan_transaksi(\'' . $val->id . '\')">
						<i class="la la-ban"></i> kembalikan Ke Proses Awal
					</button>';
			
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

	public function batalkan_transaksi()
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

		if($upd) {
			$user_data = $this->m_global->single_row('*', ['kode_agen' => $oldData->kode_agen, 'id_role' => 3, 'status' => 1], 'm_user');
			if($user_data) {
				## non aktifkan user
				$upd = $this->m_global->update('m_user', ['status' => null, 'updated_at' => $timestamp], ['id' => $user_data->id]);
			}
		}
		
		if ($upd) {
			$retval['status'] = TRUE;
			$retval['pesan'] = 'Data Transaksi sukses Flag';
		} else {
			$retval['status'] = FALSE;
			$retval['pesan'] = 'Data Transaksi gagal Flag';
		}

		echo json_encode($retval);
	}

	public function kembalikan_transaksi()
	{
		$id = $this->input->post('id');
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		
		//get old data
		$oldData = $this->t_checkout->get_by_id($id);
		
		$data['is_confirm'] = null;
		$data['status_confirm'] = null;
		$data['updated_at'] =  $timestamp;
		$upd = $this->t_checkout->update(['id' => $id], $data);

		if($upd) {
			$user_data = $this->m_global->single_row('*', ['kode_agen' => $oldData->kode_agen, 'id_role' => 3, 'status' => 1], 'm_user');
			if($user_data) {
				## non aktifkan user
				$upd = $this->m_global->update('m_user', ['status' => null, 'updated_at' => $timestamp], ['id' => $user_data->id]);
			}
		}
		
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
