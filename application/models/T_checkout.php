<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class T_checkout extends CI_Model
{
	var $table = 't_checkout';
	var $column_search = ['ckt.created_at', 'ckt.order_id', 'ckt.email', 'ckt.nama', 'ckt.telp', 'ckt.keterangan', 'ckt.harga', 'req.transaction_status'];
	
	var $column_order = [
		'ckt.created_at',
		'ckt.order_id',
		'ckt.email',
		'ckt.nama',
		'ckt.telp',
		'ckt.keterangan',
		'ckt.harga',
		'req.transaction_status',
		null
	];

	var $order = ['ckt.created_at' => 'desc']; 

	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}

	private function _get_datatables_query($arr_data, $term='')
	{
		$this->db->select("ckt.*, req.status_message, req.transaction_id, req.gross_amount, req.payment_type, req.transaction_time, req.transaction_status, req.fraud_status");
		
		$this->db->from($this->table.' ckt');
		$this->db->join('tbl_requesttransaksi req', 'ckt.order_id  = req.order_id', 'left');
		if($arr_data['tgl_awal'] != ''){
			$this->db->where("ckt.created_at >=", $arr_data['tgl_awal'].' 00:00:00');
		}

		if($arr_data['tgl_akhir'] != ''){
			$this->db->where("ckt.created_at <=", $arr_data['tgl_akhir'].' 23:59:59');
		}
				
		if($arr_data['status'] != 'all'){
			$this->db->where("req.transaction_status", $arr_data['status']);
		}
		
		$this->db->where("ckt.is_confirm is NULL");
		$i = 0;

		// loop column 
		foreach ($this->column_search as $item) 
		{
			// if datatable send POST for search
			if($_POST['search']['value']) 
			{
				// first loop
				if($i===0) 
				{
					// open bracket. query Where with OR clause better with bracket. because maybe can combine with other WHERE with AND.
					$this->db->group_start();
					$this->db->like($item, $_POST['search']['value']);
				}
				else
				{
					if($item == 'tipe_harga') {
						/**
						 * param both untuk wildcard pada awal dan akhir kata
						 * param false untuk disable escaping (karena pake subquery)
						 */
						$this->db->or_like('(CASE WHEN h.jenis_harga = 1 THEN \'Reguler\' ELSE \'Eksklusif\' END)', $_POST['search']['value'],'both',false);
					}
					else{
						$this->db->or_like($item, $_POST['search']['value']);
					}
				}
				//last loop
				if(count($this->column_search) - 1 == $i) 
					$this->db->group_end(); //close bracket
			}
			$i++;
		}

		if(isset($_POST['order'])) // here order processing
		{
			$this->db->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		} 
		if(isset($_POST['order']) && $_POST['order']['0']['column'] != '0') 
		{
			$order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatable($tgl_awal="", $tgl_akhir="", $status="")
	{
		$term = $_REQUEST['search']['value'];
		$arr_data = ['tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir, 'status' => $status];
		$this->_get_datatables_query($arr_data, $term);
		
		if($_REQUEST['length'] != -1)
		$this->db->limit($_REQUEST['length'], $_REQUEST['start']);

		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered($tgl_awal="", $tgl_akhir="", $status="")
	{
		$arr_data = ['tgl_awal' => $tgl_awal, 'tgl_akhir' => $tgl_akhir, 'status' => $status];
		$this->_get_datatables_query($arr_data);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_datatable_trans_manual()
	{
		$this->db->select("ckt.*");
		$this->db->from($this->table.' ckt');
		$this->db->where("ckt.is_confirm is null and is_manual = '1' and deleted_at is null");
		$query = $this->db->get();
		return $query->result();
	}

	public function get_data_laporan($tgl_awal, $tgl_akhir)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('is_confirm', 1);
		$this->db->where('status_confirm', 'diterima');
		$this->db->where("created_at >=", $tgl_awal.' 00:00:00');
		$this->db->where("created_at <=", $tgl_akhir.' 23:59:59');
		$this->db->where('deleted_at is null');
		$query = $this->db->get();
		return $query->result();
	}

	public function get_saldo_awal_lap($datetime)
	{
		$q = $this->db->query("SELECT (sum(harga)) as saldo_awal FROM t_checkout where deleted_at is null and is_confirm = 1 and status_confirm = 'diterima' and created_at <= '".$datetime."'")->row();

		if ($q->saldo_awal != null) {
			return $q->saldo_awal;
		}else{
			return 0;
		}
	}

	public function get_detail_by_id($id)
	{
		$this->db->select("ckt.*, req.status_message, req.transaction_id, req.gross_amount, req.payment_type, req.transaction_time, req.transaction_status, req.fraud_status");
		
		$this->db->from($this->table.' ckt');
		$this->db->join('tbl_requesttransaksi req', 'ckt.order_id  = req.order_id', 'left');
		$this->db->where("ckt.is_confirm is null and ckt.id = '$id'");
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row();
        }else{
			return false;
		}
	}
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function get_by_condition($where, $is_single = false)
	{
		$this->db->from($this->table);
		$this->db->where($where);
		$query = $this->db->get();
		if($is_single) {
			return $query->row();
		}else{
			return $query->result();
		}
	}

	public function save($data)
	{
		return $this->db->insert($this->table, $data);	
	}

	public function update($where, $data)
	{
		return $this->db->update($this->table, $data, $where);
	}

	public function softdelete_by_id($id)
	{
		$obj_date = new DateTime();
		$timestamp = $obj_date->format('Y-m-d H:i:s');
		$where = ['id' => $id];
		$data = ['deleted_at' => $timestamp];
		return $this->db->update($this->table, $data, $where);
	}

	
	public function get_max_id()
	{
		$q = $this->db->query("SELECT MAX(id) as kode_max from $this->table");
		$kd = "";
		if($q->num_rows()>0){
			$kd = $q->row();
			return (int)$kd->kode_max + 1;
		}else{
			return '1';
		} 
	}
}