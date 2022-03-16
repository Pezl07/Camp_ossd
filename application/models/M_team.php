<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Da_team.php';

class M_team extends Da_team {
	
	function get_team_list() {
		try {
			$filter = [];
			$query = new MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			return $result;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching teams: ' . $ex->getMessage(), 500);
		}
	}

	function get_score($team) {
		try {
			$filter = ['team' => intval($team)];
			$query = new MongoDB\Driver\Query($filter);

			$result = $this->conn->executeQuery($this->database.'.'.$this->collection, $query);

			foreach($result as $team) {
				return $team;
			}

			return NULL;
		} catch(MongoDB\Driver\Exception\RuntimeException $ex) {
			show_error('Error while fetching team: ' . $ex->getMessage(), 500);
		}
	}

}