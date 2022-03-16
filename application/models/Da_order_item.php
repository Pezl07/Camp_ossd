<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Da_order_item extends CI_Model {

    protected $database = 'Camp_Ossd';
	protected $collection = 'order_item';
	protected $conn ;

	function __construct() {
		parent::__construct();
		$this->load->library('mongodb');
		$this->conn = $this->mongodb->getConn();
	}

	function insert($team = NULL, $item = NULL, $type = NULL, $price = NULL, $date = NULL) {

		try {
			$order = array(
				'team' => $team, 
				'item' => $item, 
				'price' => $price,
				'type' => $type,
				'date' => $date
			);

			$query = new MongoDB\Driver\BulkWrite();
			$query->insert($order);

			$result = $this->conn->executeBulkWrite($this->database.'.'.$this->collection, $query);

			if($result == 1) {
				return TRUE;
			}

			return FALSE;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while updating order: ' . $ex->getMessage(), 500);
			}
		
	}

}