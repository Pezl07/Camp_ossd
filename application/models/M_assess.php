<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Da_assess.php';

class M_assess extends Da_assess {
	
	function get_assess_list($type = NULL) {
		try {

			$filter = ['type' => $type];

			$options = ['sort'=>array('_id'=>-1)];

			$query = new MongoDB\Driver\Query($filter, $options);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching assess: ' . $ex->getMessage(), 500);
		}
	}

	function get_assess($ac_id = NULL, $user_id = NULL, $date = NULL) {
		try {

			$filter = ['ac_id' => new MongoDB\BSON\ObjectId($ac_id), 'user_id' => new MongoDB\BSON\ObjectId($user_id), 'date' => $date];

			$query = new MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching assess: ' . $ex->getMessage(), 500);
		}
	}

}