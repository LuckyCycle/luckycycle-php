<?php

require_once 'pest/PestJSON.php';

class LuckyCycleApi extends PestJSON
{
	const DEV_URL = 'http://localhost:3000';
	const PROD_URL = 'https://www.luckycycle.com';

	public function __construct($base_url=DEV_URL)
	{
		parent::__construct($base_url);
		//$this->mode =
		$this->content = array();
		$this->cart = array();

	}
	public $content;
	public $cart;
	/**
	 * @var string api key
	 */
	public $api_key;

	/**
	 * @var string operation id
	 */
	public $operation_id;

	/**
	 * @var boolean mode
	 */
	public $mode;

	public function setApiKey($api_key) {
		$this->api_key = $api_key;
	}

	public function setOperationId($operation_id) {
		$this->operation_id = $operation_id;
	}

	public function show() {
		$path = '/api/v1/operations/' . $this->operation_id . '/show';
		$data = array();
		$headers = array( 'X-LuckyApiKey'  =>  $this->api_key );

		return $this->get($path, $data, $headers);
	}
	public function get_content(){
		return $this->content;
	}
	public function set_content($value){
		$this->content = $value;
	}

	public function add_cart_item($item) {
		array_push($this->cart, $item);
		$this->content['cart'] = $this->cart;
	}

	public function poke($data) {
		$path = '/api/v1/operations/' . $this->operation_id . '/poke';
		$headers = array( 'X-LuckyApiKey'  =>  $this->api_key );

		return $this->post($path, $data, $headers);
	}

	public function draw($data) {
		$path = '/api/v1/operations/' . $this->operation_id . '/draw';
		$headers = array( 'X-LuckyApiKey'  =>  $this->api_key );

		return $this->post($path, $data, $headers);
	}

}

?>
