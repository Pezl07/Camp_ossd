<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Da_activity_type extends CI_Model {

    protected $database = 'Camp_Ossd';
	protected $collection = 'activity_type';
	protected $conn ;

	function __construct() {
		parent::__construct();
		$this->load->library('mongodb');
		$this->conn = $this->mongodb->getConn();
	}

}