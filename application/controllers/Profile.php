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
		$kode_affiliate = $profile->kode_affiliate;
		$email_agen = $profile->email;

		$arr_komisi = $this->list_komisi_history($kode_affiliate);
		$q = $this->m_user->get_komisi_belum_tarik($kode_affiliate );
		// echo $this->db->last_query();exit;
		
		$qq = $this->m_user->get_komisi_sudah_tarik($kode_affiliate );
		$qqq = $this->m_user->get_komisi_pending_tarik($kode_affiliate );
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

	public function list_pre_komisi_history($id_agen)
	{
		$list = $this->m_user->get_data_pre_komisi($id_agen);

		$data = array();
		$no = 0;
		foreach ($list as $datalist) {
			$link_detail = site_url('profile/komisi_detail/') . $datalist->id;
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = date('d-m-Y H:i', strtotime($datalist->created_at));
			$row[] = "Rp. " . number_format($datalist->laba_agen_total, 0, ",", ".");
			$row[] = $datalist->kode_ref;
			$data[] = $row;
		} //end loop

		return $data;
	}

	public function list_after_komisi_history($id_agen)
	{
		$list = $this->m_user->get_data_after_komisi($id_agen);
		$data = array();
		$no = 0;
		foreach ($list as $datalist) {
			$link_detail = site_url('profile/komisi_detail/') . $datalist->id;
			$no++;
			$row = array();
			//loop value tabel db
			$row[] = $no;
			$row[] = date('d-m-Y H:i', strtotime($datalist->tanggal_verify));
			$row[] = "Rp. " . number_format($datalist->laba_agen_total, 0, ",", ".");
			$row[] = $datalist->kode_ref;
			$row[] = $datalist->bukti_bayar;
			$data[] = $row;
		} //end loop

		return $data;
	}

	
	public function rincian_komisi()
	{
		$arr_komisi = [];
		$arr_komisi_pre =[];
		$id_user = clean_string($this->session->userdata('id_user'));

		if ($this->session->userdata('id_role') != '3') {
			return redirect('home','refresh');
		}

		//userdata
		$userdata = $this->m_user->get_by_condition(['status' => 1, 'id' => $id_user], true);

		// var_dump($userdata);exit;
		$kode_agen = $userdata->kode_agen;
		$kode_affiliate = $userdata->kode_affiliate;
		$arr_komisi_belum = $this->list_komisi_history($kode_affiliate);
		$arr_komisi_pre = $this->list_pre_komisi_history($kode_affiliate);
		$arr_komisi_after = $this->list_after_komisi_history($kode_affiliate);
	
		$data = [
			'data_user' => $userdata,
			'data_komisi_belum' => $arr_komisi_belum,
			'data_komisi_pre' => $arr_komisi_pre,
			'data_komisi_after' => $arr_komisi_after
		];

		// echo "<pre>";
		// print_r ($data);
		// echo "</pre>";
		// exit;

		$this->load->view('v_template', $data, FALSE);
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

	public function tarik_komisi()
	{
		$kode_klaim = $this->generate_kode_ref();
		
        $cek = $this->m_global->single_row('*',['kode_klaim' => $kode_klaim], 't_klaim_agen', NULL);
        if($cek) {
            //recursive
            $this->tarik_komisi();
		}else{
			$id_user = clean_string($this->session->userdata('id_user'));
			$userdata = $this->m_user->get_by_condition(['status' => 1, 'id' => $id_user], true);
			$kode_agen = $userdata->kode_agen;
			$kode_affiliate = $userdata->kode_affiliate;

			$q = $this->m_user->get_komisi_belum_tarik($kode_affiliate);
			$qq = $this->m_user->get_komisi_sudah_tarik($kode_affiliate);

			if ((int)$q->total_laba == 0) {
				echo json_encode([
					'status' => FALSE
				]);
				return;
			}
			
			$this->db->trans_begin();
			$id_klaim_agen = $this->m_global->gen_uuid();
			
			//update flag is tarik
			$update_flag_tarik = $this->m_user->set_komisi_sudah_klaim($kode_affiliate, $id_klaim_agen);
			
			//catat ke t_klaim_agen
			if ($qq->total_laba) {
				$saldo_sebelum = $qq->total_laba; 
			}else{
				$saldo_sebelum = 0;
			}

			$data = array(
				'id' => $id_klaim_agen,
				'kode_agen' => $kode_agen,
				'saldo_sebelum' => $saldo_sebelum,
				'jumlah_klaim' => (int)$q->total_laba,
				'saldo_sesudah' => (int)$qq->total_laba + (int)$q->total_laba,
				'datetime_klaim' => date('Y-m-d H:i:s'),
				'created_at' => date('Y-m-d H:i:s'),
				'kode_klaim' => $kode_klaim
			);

			$insert = $this->m_global->store($data, 't_klaim_agen');

			if ($this->db->trans_status() === FALSE) {
				$this->db->trans_rollback();
				$status = FALSE;
			} else {
				$this->db->trans_commit();			
				$status = TRUE;
			}

			echo json_encode([
				'status' => $status,
				'kode_klaim' => $kode_klaim
			]);
		}
	}
	


}
