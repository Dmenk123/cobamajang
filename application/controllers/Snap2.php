<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Snap2 extends CI_Controller
{

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

		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods: PUT, GET, POST');
		header('Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept');

		$params = array('server_key' => 'SB-Mid-server-sZaLLb9rc5_mfPasoa9Hy96d', 'production' => false);
		$this->load->library('midtrans');
		$this->midtrans->config($params);
		$this->load->helper('url');
		$this->load->model('snapmodel');
	}

	public function index()
	{
		$this->load->view('checkout_snap2');
	}

	function test() {
		$arr = array(
			array(
				'id' => 'a1',
		  		'price' => 18000,
		  		'quantity' => 3,
		  		'name' => "Apple"
			),
			array(
				'id' => 'a2',
		  		'price' => 20000,
		  		'quantity' => 2,
		  		'name' => "Orange"
			)
		);

		echo "<pre>";
		var_dump($arr);

		foreach($arr as $item) {
			echo "<pre>";
			var_dump($item);
		}
	}

	public function detail() {
		$arr = $this->input->post('produk');

		if (is_array($arr)) {
			$res = 'this is array';
		} else {
			$res = 'not array';
		}
		echo json_encode(array(
			'result' => $res,
			'produk' => $arr
		));

		// Required
		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => 13504000, // no decimal allowed for creditcard
		  );
  
		  
  
		  // Optional
		  $item1_details = array(
			'id' => 'a1',
			'price' => 18000,
			'quantity' => 3,
			'name' => "Apple"
		  );
  
		  // Optional
		  $item2_details = array(
			'id' => 'a2',
			'price' => 20000,
			'quantity' => 2,
			'name' => "Orange"
		  );
  
		  // Optional
		  $item_details = $arr; // array ($item1_details, $item2_details);
  
		  // Optional
		  $billing_address = array(
			'first_name'    => "Andri",
			'last_name'     => "Litani",
			'address'       => "Mangga 20",
			'city'          => "Jakarta",
			'postal_code'   => "16602",
			'phone'         => "081122334455",
			'country_code'  => 'IDN'
		  );
  
		  // Optional
		  $shipping_address = array(
			'first_name'    => "Obet",
			'last_name'     => "Supriadi",
			'address'       => "Manggis 90",
			'city'          => "Jakarta",
			'postal_code'   => "16601",
			'phone'         => "08113366345",
			'country_code'  => 'IDN'
		  );
  
		  // Optional
		  $customer_details = array(
			'first_name'    => "Andri",
			'last_name'     => "Litani",
			'email'         => "andri@litani.com",
			'phone'         => "081122334455",
			'billing_address'  => $billing_address,
			'shipping_address' => $shipping_address
		  );
  
		  // Data yang akan dikirim untuk request redirect_url.
		  $credit_card['secure'] = true;
		  //ser save_card true to enable oneclick or 2click
		  //$credit_card['save_card'] = true;
  
		  $time = time();
		  $custom_expiry = array(
			  'start_time' => date("Y-m-d H:i:s O",$time),
			  'unit' => 'minute', 
			  'duration'  => 2
		  );
		  
		  $transaction_data = array(
			  'transaction_details'=> $transaction_details,
			  'item_details'       => $item_details,
			  'customer_details'   => $customer_details,
			  'credit_card'        => $credit_card,
			  'expiry'             => $custom_expiry
		  );
  
		  error_log(json_encode($transaction_data));
		  $snapToken = $this->midtrans->getSnapToken($transaction_data);
		  error_log($snapToken);
		  echo $snapToken;
	}

	public function token2()
    {
		
		// Required
		$transaction_details = array(
		  'order_id' => rand(),
		  'gross_amount' => 94000, // no decimal allowed for creditcard
		);

		

		// Optional
		$item1_details = array(
		  'id' => 'a1',
		  'price' => 18000,
		  'quantity' => 3,
		  'name' => "Apple"
		);

		// Optional
		$item2_details = array(
		  'id' => 'a2',
		  'price' => 20000,
		  'quantity' => 2,
		  'name' => "Orange"
		);

		// Optional
		$item_details = array ($item1_details, $item2_details);

		// Optional
		$billing_address = array(
		  'first_name'    => "Andri",
		  'last_name'     => "Litani",
		  'address'       => "Mangga 20",
		  'city'          => "Jakarta",
		  'postal_code'   => "16602",
		  'phone'         => "081122334455",
		  'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
		  'first_name'    => "Obet",
		  'last_name'     => "Supriadi",
		  'address'       => "Manggis 90",
		  'city'          => "Jakarta",
		  'postal_code'   => "16601",
		  'phone'         => "08113366345",
		  'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
		  'first_name'    => "Andri",
		  'last_name'     => "Litani",
		  'email'         => "andri@litani.com",
		  'phone'         => "081122334455",
		  'billing_address'  => $billing_address,
		  'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
        $credit_card['secure'] = true;
        //ser save_card true to enable oneclick or 2click
        //$credit_card['save_card'] = true;

        $time = time();
        $custom_expiry = array(
            'start_time' => date("Y-m-d H:i:s O",$time),
            'unit' => 'minute', 
            'duration'  => 2
        );
        
        $transaction_data = array(
            'transaction_details'=> $transaction_details,
            'item_details'       => $item_details,
            'customer_details'   => $customer_details,
            'credit_card'        => $credit_card,
            'expiry'             => $custom_expiry
        );

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	function items2() {
		$this->load->model('Model_Checkout');

		$shopperId = 8; //$this->session->userId;
		// snap midtrans data jamak
		$checkoutItems = $this->Model_Checkout->getCheckoutItems($shopperId);
		$arrItem = array();
		$tot = 0;
		foreach ($checkoutItems as $item) {
			$data = array(
				'id' => $item->item_id,
				'price' => $item->product_price,
				'quantity' => $item->item_qty,
				'name' => $item->product_title
			);
			array_push($arrItem, $data);

			$tot += (int) $item->product_price;
		}

		echo $tot;
		echo "<pre>";
		var_dump($arrItem);
		echo "</pre>";
	}
	
	function items() {
		$items = array(2, 7);
		$this->db->where_in('product_id', $items);
		$query = $this->db->get('tbl_product');

		$arr = array();
		$tot = 0;
		foreach($query->result_array() as $row) {
			$data = array(
				'id' => $row['product_id'],
				'price' => $row['product_price'],
				'quantity' => 1,
				'name' => $row['product_title']
			);

			array_push($arr, $data);

			$tot += (int) $row['product_price'];
		}

		echo $tot;
		echo "<pre>";
		var_dump($arr);
		echo "</pre>";
	}

	public function token()
	{
		///////////////////////////////////////////////////
		$this->load->model('Model_Checkout');

		$shopperId = 8; //$this->session->userId;
		// snap midtrans data jamak
		$checkoutItems = $this->Model_Checkout->getCheckoutItems($shopperId);
		$arr = array();
		$tot = 0;
		foreach ($checkoutItems as $item) {
			$data = array(
				'id' => $item->item_id,
				'price' => $item->product_price,
				'quantity' => $item->item_qty,
				'name' => $item->product_title
			);
			array_push($arr, $data);

			$tot += (int) $item->product_price;
		}


		//////////////////////////////////////////////////

		// Required
		// $transaction_details = array(
		//   'order_id' => rand(),
		//   'gross_amount' => 94000, // no decimal allowed for creditcard
		// );

		$transaction_details = array(
			'order_id' => rand(),
			'gross_amount' => $tot //94000, //$this->input->post('gross_amount'), // no decimal allowed for creditcard
		);

		// Optional
		$item1_details = array(
			'id' => $this->input->post('id'),
			'price' => $this->input->post('price'),
			'quantity' => $this->input->post('quantity'),
			'name' => $this->input->post('name')
		);

		// $arr = array(
		// 	array(
		// 		'id' => 'a1',
		//   		'price' => 18000,
		//   		'quantity' => 3,
		//   		'name' => "Apple"
		// 	),
		// 	array(
		// 		'id' => 'a2',
		//   		'price' => 20000,
		//   		'quantity' => 2,
		//   		'name' => "Orange"
		// 	)
		// );

		// $item1_details = array(
		//   'id' => 'a1',
		//   'price' => 18000,
		//   'quantity' => 3,
		//   'name' => "Apple2"
		// );

		// Optional
		// $item2_details = array(
		// 	'id' => 'a2',
		// 	'price' => 20000,
		// 	'quantity' => 2,
		// 	'name' => "Orange"
		// );

		// Optional Ongkir
		$item3_details = array(
			'id' => 'a3',
			'price' => 40000,
			'quantity' => 3,
			'name' => "Ongkir"
		);

		// Optional
		// $item_details = array($item1_details);
		$item_details = $arr;

		// Optional
		$billing_address = array(
			'first_name'    => "Andri",
			'last_name'     => "Litani",
			'address'       => "Mangga 20",
			'city'          => "Jakarta",
			'postal_code'   => "16602",
			'phone'         => "081122334455",
			'country_code'  => 'IDN'
		);

		// Optional
		$shipping_address = array(
			'first_name'    => "Obet",
			'last_name'     => "Supriadi",
			'address'       => "Manggis 90",
			'city'          => "Jakarta",
			'postal_code'   => "16601",
			'phone'         => "08113366345",
			'country_code'  => 'IDN'
		);

		// Optional
		$customer_details = array(
			'first_name'    => "Andri2",
			'last_name'     => "Litani",
			'email'         => "andri@litani.com",
			'phone'         => "081122334455",
			'billing_address'  => $billing_address,
			'shipping_address' => $shipping_address
		);

		// Data yang akan dikirim untuk request redirect_url.
		$credit_card['secure'] = true;
		//ser save_card true to enable oneclick or 2click
		//$credit_card['save_card'] = true;

		$time = time();
		$custom_expiry = array(
			'start_time' => date("Y-m-d H:i:s O", $time),
			'unit' => 'minute',
			'duration'  => 2
		);

		$transaction_data = array(
			'transaction_details' => $transaction_details,
			'item_details'       => $item_details,
			'customer_details'   => $customer_details,
			// 'credit_card'        => $credit_card,
			// 'expiry'             => $custom_expiry
		);

		error_log(json_encode($transaction_data));
		$snapToken = $this->midtrans->getSnapToken($transaction_data);
		error_log($snapToken);
		echo $snapToken;
	}

	// public function finish2()
	// {
	// 	$result = json_decode($this->input->post('result_data'));
	// 	echo 'RESULT <br><pre>';
	// 	var_dump($result);
	// 	echo '</pre>' ;

	// }

	public function finish()
	{
		$result = json_decode($this->input->post('result_data'));

		if (isset($result->va_number[0]->bank)) {
			$bank = $result->va_number[0]->bank;
		} else {
			$bank = '-';
		}

		if (isset($result->va_number[0]->va_number)) {
			$va_number = $result->va_number[0]->va_number;
		} else {
			$va_number = '-';
		}

		if (isset($result->bca_va_number)) {
			$bca_va_number = $result->bca_va_number;
		} else {
			$bca_va_number = '-';
		}

		if (isset($result->bill_key)) {
			$bill_key = $result->bill_key;
		} else {
			$bill_key = '-';
		}

		if (isset($result->biller_code)) {
			$biller_code = $result->biller_code;
		} else {
			$biller_code = '-';
		}

		if (isset($result->permata_va_number)) {
			$permata_va_number = $result->permata_va_number;
		} else {
			$permata_va_number = '-';
		}

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
			'bca_va_number' => $bca_va_number,
			'permata_va_number' => $permata_va_number,
			'pdf_url' => $result->pdf_url,
			'finish_redirect_url' => $result->finish_redirect_url,
			'bill_key' => $bill_key,
			'biller_code' => $biller_code,
		];

		$return = $this->snapmodel->insert($data);
		if ($return) {
			echo "request pembayaran berhasil dilakukan";
		} else {
			echo "request pembayana gagal dilakukan";
		}

		$this->data['finish'] = json_decode($this->input->post('result_data'));
		// $this->load->view('konfirmasi', $data);
		redirect('thankyou');
	}

	function tes() {
		$mysql_query = "SELECT * FROM contoh ORDER BY co_id DESC";
		$query = $this->db->query($mysql_query);

		$arr = [];
		foreach ($query->result_array() as $row) {
			array_push($arr, $row);
		}

		// echo "<pre>";
		// print_r($arr);

		return $arr;
	}

	function option() {
		$item_details = array(
			'id' => 'a2',
			'price' => 20000,
			'quantity' => 2,
			'name' => "Orange"
		);

		return $item_details;
	}
}