<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Transaction extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */


	public function __construct()
    {
        parent::__construct();
        $params = array('server_key' => 'SB-Mid-server-8Qe7WdPLrkQlANXTCWa4qy7x', 'production' => false);
		$this->load->library('veritrans');
		$this->veritrans->config($params);
		$this->load->model('m_global');
		$this->load->helper('url');
		
    }

    public function index()
    {
    	$this->load->view('transaction');
    }

    public function process()
    {
    	$order_id = $this->input->post('order_id');
    	$action = $this->input->post('action');
    	switch ($action) {
		    case 'status':
		        $this->status($order_id);
		        break;
		    case 'approve':
		        $this->approve($order_id);
		        break;
		    case 'expire':
		        $this->expire($order_id);
		        break;
		   	case 'cancel':
		        $this->cancel($order_id);
		        break;
		}

    }

	public function status()
	{
		$order_id = $this->input->post('order_id');
		$result = ($this->veritrans->status($order_id) );

		$bank  		= (isset($result->va_numbers[0]->bank))?$result->va_numbers[0]->bank:"";
		$va_number 	= (isset($result->va_numbers[0]->va_number))?$result->va_numbers[0]->va_number:"";

		$data = [
			'status_code' => $result->status_code,
			'status_message' => $result->status_message,
			'transaction_id' => $result->transaction_id,
			'order_id' => $result->order_id,
			'gross_amount' => $result->gross_amount,
			'payment_type' => $result->payment_type,
			'transaction_time' => $result->transaction_time,
			'transaction_status' => $result->transaction_status,
			'bank' => $bank,
			'va_number' => $va_number,
			'fraud_status' => $result->fraud_status,
		];

		$transaksi = $this->m_global->single_row('*', array('order_id'=>$order_id), 'tbl_requesttransaksi');
		$i = 0;
		if(empty($transaksi)){
			$this->m_global->store_id($data, 'tbl_requesttransaksi');
			$i = $i + 1;
		}else{
			$this->m_global->update('tbl_requesttransaksi', $data, array('order_id'=>$order_id));
			$i = $i + 2;
		}

		if($i > 0){
			$data = array(
				'status' => TRUE,
				'pesan' => "Status Pegawai berhasil di ubah.",
			);
		}else{
			$data = array(
				'status' => FALSE,
				'pesan' => "Data Transaksi tidak ditemukan di Midtrans !.",
			);
		}

		echo json_encode($data);

	}

	public function cancel($order_id)
	{
		echo 'test cancel trx </br>';
		echo $this->veritrans->cancel($order_id);
	}

	public function approve($order_id)
	{
		echo 'test get approve </br>';
		print_r ($this->veritrans->approve($order_id) );
	}

	public function expire($order_id)
	{
		echo 'test get expire </br>';
		print_r ($this->veritrans->expire($order_id) );
	}
}
