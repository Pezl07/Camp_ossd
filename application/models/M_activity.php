<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Da_activity.php';

class M_activity extends Da_activity {
	
	function get_activity_list($date = NULL, $type = NULL) {
		try {

			if($type != 'ALL')
				$filter = ['date' => $date, 'type' => $type];
			else
				$filter = ['date' => $date];

			$query = new MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);
			

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching activitys: ' . $ex->getMessage(), 500);
		}
	}

}