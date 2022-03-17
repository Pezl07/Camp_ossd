<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Da_assess.php';

class M_assess extends Da_assess {
	
	function get_assess_list($user_id = NULL) {
		try {
			$filter = ['user_id' => $user_id];
			$query = new MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching assesss: ' . $ex->getMessage(), 500);
		}
	}

	function get_assess_list_by_type($type = NULL, $user_id = NULL) {
		try {
			$filter = ['type' => $type, 'user_id' => $user_id];
			$query = new MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching assess: ' . $ex->getMessage(), 500);
		}
	}

}