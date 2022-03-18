<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Camp_controller.php';

class C_Assess extends Camp_controller {

    function show_assess($type_id = NULL, $day = NULL) {
		if($_SESSION['user']->role == 'admin' || $_SESSION['user']->role == 'พี่เลี้ยง'){

			
			if($_SESSION['user']->role == 'admin'){

				$data['type_id'] = '62342aa328e2c98b0115edd0';

			}else{

				if(isset($type_id)){
					$data['type_id'] = $type_id;
				}else{
					$data['type_id'] = "ALL";
				}

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
