<?php
// defined('BASEPATH ') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {
	
	public function __construct()
	{
        parent::__construct();
        $this->load->model('m_global');
	}

	public function index()
	{	
        $type = $this->input->get('type');
        if(in_array($type, ['reg', 'vip'])){
            $tahun = date('Y');
            $bulan = date('m');
            $hari = date('d');
            $data_dashboard = [];
            
            /**
             * data passing ke halaman view content
             */
            $data = [
                'type' => $type
            ];

            //cek disini 
            $this->load->view('v_template', $data, FALSE);
        }else{
            return redirect('home');
        };
	}

	public function proses_checkout()
	{        
		$kode_ref = $this->generate_kode_ref();
        $cek = $this->m_global->single_row('*',['kode_ref' => $kode_ref], 't_checkout', NULL);
        if($cek) {
            //recursive
            $this->proses_checkout();
        }else{
            $nama = $this->input->post('nama');
            $keterangan = $this->input->post('keterangan');
            $email = $this->input->post('email');
            $telp = $this->input->post('telp');
            $obj_date = new DateTime();
            $timestamp = $obj_date->format('Y-m-d H:i:s');
            $datenow = $obj_date->format('Y-m-d');
            //get harga
            if($keterangan == 'reg') {
                $harga = $this->m_global->single_row('*',['id_talent' => 1, 'jenis_harga' => 1], 't_harga', NULL);
            }else{
                $harga = $this->m_global->single_row('*',['id_talent' => 1, 'jenis_harga' => 2], 't_harga', NULL);
            }
            
            if($harga->is_diskon) {
                $tgl_akhir_diskon = $harga->tgl_akhir_diskon;
                if(strtotime($datenow) > strtotime($tgl_akhir_diskon)) {
                    $diskon = $this->m_global->single_row('*', ['id' => $harga->id_m_diskon], 'm_diskon');
                    $harga_fix = (float)$harga->nilai_harga * (float)$diskon->besaran / 100;
                }else{
                    $harga_fix = $harga->nilai_harga;
                }
            }else{
                $harga_fix = $harga->nilai_harga;
            }

            if($keterangan == 'reg') {
                $txt_ket = 'reguler';
            }else{
                $txt_ket = 'eksklusif';
            }

            $data = [
                'kode_ref' => $kode_ref,
                'email' => $email,
                'nama' => $nama,
                'keterangan' => $txt_ket,
                'harga' => $harga_fix,
                'created_at' => $timestamp
            ];

            $simpan = $this->m_global->store($data, 't_checkout');
            if($simpan) {
                echo json_encode(['status'=>true]);
            }else{
                json_encode(['status'=>false]);
            }
        }
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

}
