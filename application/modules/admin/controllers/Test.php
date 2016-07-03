 
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Test extends MY_Controller {

	function __construct(){
		parent::__construct();
	}

 	function index()
	{
		
		$error = '';
		if(isset($_POST['submit'])){
			print_r($_POST);
			$source = 'public/upload/test';
			if(!is_dir($source)){
				mkdir($source);
			}
			
			$config['upload_path'] = $source;
			$config['allowed_types'] = 'gif|jpg|png';
			$config['max_size']	= '1000';
			$config['max_width']  = '1024';
			$config['max_height']  = '768';

			$this->load->library('upload', $config);
			if ($this->upload->do_upload())
			{
				$data = array('upload_data' => $this->upload->data());
			}
			else
			{
				$error = $this->upload->display_errors();
			}
		}

		$this->load->view('test/upload_form', array('error' => $error));

	}
	function upload(){
	 	$data = array(
					'content' =>'tets',
					'controller' =>'Products',
					'action'     =>'Add Products',
					'title'      =>'Add Product',
					);
		$this->load->view('../../layout/template_admin',$data);

	}
	function upload2(){
		if(isset($_POST['submit'])){
			echo '<pre>';print_r($_POST);
			$source = 'public/upload/admin/shopping';
			$config = array(

	 			'upload_path'=>$source,
	 			'allowed_types'=>'gif|jpg|png|jpeg',
	 			'file_name'=>RandomString(10),
	 		);
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('fImages'))
			{
				$error = array('error' => $this->upload->display_errors());
				print_r($error);
			}
			else
			{
				$data = array('upload_data' => $this->upload->data());
				print_r($data);
			}
		}else{
			echo 'c';
		}
	 	$data = array(
					'content' =>'tets_2',
					'controller' =>'Products',
					'action'     =>'Add Products',
					'title'      =>'Add Product',
					);
		$this->load->view('../../layout/template_admin',$data);

	}
	function process(){
		print_r($_POST);
		$source = 'public/upload/admin/shopping';
		$config = array(

 			'upload_path'=>$source,
 			'allowed_types'=>'gif|jpg|png|jpeg',
 			'file_name'=>RandomString(10),
 		);
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('fImages'))
		{
			$error = array('error' => $this->upload->display_errors());
			print_r($error);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
			print_r($data);
		}
	}
	



}