<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Camp_controller.php';

class C_Dashboard extends Camp_controller {

    function show_dashboard($type_id = NULL) {

		$data['team'] = [0, 0, 0, 0, 0, 0, 0, 0, 0];
		if(isset($type_id) && $type_id != 'ALL'){
			$data['type_id'] = $type_id;

			$type = $this->M_activity_type->get_activity_type($data['type_id']);
			$teams = $this->M_assess->get_assess_list($type->type_name);

			foreach($teams as $team){
				$data['team'][$team->team] += $team->score;
			}

		}else{
			$data['type_id'] = "ALL";
			$teams = $this->M_team->get_team_list();

			foreach($teams as $team){
				$data['team'][$team->team] += $team->score;
			}
		}

		// $this->check($data['team']);

		$data['activity_types'] = $this->M_activity_type->get_activity_type_list();

		$this->output('v_dashboard', $data);
	}	

}
