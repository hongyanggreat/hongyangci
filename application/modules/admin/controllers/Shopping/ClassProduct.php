<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClassProduct extends Ci_Controller {
	function __construct(){
		parent::__construct();
        $this->load->model('ClassProduct_model');
	}
	public function index(){	
       $data = array(
					'content' =>'../shopping/list_class',
					'controller' =>'Class Product',
					'action'     =>'Add Class',
					'title'      =>'Add Class Product',
					);
		$this->load->view('../../layout/template_admin',$data);
	}
	public function ajaxlist(){


		$list = $this->ClassProduct_model->get_classProduct	();

		$data = array();
		$i=1;
		foreach ($list as $class) {
			$row = array();
			if($class->status >0){
				$imgStt = 'fa-check-circle';
				$colorStt = 'green';
			}else{
				$imgStt = 'fa-minus-circle';
				$colorStt = '#770208';
			}
				$status = '<a href="javascript:void(0)" title="Edit" onclick="filter_status('."'".$class->id."','".$class->status."'".')"><i style="color:'.$colorStt.';font-size:18px" class="fa '.$imgStt.'" aria-hidden="true"></i></a>';
			$row[] = '<input type="checkbox" class="check" name="checkbox[]" value="'.$class->id.'">';

			$row[] = $i++;
			$row[] = $class->name;
			$row[] = $class->alias;
			$row[] = $status;
			$cate_product = $this->db->where('id',$class->cate_product)->get('cate_product')->row();

			$row[] = $cate_product->name;

			//add html for action
			$row[] = '<a class="" href="javascript:void(0)" title="Edit" onclick="edit_class('."'".$class->id."'".')"><i class="fa fa-pencil fa-fw"></i> Edit</a>
				  <a class="" href="javascript:void(0)" title="Delete" onclick="delete_class('."'".$class->id."'".')"><i class="fa fa-trash-o  fa-fw"></i> Delete</a>';
		
			$data[] = $row;
		}

		$output = array(
						"data" => $data,
				);
		//output to json format

		echo json_encode($output);
	}
	public function ajax_add()
	{
		$data = array('status'=>false,'messages'=>'');

			$config = array(
				array( 'field' => 'name', 		
						'label' => 'name', 			
						'rules' => 'trim|required|callback_name_check|max_length[20]'
				),
				array( 'field' => 'cat_menu', 		
						'label' => 'cat_menu', 			
						'rules' => 'trim|required'
				),
				
			);
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run()){
				$data = array(
					'name'         => strtolower($this->input->post('name')),
					'status'       => $this->input->post('status'),
					'cate_product' => $this->input->post('cat_menu'),
					'alias' => changTitle($this->input->post('name')),
				);
				$this->ClassProduct_model->save($data);
				$data['status'] = TRUE;
			}else{
				foreach ($_POST as $key => $value) {
					$data['messages'][$key] = form_error($key);
				}
			}
		
		//print_r($data);
		echo json_encode($data);
	}
	public function ajax_edit($id)
	{

		$data = $this->ClassProduct_model->get_by_id($id);
		echo json_encode($data);
		
	}


	public function ajax_update()
	{

		$data = array('status'=>false,'messages'=>'');

			$config = array(
				array( 'field' => 'name', 		
						'label' => 'name', 			
						'rules' => 'trim|required|callback_name_check'
				),
				array( 'field' => 'cat_menu', 		
						'label' => 'cat_menu', 			
						'rules' => 'trim|required'
				),
				
			);
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run()){
				$data = array(
					'name'         => strtolower($this->input->post('name')),
					'status'       => $this->input->post('status'),
					'cate_product' => $this->input->post('cat_menu'),
					'alias' => changTitle($this->input->post('name')),
				);
				$this->ClassProduct_model->update(array('id' => $this->input->post('id')), $data);
				$data['status'] = TRUE;
			}else{
				foreach ($_POST as $key => $value) {
					$data['messages'][$key] = form_error($key);
				}
			}
		
		//print_r($data);
		echo json_encode($data);
	}
	public function name_check($name)
	{

		$this->db->where_not_in('id',$this->input->post('id'));
        $this->db->where('name',strtolower($name));
        $this->db->where('cate_product',$this->input->post('cat_menu'));

        if($this->db->count_all_results('class_products') > 0){
			$this->form_validation->set_message('name_check', 'The %s exist in user other');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function ajax_filter($id,$status){
		$this->ClassProduct_model->update_status($id,$status);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_delete($id){
		$this->ClassProduct_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	public function ajaxStatus($status){
		$output = array('status'=>FALSE);
		if(isset($_POST['checkbox'])){
			foreach ($_POST['checkbox'] as $id) {
				$this->ClassProduct_model->update_status($id,$status);
			}
				$output['status'] = true;
		}else{
			$output['status'] = false;
		}
		echo json_encode($output);
		
	}
	
}

