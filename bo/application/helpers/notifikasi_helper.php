<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
if(!function_exists('get_notifikasi_helper')) {
  
  function get_notifikasi_helper() {
    // Getting CI class instance.
    $CI = get_instance();
    $query = $CI->db->query("
      SELECT
        ckt.*,
        req.status_message,
        req.transaction_id,
        req.gross_amount,
        req.payment_type,
        req.transaction_time,
        req.transaction_status,
        req.fraud_status
      FROM
        t_checkout AS ckt
      LEFT join tbl_requesttransaksi as req on ckt.order_id = req.order_id
      WHERE req.transaction_status = 'capture' and req.fraud_status = 'accept' and ckt.is_confirm is null
    ");
    
    $data = $query->result();
    
    if($data) {
      $retval = $data;
    }else{
      $retval = false;
    }

    return $retval;
  }

}?>