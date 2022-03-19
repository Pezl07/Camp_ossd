<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Da_activity_type extends CI_Model {

    protected $database = 'Camp_Ossd';
	protected $collection = 'activity_type';
	protected $conn ;

	function __construct() {
		parent::__construct();
		$this->load->library('mongodb');
		$this->conn = $this->mongodb->getConn();
	}

	function insert($type_name = NULL) {

		try {
			$activity = array(
				'type_name' => $type_name
			);

			$query = new MongoDB\Driver\BulkWrite();
			$query->insert($activity);

			$result = $this->conn->executeBulkWrite($this->database.'.'.$this->collection, $query);

			if($result == 1) {
				return TRUE;
			}

			return FALSE;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while updating activity: ' . $ex->getMessage(), 500);
			}
		
	}

	function update($_id = NULL, $type_name = NULL) {

		try {
			$query = new MongoDB\Driver\BulkWrite();
			$query->update(['_id' => new MongoDB\BSON\ObjectId($_id)], ['$set' => array('type_name' => $type_name)]);

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