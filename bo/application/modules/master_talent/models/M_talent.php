<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_talent extends CI_Model
{
	var $table = 'm_talent';
	var $column_search = ['nama','deskripsi','akun_ig, akun_fb, akun_tw'];
	
	var $column_order = [
		null, 
		'nama',
		'deskripsi',
		'akun_fb',
		'akun_ig',
		'akun_tw',
		null
	];

	var $order = ['nama' => 'desc']; 

	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}

	private function _get_datatables_query($term='')
	{
		$this->db->select('*');
		$this->db->from($this->table);
		//$this->db->join('m_role', 'm_user.id_role = m_role.id', 'left');	
		$this->db->where('deleted_at is null');
		
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
					$this->db->or_like($item, $_POST['search']['value']);
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
		else if(isset($this->order))
		{
			$order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_datatable()
	{
		$term = $_REQUEST['search']['value'];
		$this->_get_datatables_query($term);
		if($_REQUEST['length'] != -1)
		$this->db->limit($_REQUEST['length'], $_REQUEST['start']);

		$query = $this->db->get();
		return $query->result();
	}

	function count_filtered()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_all()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_detail_talent($id)
	{
		$this->db->select('*');
		$this->db->from('m_user');
		$this->db->where('id', $id);

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
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


	// function get_kode_user(){
    //         $q = $this->db->query("select MAX(RIGHT(kode_user,5)) as kode_max from m_user");
    //         $kd = "";
    //         if($q->num_rows()>0){
    //             foreach($q->result() as $k){
    //                 $tmp = ((int)$k->kode_max)+1;
    //                 $kd = sprintf("%05s", $tmp);
    //             }
    //         }else{
    //             $kd = "00001";
    //         }
    //         return "USR-".$kd;
	// }
	
	

	// public function get_id_pegawai_by_name($nama)
	// {
	// 	$this->db->select('id');
	// 	$this->db->from('m_pegawai');
	// 	$this->db->where('LCASE(nama)', $nama);
	// 	$q = $this->db->get();
	// 	if ($q) {
	// 		return $q->row();
	// 	}else{
	// 		return false;
	// 	}
	// }

	// public function get_id_role_by_name($nama)
	// {
	// 	$this->db->select('id');
	// 	$this->db->from('m_role');
	// 	$this->db->where('LCASE(nama)', $nama);
	// 	$q = $this->db->get();
	// 	if ($q) {
	// 		return $q->row();
	// 	}else{
	// 		return false;
	// 	}
	// }

	// public function trun_master_user()
	// {
	// 	$this->db->query("truncate table m_user");
	// }
}