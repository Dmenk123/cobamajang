<?php
//defined('BASEPATH ') OR exit('No direct script access allowed');

class Confirm extends CI_Controller {
	
	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_global');
	}

	public function index()
	{	
		

		$this->load->view('v_thanks');
    }
    
    public function confirm_success($order_id){
        $trans = $this->m_global->get_transaksi($order_id)->row();
        if(empty($trans)){
            redirect('home/oops');
        }
        $data['order'] = $trans;

        $this->load->view('v_thanks', $data);
    }

    public function confirm_success_transfer($order_id){
        $trans = $this->m_global->get_transaksi($order_id)->row();
        if(empty($trans)){
            redirect('home/oops');
        }
        $data['order'] = $trans;

        $this->load->view('v_thanks_transfer', $data);
    }

}
