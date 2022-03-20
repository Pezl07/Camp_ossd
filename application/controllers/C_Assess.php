<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Camp_controller.php';

class C_Assess extends Camp_controller {

    function show_assess($type_id = 'ALL', $day = NULL) {
		if($_SESSION['user']->role == 'admin' || $_SESSION['user']->role == 'พี่เลี้ยง'){

			
			if($_SESSION['user']->role == 'admin'){

				$data['type_id'] = 'Admin';

			}else{

				if(isset($type_id) && $type_id != 'ALL'){
					$type = $this->M_activity_type->get_activity_type($type_id);
					$data['type_id'] = $type->type_name;
				}else{
					$data['type_id'] = "ALL";
				}

			}

			if(isset($day)){
				$data['day'] = $day;
			}else{
				$data['day'] = '2022-04-07';
				// $data['day'] = date("Y-m-d");
			}

			$data['activities'] = $this->M_activity->get_activity_list($data['day'], $data['type_id']);

			$data['activity_types'] = $this->M_activity_type->get_activity_type_list();
			$this->output('v_assess', $data);

		}else{
			redirect('/');
		}
	}

	function get_score(){
		$obj_assess = $this->input->post();
		$assess = $this->M_assess->get_assess($obj_assess['ac_id'], $obj_assess['user_id'], $obj_assess['date']);

		foreach($assess as $result){
			echo json_encode($result);
		}
	}

	function insert_assess(){
		$obj_assess = $this->input->post();

		$team = $this->M_team->get_score($obj_assess['team']);

		if( count(iterator_to_array($this->M_assess->get_assess($obj_assess['ac_id'], $obj_assess['user_id'], $obj_assess['date']))) ){

			$assess = $this->M_assess->get_assess_by_team($obj_assess['team'], $obj_assess['ac_id'], $obj_assess['user_id'], $obj_assess['date']);
			$team->score -= $assess->score;
			
			$this->M_assess->update($obj_assess['team'], $obj_assess['user_id'], $obj_assess['score'], $obj_assess['ac_id'], $obj_assess['date']);

			$team->score += intval($obj_assess['score']);

			$data['message'] = 'update success';
		}else{
			$this->M_assess->insert($obj_assess['team'], $obj_assess['user_id'], $obj_assess['score'], $obj_assess['ac_id'], $obj_assess['date'], $obj_assess['type']);
			$team->score += intval($obj_assess['score']);
			$data['message'] = 'insert success';
		}

		$this->M_team->update($obj_assess['team'], $team->score);

		echo json_encode($data);
	}
	
}	
