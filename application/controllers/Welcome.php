<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends My_Controller {

	function __construct(){
		parent::__construct();
	}
	public function index(){
		
		$this->load->view('welcome');
		//var_dump($this->captcha);
	}
}