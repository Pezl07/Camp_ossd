<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Camp_controller.php';

class C_Dashboard extends Camp_controller {

    function show_dashboard($type_id = NULL) {

		$data['team'] = [];
		if(isset($type_id) && $type_id != 'ALL'){
			$data['type_id'] = $type_id;

			$teams = $this->M_team->get_team_list();

			foreach($teams as $team){
				array_push($data['team'], $team);
			}
		}else{
			$data['type_id'] = "ALL";
			$teams = $this->M_team->get_team_list();

			foreach($teams as $team){
				array_push($data['team'], $team);
			}
		}

		$data['activity_types'] = $this->M_activity_type->get_activity_type_list();

		$this->output('v_dashboard', $data);
	}	

}
