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

			$data['activities'] = $this->M_assess->get_assess_list($_SESSION['user']->_id, $data['day'], $data['type_id']);
			$assess = $data['activities'];
			$assess = count(iterator_to_array($assess));

			if($assess == 0){
				$data['activities'] = $this->M_activity->get_activity_list($data['day'], $data['type_id']);
			}


			$data['activity_types'] = $this->M_activity_type->get_activity_type_list();
			$this->output('v_assess', $data);

		}else{
			redirect('/');
		}
	}

	function test(){
		
		$date = '2022-04-07';
		$type = 'ALL';

		// $activities = $this->M_activity->get_activity_list($date, $type);
		echo $_SESSION['user']->_id;
		$activities = $this->M_assess->get_assess_list();

		// echo array_count_values($activities);

		echo '<pre>';
		// print_r($activities);

		// if($activities){
		// 	echo '<h1>มี</h1>';
		// }else{
		// 	echo '<h1>ไม่มี</h1>';
		// }
		// $count = 0;

		// echo count($activities->toArray());

		// // echo '<pre>'; 
		foreach ($activities as $activity){
			print_r($activity);
			// $count++;
		}
		// echo '<br> <h1>'. $count .'</h1>';
		echo '</pre>';
	}
	
}
