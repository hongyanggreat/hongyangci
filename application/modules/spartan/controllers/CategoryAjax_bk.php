<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CategoryAjax_lock extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('spanta_model');
	}
	/*public function index(){
		$this->load->view('pages/cateAjax');
	}*/
	public function category(){
		$this->load->view('pages/cateAjax');
	}
	public function categoryAjax($alias){
		$options = array('task'=>'infoCategoryAlias','alias'=>$alias);
		$rowCategoryId = $this->spanta_model->infoCategory($options);
		
		$options = array('task'=>'articleOne','category'=>$rowCategoryId->id);
		$oneArticle = $this->spanta_model->oneArticle($options);
		if(count($oneArticle)<=0){
			echo 'Danh muc chua co bai viet';
			redirect('/my404');
		}
		//print_r($oneArticle);
		
		$options = array('task'=>'lastIn','category'=>$rowCategoryId->id,'limit'=>null);
		$totalArticle = $this->spanta_model->listArticle($options);

		$options = array('task'=>'articleLink','category'=>$rowCategoryId->id,'limit'=>4,'offset'=>0,'id'=>$oneArticle->id);
		$moreArticle = $this->spanta_model->listArticle($options);

		$data = array(
					'title'    =>ucwords(strtolower($rowCategoryId->name).' - tin tức'),
					'content'    =>'pages/cateAjax_2',
					'oneArticle'=>$oneArticle,
					'moreArticle'=>$moreArticle,
					'category'=>$rowCategoryId,
					'limit'=>4

					);
		$this->load->view('../../layout/template_user',$data);
	}
	public function procesAjaxCategory(){
		
		$options = array('limit'=>$_POST['limit'],'category'=>$_POST['category'],'moreid'=>$_POST['id'],'id'=>$_POST['idOne']);
		$result = $this->spanta_model->moreLink($options);
		
		$data = array('listArticle'=>$result,'idOne'=>$_POST['idOne'],'category'=>$_POST['category'],'limit'=>$_POST['limit']);
		$this->load->view('pages/procesAjaxCategory',$data);
	}
	public function success(){
		echo 'a';
	}
	

}