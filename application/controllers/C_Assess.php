<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Camp_controller.php';

class C_Assess extends Camp_controller {

    function show_assess($type_id = NULL, $day = NULL) {
		if($_SESSION['user']->role == 'admin'){

			if(isset($type_id)){
				$data['type_id'] = $type_id;
			}else{
				$data['type_id'] = "ALL";
			}

			if(isset($day)){
				$data['day'] = $day;
			}else{
				$data['day'] = date("Y-m-d");
			}

			$data['activity_types'] = $this->M_activity_type->get_activity_type_list();
			$this->output('v_assess', $data);

		}else{
			redirect('/');
		}
	}
	
}
