<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cungtot extends My_Controller {

	var $upload_path;
	var $upload_path_url;
	function __construct(){
		parent::__construct();
		//echo privilege('G');

        if(($this->session->userdata('data') != 'success')){
              
			  		redirect('login');
		}
		$this->user = $this->session->userdata('info')->id;
		$this->userlevel = $this->session->userdata('info')->level;
       	$this->load->model('article_model');
       	$this->load->model('category_model');
       	$this->load->model('User_model');

       	$this->upload_path = './public/upload/cungtot'; 
        $this->upload_path_url = base_url().'public/upload/cungtot'; 
        //echo $module = $this->uri->segment(1);
        
		$this->privilage->checkLevel();
		$this->linkRedirect  = 'cungtot-article';
	}
	
	
	public function index(){
		//print_r($this->session->userdata('info'));
		$danhsach = $this->article_model->danhsach();
        //echo '<pre>'; print_r($danhsach);
		
		$data = array(
					'content'    =>'article/list',
					'controller' =>'Danh Sách',
					'action'     =>'Danh Sách Bài viêt',
					'title'      =>'Detail Article',
					'post'       =>$danhsach
					);
		$this->load->view('../../layout/template_admin',$data);
		
	}
	public function allArticle(){
		$danhsach = $this->article_model->listAll();
		$data = array(
					'content'    =>'article/allList',
					'controller' =>'Danh Sách',
					'action'     =>'Danh Sách Bài viêt',
					'title'      =>'Detail Article',
					'post'       =>$danhsach
					);
		$this->load->view('../../layout/template_admin',$data);
		
	}
	public function recycle(){


		$danhsach = $this->article_model->danhsachRecycle();
        //echo '<pre>';print_r($danhsach);
		$data = array(
					'content'    =>'article/recycle',
					'controller' =>'Danh Sách',
					'action'     =>'Bài viêt Rác ',
					'title'      =>'Detail Article',
					'post'       =>$danhsach
					);
		$this->load->view('../../layout/template_admin',$data);
		
	}

	public function add(){
		
		 $_POST['user'] = $this->user;
		
		if(isset($_POST['submit'])){
			//echo '<pre>';print_r($_POST);
			
			$config = array(
							array( 
								'field' => 'title',
						 		'label' => 'Tiêu Đề', 			
						 		'rules' => 'trim|required|is_unique[cungtot_article.title]'
							 ),
							array( 
								'field' => 'cat_menu',
						 		'label' => 'Category', 			
						 		'rules' => 'required',
							 ),
						);
			$this->form_validation->set_rules($config);
			
			if ($this->form_validation->run()){
					$config = array(
				 			'upload_path'=>$this->upload_path,
				 			'allowed_types'=>'gif|jpg|png',
				 			'file_name'=>time()
				 		);
					$this->load->library('upload', $config);
					$result = $this->upload->do_upload('fImages');
					if($result){
						$file =$this->upload->data();
						if($file['file_size'] > 1000){
							$this->session->set_flashdata(array('flash_level'=>'warning','flash_message'=>'Kích thước file quá lớn.Cho phép < 1000kb!'));
						}else{
							$options = array(
                				'image'=>$file['file_name'],
                				'task'=>'add',
                				'data'=>$_POST,
                				);
							
							$this->article_model->save($options);
	               			$this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'success !! Thêm bài Viết Thành Công -Kèm Hình ảnh!'));
							redirect('cungtot-article');
						}
						
					}else{
						$this->session->set_flashdata(array('flash_level'=>'warning','flash_message'=>'Vui Lòng Chọn Hình Ảnh!'));
					/*	
            			$options = array(
                				'task'=>'add',
                				'data'=>$_POST,
                				);
					$this->article_model->save($options);
               			$this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'success !! Thêm bài Viết Thành Công -Không Có Hình ảnh!'));
						redirect($this->linkRedirect);*/
					}
			}
		}
		$parent = $this->category_model->listCategory(array('task'=>'add'));
		$data = array(
					'content'    =>'article/add',
					'controller' =>'Add bài viết',
					'action'     =>'Thêm Bài viêt',
					'parent'     =>$parent,
					'title'      =>'Add Article'
					);
		$this->load->view('../../layout/template_admin',$data);
	}
	public function youtube(){
		
		$_POST['user'] = $this->user;
		if(isset($_POST['submit'])){
			//echo '<pre>';print_r($_POST);
			$config = array(
							array( 
								'field' => 'title',
						 		'label' => 'Title', 			
						 		'rules' => 'required',
							 ),
						);
			$this->form_validation->set_rules($config);
			
			if ($this->form_validation->run()){
					$config = array(
				 			'upload_path'=>$this->upload_path,
				 			'allowed_types'=>'gif|jpg|png|mp4',
				 			'file_name'=>time()
				 		);
					$this->load->library('upload', $config);
					$result = $this->upload->do_upload('fImages');
					if($result){
						$file =$this->upload->data();
						//echo '<pre>';print_r($file);
						$options = array(
                				'image'=>$file['file_name'],
                				'task'=>'add',
                				'data'=>$_POST,
                				);
						$this->article_model->save($options);
               			$this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Danger !! Thêm bài Viết Thành Công -Kèm Hình ảnh!'));
						redirect('cungtot-article');
					}else{
            			$options = array(
                				'task'=>'add',
                				'data'=>$_POST,
                				);
						$this->article_model->save($options);
               			$this->session->set_flashdata(array('flash_level'=>'danger','flash_message'=>'Danger !! Thêm bài Viết Thành Công -Không Có Hình ảnh!'));
						redirect($this->linkRedirect);
					}
			}
		}
		$parent = $this->category_model->listCategory(array('task'=>'add'));
		$data = array(
					'content'    =>'article/youtube',
					'controller' =>'Add bài viết',
					'action'     =>'Thêm Bài viêt',
					'parent'     =>$parent,
					'title'      =>'Add Article'
					);
		$this->load->view('../../layout/template_admin',$data);
	}
	public function edit($id){
		$this->privilage->checkId($id);
		$infoAticle = $this->article_model->infoAticle($id);
		//print_r($infoAticle);
		$_POST['user'] = $this->user;
		/*
		if($infoAticle->article_user != $_POST['user'] ){
			redirect('admin/cungtot');
		}
*/

		if(isset($_POST['submit'])){
			//echo '<pre>';print_r($_POST);
			$config = array(
							array( 
								'field' => 'title',
						 		'label' => 'Title', 			
						 		'rules' => 'required',
							 ),
						);
			$this->form_validation->set_rules($config);
			
			if ($this->form_validation->run()){
				$articlePost = $this->input->post();
				//print_r($articlePost);
				
				$config = array(
				 			'upload_path'=>$this->upload_path,
				 			'allowed_types'=>'gif|jpg|png|mp4',
				 			'file_name'=>time()
				 		);
					$this->load->library('upload', $config);
					$result = $this->upload->do_upload('fImages');
					if($result){
						$file =$this->upload->data();
						//echo '<pre>';print_r($file);
						$options = array(
								'id'=>$id,
								'task'=>'edit',
                				'data'=>$_POST,
                				'image'=>$file['file_name'],
                				);
						$imgCurrent = $this->upload_path.'/'.$articlePost['imgCurrent'];
						 if(is_file($imgCurrent)){

        					unlink($imgCurrent); // delete file
						 }
               			$this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Danger !! Thêm bài Viết Thành Công -Kèm Hình ảnh!'));
					}else{
						$options = array(
								'id'=>$id,
                				'task'=>'edit',
                				'data'=>$_POST,
                				'image'=>$articlePost['imgCurrent'],
                				);
               			$this->session->set_flashdata(array('flash_level'=>'danger','flash_message'=>'Danger !! Thêm bài Viết Thành Công -Không Có Hình ảnh!'));
					}
					
					//echo '<pre>';print_r($options);
					$this->article_model->save($options);
					if($this->user == 1){
					 	redirect('cungtot-article-all');
					 }
					redirect($this->linkRedirect);

			
			}
		}
		$parent = $this->category_model->listCategory();
		$content =  $this->uri->segment(5);

		if($content == 'iframe'){
			$content = 'iframe';
		}else{
			
			$content = 'edit';
		}

		$data = array(
					'content'    =>'article/'.$content,
					'controller' =>'Edit bài viết',
					'action'     =>'Sửa Bài viêt',
					'parent'     =>$parent,
					'title'      =>'Edit Article',
					'info'=>$infoAticle
					);
		$this->load->view('../../layout/template_admin',$data);

	}

	public function delete($id){

		$this->privilage->checkId($id);
		$infoAticle = $this->article_model->infoAticle($id);
		$imgCurrent = $this->upload_path.'/'.$infoAticle->image;
		unlink($imgCurrent);
		$this->article_model->deleteArticle($id);
		$this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'success !! Xoa bài Viết Thành Công!'));
		if($this->user == 1){
		 	redirect('cungtot-article-all');
		 }
		redirect($this->linkRedirect);
	}
	public function multidel(){
		//echo '<pre>';print_r($_POST['checkbox']);
		
		foreach ($_POST['checkbox'] as $id) {
			$this->privilage->checkId($id);
			$this->article_model->multidelArticle($id);
		}
		if($this->user == 1){
		 	redirect('cungtot-article-all');
		 }
		redirect($this->linkRedirect);
	}
	public function filter($status,$id){
		
		$this->privilage->checkEditstatus($id);
		if($status == 0){
			$status = 1;
		}else{
			$status = 0;
		}
		 $this->article_model->update($id,$status);
		 if($this->user == 1){
		 	redirect('cungtot-article-all');
		 }
        redirect($this->linkRedirect);
	}
	

	
}