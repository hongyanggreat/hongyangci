<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends Ci_Controller {
	
	function __construct(){
		parent::__construct();
	}

	public function index(){	
       $data = array(
					'content' =>'../shopping/shop_products',
					'controller' =>'Products',
					'action'     =>'Add Products',
					'title'      =>'Add Product',
					);
		$this->load->view('../../layout/template_admin',$data);
	}
	
	
}

