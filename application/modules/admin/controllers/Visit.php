 
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Visit extends MYss_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('Visit_model');
		if(($this->session->userdata('data') != 'success')){
              
			  		redirect('login');
		}
		$this->privilage->checkLevel();
	}

 	public function ip_address()
	{
		$result = $this->Visit_model->getIpAddress();
		$data = array(
			'content'    =>'user/ip_address',
			'controller' =>'User',
			'action'     =>'List IP address',
			'title'      =>'List IP Address',
			'result'      =>$result,
		);
		$this->load->view('user/ip_address',$data);
	}


}