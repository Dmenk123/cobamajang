<?php
//defined('BASEPATH ') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('m_user');
		$sess = $this->session->all_userdata();
		if(isset($sess['logged_in'])) {
			if($sess['logged_in'] == true) {
				if($sess['is_agen'] == true){
					return redirect('home');
				}
			}
		}
	}

	public function index()
	{	
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$tanggal = $obj_date->format('Y-m-d');
		
		$data = [];
		$this->load->view('v_template', $data, FALSE);
	}

	public function login()
	{
		$username = clean_string($this->input->post('username'));
		$password =	clean_string($this->input->post('password'));

		$hasil_password = $this->enkripsi->enc_dec('encrypt', $password);

		$data_input = array(
			'data_user'=>$this->input->post('username'),
			'data_password'=>$hasil_password,
		);
		
		$result = $this->m_user->login($data_input);

		if ($result) {
			$this->m_user->set_lastlogin($result->id);
			// unset($data['id_user']);
			$this->session->set_userdata(
				array(
					'username' => $result->username,
					'id_user' => $result->id,
					'last_login' => $result->last_login,
					'id_role' => $result->id_role,
					'logged_in' => true,
					'is_agen' => true
				));

				return redirect('profile');
		}else{
			$this->session->set_flashdata('feedback_failed','Login Gagal, Username atau Password salah.'); 
			redirect('auth');
		}
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


}
