<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Da_team extends CI_Model {

    protected $database = 'Camp_Ossd';
	protected $collection = 'team';
	protected $conn ;

	function __construct() {
		parent::__construct();
		$this->load->library('mongodb');
		$this->conn = $this->mongodb->getConn();
	}

	function update_score($team, $score) {
		try {
			$query = new MongoDB\Driver\BulkWrite();
			$query->update(['team' => intval($team)], ['$set' => array('score' => intval($score))]);

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