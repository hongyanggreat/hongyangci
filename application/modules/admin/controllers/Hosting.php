<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hosting extends MY_Controller {
	function __construct(){
		parent::__construct();
		 if(($this->session->userdata('data') != 'success')){
              
			  		redirect('login');
		}
		$this->privilage->checkLevel();
		$this->load->model('Hosting_model');
		
	}

	
	public function index(){
		$data = array(
				'content' =>'hosting/list',
				'title'   =>'My Host',
			);
		
		$this->load->view('../../layout/template_admin',$data);
	}
	public function ajaxlist(){

		$list = $this->Hosting_model->get_user();
		$data = array();
		$i=1;
		foreach ($list as $hosting) {
			$row = array();

			if($hosting->status >0){
				$imgStt = 'fa-check-circle';
				$colorStt = 'green';
			}else{
				$imgStt = 'fa-minus-circle';
				$colorStt = '#770208';
			}
				$status = '<a href="javascript:void(0)" title="Edit" onclick="filter_status('."'".$hosting->id."','".$hosting->status."'".')"><i style="color:'.$colorStt.';font-size:18px" class="fa '.$imgStt.'" aria-hidden="true"></i></a>';
			$row[] = $i++;
			$row[] = $hosting->name;
			$row[] = $hosting->email;
			$row[] = $hosting->password;
			$row[] = $status;
			$row[] = $hosting->date;

			//add html for action
			$row[] = '<a class="" href="javascript:void(0)" title="Edit" onclick="edit_hosting('."'".$hosting->id."'".')"><i class="fa fa-pencil fa-fw"></i> Edit</a>
				  <a class="" href="javascript:void(0)" title="Delete" onclick="delete_hosting('."'".$hosting->id."'".')"><i class="fa fa-trash-o  fa-fw"></i> Delete</a>';
		
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

		$data = $this->Hosting_model->get_by_id($id);
		echo json_encode($data);
		
	}
	public function ajax_update()
	{

		$data = array('status'=>false,'messages'=>'');

			$config = array(
				array( 'field' => 'hosting', 		
						'label' => 'hosting', 			
						'rules' => 'trim|required|max_length[50]'
				),
				array( 'field' => 'email', 		
						'label' => 'email', 			
						'rules' => 'trim|required|valid_email'
				),
				array( 'field' => 'date', 		
						'label' => 'date', 			
						'rules' => 'trim|required'
				),
			);
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run()){
				
				$this->Hosting_model->update($_POST);
				$data['status'] = TRUE;
			}else{
				foreach ($_POST as $key => $value) {
					$data['messages'][$key] = form_error($key);
				}
			}
		
		//print_r($data);
		echo json_encode($data);
	}
	public function ajax_add()
	{
		$data = array('status'=>false,'messages'=>'');

			$config = array(
				array( 'field' => 'hosting', 		
						'label' => 'hosting', 			
						'rules' => 'trim|required|is_unique[hosting.name]|max_length[50]'
				),
				array( 'field' => 'email', 		
						'label' => 'email', 			
						'rules' => 'trim|required|valid_email'
				),
				array( 'field' => 'date', 		
						'label' => 'date', 			
						'rules' => 'trim|required'
				),
			);
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run()){
				
				$this->Hosting_model->save($_POST);
				$data['status'] = TRUE;
			}else{
				foreach ($_POST as $key => $value) {
					$data['messages'][$key] = form_error($key);
				}
			}
		
		//print_r($data);
		echo json_encode($data);
	}
	public function ajax_delete($id){
		$result = $this->Hosting_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
		
	}
	public function ajax_filter($id,$status){
		$this->Hosting_model->update_status($id,$status);
		echo json_encode(array("status" => TRUE));
	}
	
	
}
