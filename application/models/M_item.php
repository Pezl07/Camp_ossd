<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Da_item.php';

class M_item extends Da_item {
	
	function get_item_list() {
		try {
			$filter = [];
			$query = new MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching items: ' . $ex->getMessage(), 500);
		}
	}

	function get_item($_id) {
		try {
			$filter = ['_id' => new MongoDB\BSON\ObjectId($_id)];
			$query = new MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			foreach($result as $item) {
				return $item;
			}

			return NULL;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching item: ' . $ex->getMessage(), 500);
		}
	}

	function get_item_by_item($name) {
		try {
			$filter = ['name' => $name];
			$query = new MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			foreach($result as $item) {
				return $item;
			}

			return NULL;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching item: ' . $ex->getMessage(), 500);
		}
	}

}