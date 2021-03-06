<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Camp_controller extends CI_Controller{

	function __construct()
	{
		parent :: __construct();
		date_default_timezone_set("Asia/Bangkok");
		session_start();
		$this->load->model('M_user');
		$this->load->model('M_activity_type');
		$this->load->model('M_item');
		$this->load->model('M_order_item');
		$this->load->model('M_team');
		$this->load->model('M_assess');
		$this->load->model('M_activity');
	}

    public function output($views = '', $data = []) {
		if($_SESSION['user'] !== NULL){
			$data['views'] = ucfirst(substr($views,2));
			$this->load->view('/template/header', $data);
			$this->load->view($views, $data);
			$this->load->view('/template/footer', $data);
		}else{
			redirect('/C_Login');
		}
	}
	
	public function page_error() {
			$this->load->view('v_404page');
	}

	public function check($val){
		echo "<pre>"; print_r($val); echo "</pre>";
	}
}
