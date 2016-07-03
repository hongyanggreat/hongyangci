<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PrivilageAjax extends MY_Controller {
	function __construct(){
		parent::__construct();
        if(($this->session->userdata('data') != 'success')){
              
			  		redirect('login');
		}
		$this->privilage->checkLevel();
		$this->load->model('AjaxPrivilage_model');
	}
	public function index(){
		$data = array(
					'content'    =>'privilage/list',
					'controller' =>'Danh Sách Router',
					'action'     =>'Danh Sách Router',
					'title'      =>'Danh Sách Router',
					);
		$this->load->view('../../layout/template_admin',$data);
	}
	public function ajaxlist(){
		$list = $this->AjaxPrivilage_model->get_privileges();
		$data = array();
		$i=1;
		foreach ($list as $item) {
			$row = array();

			$row[] = $i++;
			$row[] = $item->name;
			//$row[] = $person->password;
			$row[] = $item->router;
			$row[] = $item->level;
			//add html for action
			$row[] = '<a class="" href="javascript:void(0)" title="Edit" onclick="edit_router('."'".$item->id."'".')"><i class="fa fa-pencil fa-fw"></i> Edit</a>
				  <a class="" href="javascript:void(0)" title="Delete" onclick="delete_router('."'".$item->id."'".')"><i class="fa fa-trash-o  fa-fw"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"data" => $data,
				);
		//output to json format

		echo json_encode($output);
	}
	public function ajax_edit($id){
		$data = $this->AjaxPrivilage_model->get_by_id($id);
		echo json_encode($data);
	}
	public function ajax_update(){
		$config = array(
							array( 
								'field' => 'name',
						 		'label' => 'Name', 			
						 		'rules' => 'required',
							 ),
							array( 
								'field' => 'router',
						 		'label' => 'router', 			
						 		'rules' => 'required',
							 ),
						);
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run()){

		$data = array(
				'name' => $this->input->post('name'),
				'router' => $this->input->post('router'),
				'level' => $this->input->post('level'),
			);
		
		$this->AjaxPrivilage_model->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
		}
	}
	public function ajax_add(){
		$data= array("status" => false,'messages'=>array());
		$config = array(
							array( 
								'field' => 'name',
						 		'label' => 'Name', 			
						 		'rules' => 'required|min_length[3]|max_length[50]',
							 ),
							array( 
								'field' => 'router',
						 		'label' => 'router', 			
						 		'rules' => 'required|is_unique[privileges.router]',
							 ),
							array( 
								'field' => 'level',
						 		'label' => 'Level', 			
						 		'rules' => 'required',
							 ),
						);
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		$this->form_validation->set_rules($config);

		if ($this->form_validation->run()){
			$data = array(
				'name' => $this->input->post('name'),
				'router' => $this->input->post('router'),
				'level' => $this->input->post('level'),
			);
		
		$insert = $this->AjaxPrivilage_model->save($data);
		$data['status'] = TRUE;

		}else{
			
			foreach ($_POST as $key => $value) {
				$data['messages'][$key] = form_error($key);
			}
		}
		echo json_encode($data);


	}
	public function ajax_delete($id){

		$insert = $this->AjaxPrivilage_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

}