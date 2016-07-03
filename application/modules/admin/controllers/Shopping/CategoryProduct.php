<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryProduct extends Ci_Controller {
	function __construct(){
		parent::__construct();
        $this->load->model('CateProduct_model');
		
	}
	public function index(){	
       $data = array(
					'content' =>'../shopping/list_Cate',
					'controller' =>'Cate Product',
					'action'     =>'Add Cate',
					'title'      =>'Add Cate Product',
					);
		$this->load->view('../../layout/template_admin',$data);
  }
  public function ajaxlist(){


		$list = $this->CateProduct_model->get_cate();
		
		$data = array();
		$i=1;
		foreach ($list as $cate) {
			$row = array();
			if($cate->status >0){
				$imgStt = 'fa-check-circle';
				$colorStt = 'green';
			}else{
				$imgStt = 'fa-minus-circle';
				$colorStt = '#770208';
			}
				$status = '<a href="javascript:void(0)" title="Edit" onclick="filter_status('."'".$cate->id."','".$cate->status."'".')"><i style="color:'.$colorStt.';font-size:18px" class="fa '.$imgStt.'" aria-hidden="true"></i></a>';
			$row[] = '<input type="checkbox" class="check" name="checkbox[]" value="'.$cate->id.'">';

			$row[] = $i++;
			$row[] = $cate->name;
			$row[] = $status;

			//add html for action
			$row[] = '<a class="" href="javascript:void(0)" title="Edit" onclick="edit_cate('."'".$cate->id."'".')"><i class="fa fa-pencil fa-fw"></i> Edit</a>
				  <a class="" href="javascript:void(0)" title="Delete" onclick="delete_cate('."'".$cate->id."'".')"><i class="fa fa-trash-o  fa-fw"></i> Delete</a>';
		
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
						'rules' => 'trim|required|is_unique[cate_product.name]|max_length[20]'
				),
				
			);
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run()){
				$data = array(
					'name' => $this->input->post('name'),
					'status' => $this->input->post('status'),
					'alias' => changTitle($this->input->post('name')),
				);
				$this->CateProduct_model->save($data);
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

		$data = $this->CateProduct_model->get_by_id($id);
		echo json_encode($data);
		
	}


	public function ajax_update()
	{

		$data = array('status'=>false,'messages'=>'');

			$config = array(
				array( 'field' => 'name', 		
						'label' => 'name', 			
						'rules' => 'trim|required|max_length[20]|callback_name_check'
				),
				array( 'field' => 'status', 		
						'label' => 'status', 			
						'rules' => 'trim|required'
				),
				
			);
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run()){
				$data = array(
					'name' => $this->input->post('name'),
					'status' => $this->input->post('status'),
					'alias' => changTitle($this->input->post('name')),
				);
				$this->CateProduct_model->update(array('id' => $this->input->post('id')), $data);
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
        $this->db->where('name',$name);

        if($this->db->count_all_results('cate_product') > 0){
			$this->form_validation->set_message('name_check', 'The %s exist in user other');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function ajax_filter($id,$status){
		$this->CateProduct_model->update_status($id,$status);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_delete($id){
		$this->CateProduct_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
	public function ajaxStatus($status){
		$output = array('status'=>FALSE);
		if(isset($_POST['checkbox'])){
			foreach ($_POST['checkbox'] as $id) {
				$this->CateProduct_model->update_status($id,$status);
			}
				$output['status'] = true;
		}else{
			$output['status'] = false;
		}
		echo json_encode($output);
		
	}
	
}

