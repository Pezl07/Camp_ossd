<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require dirname(__FILE__) . '/Camp_controller.php';

class C_Login extends Camp_controller {

    function index() {
		$this->load->view('v_login');
	}

	function login() {
		$obj_user = $this->input->post();

		foreach($this->M_user->get_user_list() as $user) {
			if($obj_user['username'] == $user->username && $obj_user['password'] == $user->password){
				$_SESSION['user'] = (object) [
					'_id' => $user->_id,
					'std_id' => $user->std_id,
					'username' => $user->username,
					'name' => $user->name,
					'role' => $user->role,
					'team' => $user->team,
				];
				break;
			}
		}

		if(!isset($_SESSION['user'])){
			$data = $obj_user;
			$data['error'] = 'Username หรือ Password ไม่ถูกต้อง';
			$this->load->view('v_login', $data);
		}else{
			redirect('/');
		}
	}

	function logout(){
		session_destroy();
		redirect('/C_Login');
	}

}