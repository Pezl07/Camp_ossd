<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Camp_controller.php';

class C_Shopping extends Camp_controller {

    function show_shopping($page = 1) {
        $data['page'] = $page;
        $this->output('v_shopping', $data);
	}
	
}
