<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Camp_controller.php';

class C_Dashboard extends Camp_controller {

    function show_dashboard($type_id = NULL) {

		if(isset($type_id)){
			$data['type_id'] = $type_id;
		}else{
			$data['type_id'] = "ALL";
		}

		$data['activity_types'] = $this->M_activity_type->get_activity_type_list();

		$this->output('v_dashboard', $data);
	}	

}
