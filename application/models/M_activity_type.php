<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Da_activity_type.php';

class M_activity_type extends Da_activity_type {
	
	function get_activity_type_list() {
		try {
			$filter = [];
			$options = ['sort'=>array('_id'=>-1)];

			$query = new MongoDB\Driver\Query($filter, $options);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching activity_types: ' . $ex->getMessage(), 500);
		}
	}

	function get_activity_type($_id) {
		try {
			$filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
			$query = new MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			foreach($result as $activity_type) {
				return $activity_type;
			}

			return NULL;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching activity_type: ' . $ex->getMessage(), 500);
		}
	}

}