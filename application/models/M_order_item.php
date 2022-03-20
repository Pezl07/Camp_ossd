<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Da_order_item.php';

class M_order_item extends Da_order_item {
	
	function get_order_list($team, $date) {
		try {
			if($_SESSION['user']->role != 'admin'){
				$filter = ['team' => $team, 'date' => $date];
			}else{
				$filter = ['date' => $date];
			}
			$options = ['sort'=>array('_id'=>-1)];
			
			$query = new MongoDB\Driver\Query($filter, $options);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching users: ' . $ex->getMessage(), 500);
		}
	}

	function get_order($_id) {
		try {
			$filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
			$query = new MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			foreach($result as $user) {
				return $user;
			}

			return NULL;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching user: ' . $ex->getMessage(), 500);
		}
	}

	function get_check_order($item, $date) {
		try {
			$filter = ['item' => $item, 'date' => $date];
			$options = ['sort'=>array('_id'=>-1)];

			$query = new MongoDB\Driver\Query($filter, $options);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching users: ' . $ex->getMessage(), 500);
		}
	}

	function get_order_items() {
		try {
			$filter = [];
			$options = [];

			$query = new MongoDB\Driver\Query($filter, $options);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching users: ' . $ex->getMessage(), 500);
		}
	}

}