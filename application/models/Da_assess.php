<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Da_assess extends CI_Model {

    protected $database = 'Camp_Ossd';
	protected $collection = 'assess';
	protected $conn ;

	function __construct() {
		parent::__construct();
		$this->load->library('mongodb');
		$this->conn = $this->mongodb->getConn();
	}

	function insert($team = NULL, $date = NULL, $ac_name = NULL, $type = NULL, $score = NULL) {

		try {
			$assess = array(
				'team' => $team, 
				'date' => $date, 
				'ac_name' => $ac_name,
				'type' => $type,
				'score' => intval($score)
			);

			$query = new MongoDB\Driver\BulkWrite();
			$query->insert($assess);

			$result = $this->conn->executeBulkWrite($this->database.'.'.$this->collection, $query);

			if($result == 1) {
				return TRUE;
			}

			return FALSE;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while updating assess: ' . $ex->getMessage(), 500);
			}
		
	}

	function update($team = NULL, $date = NULL, $ac_name = NULL, $type = NULL,$score = NULL) {
		try {
			$query = new MongoDB\Driver\BulkWrite();
			$query->update(['team' => $team, 'date' => $date, 'ac_name' => $ac_name, 'type' => $type], 
						['$set' => array('score' => intval($score))]);

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