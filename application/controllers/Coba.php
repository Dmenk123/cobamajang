<?php
//defined('BASEPATH ') OR exit('No direct script access allowed');

class Coba extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{	
		$tahun = date('Y');
		$bulan = date('m');
		$hari = date('d');
		$data_dashboard = [];
		
		/**
		 * data passing ke halaman view content
		 */
		$data = array();


		$this->load->view('v_coba', $data, FALSE);
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

}
