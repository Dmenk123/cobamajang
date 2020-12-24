<?php
//defined('BASEPATH ') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
	}

	public function index()
	{	
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$tanggal = $obj_date->format('Y-m-d');
		$harga = $this->m_global->multi_row('*', ['deleted_at is null' => null], 't_harga');
		// echo $this->db->last_query();exit;
		
		// echo "<pre>";
		// print_r ($harga);
		// echo "</pre>";
		// exit;

		if($harga) {
			foreach ($harga as $key => $value) {
				$arr['harga'] = $value->nilai_harga;
				$arr['harga_txt'] = "Rp " . number_format($value->nilai_harga,0,',','.');
				$arr['laba_agen'] = $value->laba_agen;
				$arr['harga_agen_txt'] = "Rp " . number_format($value->laba_agen,0,',','.');
				$arr['laba_agen_persen'] = $value->laba_agen_persen;
				$arr['harga_coret'] = "Rp " . number_format($value->harga_coret,0,',','.');
				$arr_harga = $arr;
			}
		}else{
			$arr_harga = null;
		}
		
		
		$counter_waktu = false;
		$jml_hari = false;
				
		
		/**
		 * data passing ke halaman view content
		 */
		$data = [
			'harga' => $harga,
			'arr_harga' => $arr_harga,
			'counter_waktu' => $counter_waktu,
			'jml_hari' => $jml_hari
		];

		
		// echo "<pre>";
		// print_r ($data);
		// echo "</pre>";
		// exit;

		$this->load->view('v_template', $data, FALSE);
	}

	public function oops()
	{	
		$this->load->view('login/view_404');
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

	public function logout()
	{
		if ($this->session->userdata('logged_in')) 
		{
			//$this->session->sess_destroy();
			$this->session->unset_userdata('username');
			$this->session->unset_userdata('id_user');
			$this->session->unset_userdata('last_login');
			$this->session->unset_userdata('id_role');
			$this->session->set_userdata(array('logged_in' => false));
			$this->session->set_userdata(array('is_agen' => false));
		}
		
		return redirect('home');
	}


}
