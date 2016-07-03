<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cungtot_catagory extends MY_Controller {

	function __construct(){
		parent::__construct();
		
		if($this->session->userdata('data') != 'success'){
			  redirect('login');
		}
       $this->load->model('category_model');
       $this->privilage->checkLevel();
		$this->linkRedirect  = 'cungtot-catagory';
	}
	public function index(){

		$listCategory = $this->category_model->listCategory(null,'id,name,parent,order,status,alias');
		//print_r($listCategory);
		if(isset($_POST['submit'])){
			//echo '<pre>';print_r($_POST);
		}
		$data = array(
					'content'=>'category/list',
					'controller'=>'Category',
					'action'=>'index',
					'title'=>'Admin :: Category :: List',
					'post'=>$listCategory,
					);
		$this->load->view('../../layout/template_admin',$data);
		
	}
	
	public function add(){
		
		$parent = $this->category_model->listCategory();
		/*echo '<pre>';print_r($parent);*/

		if(isset($_POST['submit'])){
			//echo '<pre>';print_r($_POST);
			$config = array(
							array( 
								'field' => 'name',
						 		'label' => 'Category Name', 			
						 		'rules' => 'required|is_unique[cungtot_category.name]'
							 ),
						);
			$this->form_validation->set_rules($config);
			
			if ($this->form_validation->run()){
				$options = array(
                				'task'=>'add',
                				'data'=>$_POST,
                				);
				//print_r($options);
               $this->category_model->save($options);
               redirect($this->linkRedirect);
			}
		}
		$data = array(
					'content'=>'category/add',
					'controller'=>'Category',
					'action'=>'add',
					'parent'=>$parent,
					'title'=>'Admin :: Category :: Add'
					);
		$this->load->view('../../layout/template_admin',$data);
		
	}

	public function isNameExist($name) {
	    $is_exist = $this->category_model->isNameExist($name);

	    if ($is_exist) {
	        $this->form_validation->set_message(
	            'isNameExist', 'Name Category Đã tồn tại.'
	        );    
	        return false;
	    } else {
	        return true;
	    }
	}
	public function edit($id){
		$parent = $this->category_model->listCategory();
		$infoCategory = $this->category_model->infoCategory($id);
		if(isset($_POST['submit'])){
			//echo '<pre>';print_r($_POST);
			$config = array(
							array( 
								'field' => 'name',
						 		'label' => 'Category Name', 			
						 		'rules' => 'required'
							 ),
						);
			$this->form_validation->set_rules($config);
			
			if ($this->form_validation->run()){
				$options = array(
                				'task'=>'edit',
                				'id'=>$id,
                				'data'=>$_POST,
                				);
				//print_r($options);
               $this->category_model->save($options);
               redirect($this->linkRedirect);
			}
		}
		$data = array(
					'content'=>'category/edit',
					'controller'=>'Category',
					'action'=>'Edit',
					'parent'=>$parent,
					'title'=>'Admin :: Category :: Edit',
					'info'=>$infoCategory,
					);
		$this->load->view('../../layout/template_admin',$data);
		
	}
	public function delete($id){
		$this->category_model->delete($id);
		redirect($this->linkRedirect);
	}
	public function multiDelete(){
		/*echo 'multiDelete';
		echo '<pre>';print_r($_POST['checkbox']);*/
		foreach ($_POST['checkbox'] as $value) {
			$this->category_model->delete($value);
		}
        $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Thông báo !! Bạn Đã xóa thành công !!'));
         redirect($this->linkRedirect);
	}
	public function filter($status,$id){
		/*echo $status;
		echo $id;*/
		if($status == 0){
			$status = 1;
		}else{
			$status = 0;
		}
		 $this->category_model->update($id,$status);
         redirect($this->linkRedirect);
	}
	public function status($status){
		
		foreach ($_POST['checkbox'] as $id) {
			$this->category_model->update($id,$status);
		}
		
		redirect($this->linkRedirect);
	}
	public function combine_arr($a, $b) 
	{ 	

	    $acount = count($a); 
	    $bcount = count($b); 
	    $size = ($acount > $bcount) ? $bcount : $acount; 
	    $a = array_slice($a, 0, $size); 
	    $b = array_slice($b, 0, $size); 
	    return array_combine($a, $b); 
	} 
	
	public function order(){
	
		$arr = $this->combine_arr($_POST['checkbox'],$_POST['order']);
		
		foreach ($arr as $id => $order) {
			$this->category_model->updateOrder($id,$order);
		}
		
		redirect($this->linkRedirect);
	}

}