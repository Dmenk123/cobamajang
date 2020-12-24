<?php
//defined('BASEPATH ') OR exit('No direct script access allowed');

class Profile extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
		$this->load->model('m_user');
		$sess = $this->session->all_userdata();
		if($sess['logged_in'] == false || $sess['is_agen'] == false) {
			return redirect('auth');
		}
	}

	public function index()
	{	
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$tanggal = $obj_date->format('Y-m-d');
		
		$sess = $this->session->all_userdata();

		$join = [ 
			[
				'table' => 't_checkout',
				'on'	=> 'm_user.kode_agen = t_checkout.kode_agen'
			]
		];
		$profile = $this->m_global->single_row('m_user.*, t_checkout.is_confirm, t_checkout.status_confirm',['m_user.id' => $sess['id_user'], 'm_user.status' => 1], 'm_user', $join);

		$kode_agen = $profile->kode_agen;
		$email_agen = $profile->email;
		$arr_komisi = $this->list_komisi_history($kode_agen);
		$q = $this->m_user->get_komisi_belum_tarik($kode_agen );
		$qq = $this->m_user->get_komisi_sudah_tarik($kode_agen );
		$qqq = $this->m_user->get_komisi_pending_tarik($kode_agen );
		$qqqq = $this->m_user->cek_status_sudah_verify_agen($email_agen);

		if($qqqq){
			if($qqqq->is_confirm == '1'){
				$sts = TRUE;       
			}else{
				$sts = FALSE;
			}    
		}else{
			$sts = FALSE;
		}

		$arr_batine_agen = [
			'komisi_belum' => $q->total_laba,
			'komisi_sudah' => $qq->total_laba,
			'komisi_pending' => $qqq->total_laba
		];
		
		$data = [
			'profile' => $profile,
			'data_komisi' => $arr_komisi,
			'data_laba_agen' => $arr_batine_agen,
			'status_konfirm' => $sts
		];

		
		// echo "<pre>";
		// print_r ($data);
		// echo "</pre>";
		// exit;

		$this->load->view('v_template', $data, FALSE);
	}

	public function list_komisi_history($id_agen)
	{
		$list = $this->m_user->get_data_komisi($id_agen);
		
		$data = array();
		$no = 0;
		foreach ($list as $datalist) {
			$link_detail = site_url('profile/komisi_detail/') . $datalist->id;
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = date('d-m-Y H:i', strtotime($datalist->created_at));
			$row[] = "Rp. ".number_format($datalist->laba_agen_total,0,",",".");
			$row[] = $datalist->kode_ref;
			$data[] = $row;
		} //end loop

		return $data;
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
