<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class M_user extends CI_Model
{
	var $table = 'm_user';
	
	public function __construct()
	{
		parent::__construct();
		//alternative load library from config
		$this->load->database();
	}

	public function get_detail_user($id_user)
	{
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id', $id_user);

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
		$data = ['deleted_at' => $timestamp, 'status' => null];
		return $this->db->update($this->table, $data, $where);
	}

	//dibutuhkan di contoller login untuk ambil data user
	function login($data){
		return $this->db->select('*')
			->where('username',$data['data_user'])
			->where('password',$data['data_password'])
			->where('status', 1 )
			->where('id_role', 3 ) //role agen
			->get($this->table)->row();
	}

	//dibutuhkan di contoller login untuk set last login
	function set_lastlogin($id){
		$this->db->where('id',$id);
		$this->db->update(
			$this->table, 
			['last_login'=>date('Y-m-d H:i:s')]
		);			
	}

	function get_kode_user(){
            $q = $this->db->query("select MAX(RIGHT(kode_user,5)) as kode_max from m_user");
            $kd = "";
            if($q->num_rows()>0){
                foreach($q->result() as $k){
                    $tmp = ((int)$k->kode_max)+1;
                    $kd = sprintf("%05s", $tmp);
                }
            }else{
                $kd = "00001";
            }
            return "USR-".$kd;
	}
	
	function get_kode_agen(){
		$q = $this->db->query("select MAX(RIGHT(kode_agen,5)) as kode_max from m_user");
		$kd = "";
		if($q->num_rows()>0){
			foreach($q->result() as $k){
				$tmp = ((int)$k->kode_max)+1;
				$kd = sprintf("%05s", $tmp);
			}
		}else{
			$kd = "00001";
		}
		return "MEM-".$kd;
	}

	public function get_max_id_user()
	{
		$q = $this->db->query("SELECT MAX(id) as kode_max from m_user");
		$kd = "";
		if($q->num_rows()>0){
			$kd = $q->row();
			return (int)$kd->kode_max + 1;
		}else{
			return '1';
		} 
	}


	/////////////////////////////////////////////// komisi //////////////////////////////////////////////////////

	private function _get_data_komisi_query($kode_ref) //term is value of $_REQUEST['search']
	{
		$this->db->select('*');

		$this->db->from('t_checkout');
		$this->db->where('t_checkout.kode_ref', $kode_ref);
		$this->db->where('t_checkout.status_confirm', 'diterima'); //status transaksi sudah selesai
		$this->db->where('t_checkout.is_confirm', '1'); //sudah dikonfirmasi bahwa transaksi selesai
		$this->db->where('t_checkout.is_agen_klaim', '0'); //belum di klaim
		$this->db->order_by('DATE(t_checkout.created_at)', 'desc');
	}

	function get_data_komisi($kode_ref)
	{
		$this->_get_data_komisi_query($kode_ref);
		$query = $this->db->get();
		return $query->result();
	}

	private function _get_data_pre_komisi_query($kode_ref) //term is value of $_REQUEST['search']
	{
		$this->db->select('t_checkout.*, t_klaim_agen.kode_klaim');

		$this->db->from('t_checkout');
		$this->db->join('t_klaim_agen', 't_checkout.id_klaim_agen = t_klaim_agen.id', 'left');
		$this->db->where('t_checkout.kode_ref', $kode_ref);
		$this->db->where('t_checkout.status_confirm', 'diterima'); //status transaksi sudah selesai
		$this->db->where('t_checkout.is_confirm', '1'); //sudah dikonfirmasi bahwa transaksi selesai
		$this->db->where('t_checkout.is_agen_klaim', '1');
		$this->db->where('t_checkout.is_verify_klaim', '0');
		$this->db->order_by('DATE(t_checkout.created_at)', 'desc');
	}

	function get_data_pre_komisi($kode_ref)
	{
		$this->_get_data_pre_komisi_query($kode_ref);
		$query = $this->db->get();
		return $query->result();
	}

	private function _get_data_after_komisi_query($kode_ref) //term is value of $_REQUEST['search']
	{
		$this->db->select('t_checkout.*, t_klaim_verify.bukti as bukti_bayar, t_klaim_verify.tanggal_verify, t_klaim_verify.kode_verify');
		$this->db->from('t_checkout');
		$this->db->join('t_klaim_verify', 't_checkout.id_klaim_agen = t_klaim_verify.id_klaim_agen and t_klaim_verify.is_aktif = 1', 'left');
		$this->db->where('t_checkout.kode_ref', $kode_ref);
		$this->db->where('t_checkout.status_confirm', 'diterima'); //status transaksi sudah selesai
		$this->db->where('t_checkout.is_confirm', '1'); //sudah dikonfirmasi bahwa transaksi selesai
		$this->db->where('t_checkout.is_agen_klaim', '1');
		$this->db->where('t_checkout.is_verify_klaim', '1');
		$this->db->order_by('DATE(t_checkout.created_at)', 'desc');
	}

	function get_data_after_komisi($kode_ref)
	{
		$this->_get_data_after_komisi_query($kode_ref);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_id_agen($id_user)
	{
		$this->db->select('kode_agen');
		$this->db->from('m_user');
		$this->db->where('id', $id_user);
		$query = $this->db->get()->row();
		return $query->kode_agen;
	}

	public function get_data_komisi_detail($id_checkout, $id_agen)
	{
		$this->db->select('
			t_checkout.*,
			t_checkout_detail.id,
			t_checkout_detail.harga_satuan,
			t_checkout_detail.harga_subtotal,
			t_checkout_detail.qty,
			m_produk.nama as nama_produk,
			m_produk.kode as kode_produk,
			m_satuan.nama as nama_satuan,
			m_user_detail.nama_lengkap_user,
			(sum(harga_subtotal) * t_log_harga.potongan / 100) as laba_agen
		');

		$this->db->from('t_checkout');
		$this->db->join('t_checkout_detail', 't_checkout.id = t_checkout_detail.id_checkout', 'left');
		$this->db->join('m_produk', 't_checkout_detail.id_produk = m_produk.id', 'left');
		$this->db->join('m_satuan', 't_checkout_detail.id_satuan = m_satuan.id', 'left');
		$this->db->join('m_user_detail', 't_checkout.id_user = m_user_detail.id_user', 'left');
		$this->db->join('t_log_harga', 't_checkout_detail.id_produk = t_log_harga.id_produk and DATE(t_checkout.created_at) >= DATE(t_log_harga.created_at)', 'left');
		$this->db->where('t_checkout.status', "0");
		$this->db->where('t_checkout.id', $id_checkout);
		$this->db->where('t_checkout_detail.id_agen', $id_agen);
		
		$query = $this->db->get();
		return $query->result();
	}

	public function get_komisi_belum_tarik($kode_ref)
	{
		$this->db->select('(sum(laba_agen_total)) as total_laba');
		$this->db->from('t_checkout');
		$this->db->where('kode_ref', $kode_ref);
		$this->db->where('is_confirm', '1');
		$this->db->where('status_confirm', 'diterima');
		$this->db->where('is_agen_klaim', '0');
		$q = $this->db->get();
		return $q->row();
	}

	public function get_komisi_pending_tarik($kode_ref)
	{
		$this->db->select('(sum(laba_agen_total)) as total_laba');
		$this->db->from('t_checkout');
		$this->db->where('kode_ref', $kode_ref);
		$this->db->where('is_confirm', '1');
		$this->db->where('status_confirm', 'diterima');
		$this->db->where('is_agen_klaim', '1');
		$this->db->where('is_verify_klaim', '0');
		$q = $this->db->get();
		return $q->row();
	}

	public function get_komisi_sudah_tarik($kode_ref)
	{
		$this->db->select('(sum(laba_agen_total)) as total_laba');
		$this->db->from('t_checkout');
		$this->db->where('kode_ref', $kode_ref);
		$this->db->where('is_confirm', '1');
		$this->db->where('status_confirm', 'diterima');
		$this->db->where('is_agen_klaim', '1');
		$this->db->where('is_verify_klaim', '1');
		$q = $this->db->get();
		return $q->row();
	}

	public function set_komisi_sudah_klaim($kode_ref, $id_klaim)
	{
		$this->db->update(
			't_checkout', 
			['is_agen_klaim' => 1, 'id_klaim_agen' => $id_klaim], 
			[ 'kode_ref' => $kode_ref, 'is_confirm' => '1', 'status_confirm' => 'diterima', 'is_agen_klaim' => '0']
		);

        if ($this->db->affected_rows() > 0) {
        	return TRUE;
        }else{
        	return FALSE;
        }
	}
	
	public function cek_status_sudah_verify_agen($email)
	{
		$this->db->select('is_confirm');
		$this->db->from('t_checkout');
		$this->db->where('email', $email);
		$q = $this->db->get();
		return $q->row();
	}
	
}