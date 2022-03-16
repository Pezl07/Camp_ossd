<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Da_item extends CI_Model {

    protected $database = 'Camp_Ossd';
	protected $collection = 'item';
	protected $conn ;

	function __construct() {
		parent::__construct();
		$this->load->library('mongodb');
		$this->conn = $this->mongodb->getConn();
	}

	function insert($name = NULL, $type = NULL, $price = NULL, $quota = NULL) {

		try {
			$item = array(
				'name' => $name, 
				'type' => $type, 
				'price' => intval($price),
				'quota' => intval($quota),
				'status' => 1
			);

			$query = new MongoDB\Driver\BulkWrite();
			$query->insert($item);

			$result = $this->conn->executeBulkWrite($this->database.'.'.$this->collection, $query);

			if($result == 1) {
				return TRUE;
			}

			return FALSE;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while updating item: ' . $ex->getMessage(), 500);
			}
		
	}

	function update($id = NULL, $name = NULL, $type = NULL, $price = NULL, $quota = NULL) {
		try {
			$query = new MongoDB\Driver\BulkWrite();
			$query->update(['_id' => new MongoDB\BSON\ObjectId($id)], ['$set' => array('name' => $name, 'type' => $type, 'price' => intval($price), 'quota' => intval($quota))]);

			$result = $this->conn->executeBulkWrite($this->database.'.'.$this->collection, $query);

			if($result == 1) {
				return TRUE;
			}

			return FALSE;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while updating users: ' . $ex->getMessage(), 500);
		}
	}
}