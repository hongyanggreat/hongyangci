<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class UserAjax extends MY_Controller {
	function __construct(){
		parent::__construct();
		 if(($this->session->userdata('data') != 'success')){
              
			  		redirect('login');
		}
		$this->privilage->checkLevel();
		$this->load->model('AjaxUser_model');
		
	}

	
	public function index(){
		$data = array(
				'content' =>'userajax/list',
				'title'   =>'Su dung ajax CURD',
			);
		
		$this->load->view('../../layout/template_admin',$data);
	}
	public function ajaxlist(){

		$list = $this->AjaxUser_model->get_user();
		$data = array();
		$i=1;
		foreach ($list as $person) {
			$row = array();

			if($person->status >0){
				$imgStt = 'fa-check-circle';
				$colorStt = 'green';
			}else{
				$imgStt = 'fa-minus-circle';
				$colorStt = '#770208';
			}
				$status = '<a href="javascript:void(0)" title="Edit" onclick="filter_status('."'".$person->id."','".$person->status."'".')"><i style="color:'.$colorStt.';font-size:18px" class="fa '.$imgStt.'" aria-hidden="true"></i></a>';
			$row[] = $i++;
			$row[] = $person->username;
			//$row[] = $person->password;
			$row[] = $person->email;
			$row[] = $person->level;
			$row[] = $status;
			$row[] = $person->created_at;

			//add html for action
			$row[] = '<a class="" href="javascript:void(0)" title="Edit" onclick="edit_person('."'".$person->id."'".')"><i class="fa fa-pencil fa-fw"></i> Edit</a>
				  <a class="" href="javascript:void(0)" title="Delete" onclick="delete_person('."'".$person->id."'".')"><i class="fa fa-trash-o  fa-fw"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"data" => $data,
				);
		//output to json format

		echo json_encode($output);
	}

	public function ajax_edit($id)
	{

		$data = $this->AjaxUser_model->get_by_id($id);
		echo json_encode($data);
		
	}
	public function ajax_update()
	{

		$data = array(
				'username' => $this->input->post('username'),
				'email' => $this->input->post('email'),
				'level' => $this->input->post('level'),
				'status' => $this->input->post('status'),
			);
		if($this->input->post('password') != ''){
			$data['password']	= sha1(sha1($this->input->post('password')));
		}
		$this->AjaxUser_model->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_add()
	{


		if($this->input->post('password') != ''){
			$data = array(
				'username' => $this->input->post('username'),
				'password' => sha1(sha1($this->input->post('password'))),
				'email' => $this->input->post('email'),
				'email' => $this->input->post('email'),
				'level' => $this->input->post('level'),
				'status' => $this->input->post('status'),
			);
			$insert = $this->AjaxUser_model->save($data);
			echo json_encode(array("status" => TRUE));
		}

	}
	public function ajax_delete($id){
		$this->AjaxUser_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_filter($id,$status){
		$this->AjaxUser_model->update_status($id,$status);
		echo json_encode(array("status" => TRUE));
	}
	
	
}
