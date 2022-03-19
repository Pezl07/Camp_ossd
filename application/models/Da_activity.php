<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Da_activity extends CI_Model {

    protected $database = 'Camp_Ossd';
	protected $collection = 'activity';
	protected $conn ;

	function __construct() {
		parent::__construct();
		$this->load->library('mongodb');
		$this->conn = $this->mongodb->getConn();
	}

	function insert($ac_name = NULL, $type = NULL, $date = NULL, $max_score = NULL) {

		try {
			$activity = array(
				'ac_name' => $ac_name, 
				'type' => $type, 
				'date' => $date,
				'max_score' => intval($max_score)
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

	function update($id = NULL, $ac_name = NULL, $type = NULL, $max_score = NULL) {
		try {
			$query = new MongoDB\Driver\BulkWrite();
			$query->update(['_id' => new MongoDB\BSON\ObjectId($id)], ['$set' => array('ac_name' => $ac_name, 'type' => $type, 'max_score' => intval($max_score))]);

			$result = $this->conn->executeBulkWrite($this->database.'.'.$this->collection, $query);

			if($result == 1) {
				return TRUE;
			}

			return FALSE;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while updating users: ' . $ex->getMessage(), 500);
		}
	}

	function delete($_id) {
		try {
			$query = new MongoDB\Driver\BulkWrite();
			$query->delete(['_id' => new MongoDB\BSON\ObjectId($_id)]);

			$result = $this->conn->executeBulkWrite($this->database.'.'.$this->collection, $query);

			if($result == 1) {
				return TRUE;
			}

			return FALSE;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while deleting users: ' . $ex->getMessage(), 500);
		}
	}
}