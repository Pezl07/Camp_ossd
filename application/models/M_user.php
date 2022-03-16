<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Da_user.php';

class M_user extends Da_user {
	
	function get_user_list() {
		try {
			$filter = [];
			$query = new MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching users: ' . $ex->getMessage(), 500);
		}
	}

	function get_user($_id) {
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

}