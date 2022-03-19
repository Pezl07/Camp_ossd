<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Da_assess.php';

class M_assess extends Da_assess {
	
	function get_assess_list($user_id = NULL, $date = NULL, $type = NULL) {
		try {

			if($type != 'ALL')
				$filter = ['user_id' => $user_id, 'date' => $date, 'type' => $type];
			else
				$filter = ['user_id' => $user_id, 'date' => $date];

			$options = ['sort'=>array('_id'=>-1)];

			$query = new MongoDB\Driver\Query($filter, $options);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching assess: ' . $ex->getMessage(), 500);
		}
	}

}