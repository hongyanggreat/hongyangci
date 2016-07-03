<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spartan extends My_Controller {

	public function __construct()
    {
            parent::__construct();
            $this->load->model('spanta_model');
            $this->fb = 'https://www.facebook.com/duong579minh493';
            $this->tt = 'https://twitter.com/hongyangtube1';
            $this->gg = 'https://plus.google.com/111898323009326894593/';
            $this->rss = 'https://www.facebook.com/Ki%E1%BA%BFn-Th%E1%BB%A9c-Cho-C%C3%A1c-m%E1%BA%B9-587182408104956/';
            $this->base_url = base_url();
           $this->category = 'ajaxcategory';
           //$this->category = 'category';
    }
	public function index(){
		
		
		$options = array('task'=>'main-menu');
		$listCategory = $this->spanta_model->listCategory($options);		
		$data = array(
					'title'    =>'Trang Tin Tức Nội Dung Hay Nhất',
					'slider'    =>'blocks/slider',
					'content'    =>'pages/index',
					'listCategory'    =>$listCategory,
					
					);
		$this->load->view('../../layout/template_user',$data);
	}
	
	public function category($alias){

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

		$limit = 4;
		if($this->uri->segment(5) >0){
			 $currentPage = $this->uri->segment(5);
		}else{
			
			 $currentPage = 1;
		}
		$offset = $currentPage*$limit-$limit;
		$paginator = paginator_options($totalArticle,$limit,$currentPage,$this->base_url.'spartan/category/'.$alias.'/pages/');

		$options = array('task'=>'articleLink','category'=>$rowCategoryId->id,'limit'=>$limit,'offset'=>$offset,'id'=>$oneArticle->id);
		$moreArticle = $this->spanta_model->listArticle($options);

		$data = array(
					'title'    =>ucwords(strtolower($rowCategoryId->name).' - tin tức'),
					'content'    =>'pages/category',
					'oneArticle'=>$oneArticle,
					'moreArticle'=>$moreArticle,
					'category'=>$rowCategoryId,
					'paginator'=>$paginator,

					);
		$this->load->view('../../layout/template_user',$data);
	}
	
	
	
	public function search(){
		if(isset($_POST['submit']) && !empty($_POST['s'])){
			
			   $keyword = $_POST['s'];			
		}else{
			
			    $keyword = 'Không có từ khóa nào được tìm kiếm';			
		}
		
		
		$limit = 5;
		if($this->uri->segment(5) >0){
			  $currentPage = $this->uri->segment(5);
		}else{
			
			  $currentPage = 1;
		}
		if(!empty($this->uri->segment(3))){

			 $keyword =  $this->uri->segment(3);
		}
		$options = array('task'=>'search','keyword'=>$keyword);
		$totalArticle = $this->spanta_model->listArticle($options);
		
		$offset = $currentPage*$limit-$limit;
		$base_url = $this->base_url.'search/keyword/'.$keyword.'/page/';
		$paginator = paginator_options($totalArticle,$limit,$currentPage,$base_url);

		$options = array('task'=>'search','keyword'=>$keyword,'limit'=>$limit,'offset'=>$offset);
        $listArticleSearch = $this->spanta_model->listArticle($options);
        //print_r($listArticleSearch);
		$data = array(
					'keyword'    =>$keyword,
					'paginator'    =>$paginator,
					'title'    =>'Search for keyword : '.$keyword,
					'content'    =>'pages/search',
					'listArticleSearch'    =>$listArticleSearch,
					);
		$this->load->view('../../layout/template_user',$data);
	}
	public function detail($alias){
		//echo current_url();

		$options = array('task'=>'detail','alias'=>$alias);
		$rowArticle = $this->spanta_model->detail($options);

		


		if(count($rowArticle)<=0){
			redirect('/404_override');
		}
		
		$user_id = $rowArticle->article_user; 
		$options = array('task'=>'info','id'=>$user_id);
		$rowUser = $this->spanta_model->infoUser($options);

		$id_catagory = $rowArticle->catagory;
		
		


		$options = array('task'=>'infoCategory','catagory'=>$id_catagory);
		$rowCategory = $this->spanta_model->infoCategory($options);
		

		$options = array('task'=>'preview','id'=>$rowArticle->id,'catagory'=>$id_catagory);
		$linkPre = $this->spanta_model->oneArticle($options);

		$options = array('task'=>'next','id'=>$rowArticle->id,'catagory'=>$id_catagory);
		$linkNext = $this->spanta_model->oneArticle($options);
		/*print_r($linkPre);
		die;*/
		$options = array('task'=>'one');
        $ads = $this->spanta_model->ads($options);
		/*echo '<pre>';
		print_r($rowCategory);*/
		$data = array(
					'title'    =>$rowArticle->title,
					'content'    =>'pages/detail',
					'item'    =>$rowArticle,
					'itemUser'    =>$rowUser,
					'itemCategory'    =>$rowCategory,
					'itemAds'    =>$ads,
					'linkPre'    =>$linkPre,
					'linkNext'    =>$linkNext,
					);
		$this->load->view('../../layout/template_user',$data);
		
		//$this->session->unset_userdata('session_'.$alias);
		
		$options = array('alias'=>$alias,'view'=>$rowArticle->view+1);
		if(!$this->session->userdata('session_'.$alias)){
			$this->spanta_model->updateView($options);
			$this->session->set_userdata('session_'.$alias,$alias);
			$newdata = array(
                   'session_'.$alias => $alias,
                   'view'     => '1',
               );

			$this->session->set_userdata($newdata);

		}elseif($this->session->userdata('session_'.$alias) && $this->session->userdata('view') < 300 ){
			$this->spanta_model->updateView($options);
			$this->session->set_userdata('view',$this->session->userdata('view')+1);
			
			/*echo  $this->session->userdata('view');
			echo '<br>';
			echo 'truong hop cong them nho hon 5 lan view';*/
		}else{
			//echo 'da xem roi nen khong duoc cong view';
		}
		//$this->session->sess_destroy();
	}
	public function preview($alias){
		if(($this->session->userdata('data') != 'success')){
              
			  		redirect('login');
		}
		$options = array('task'=>'preview','alias'=>$alias);
		$rowArticle = $this->spanta_model->detail($options);
		

		if(count($rowArticle)<=0){
			redirect('/');
		}
		
		$user_id = $rowArticle->article_user; 
		$options = array('task'=>'info','id'=>$user_id);
		$rowUser = $this->spanta_model->infoUser($options);

		$id_catagory = $rowArticle->catagory;
		$options = array('task'=>'infoCategory','catagory'=>$id_catagory);
		$rowCategory = $this->spanta_model->infoCategory($options);

		$options = array('task'=>'one');
        $ads = $this->spanta_model->ads($options);
		/*echo '<pre>';
		print_r($rowCategory);*/
		$data = array(
					'title'    =>$rowArticle->title,
					'content'    =>'pages/detail',
					'item'    =>$rowArticle,
					'itemUser'    =>$rowUser,
					'itemCategory'    =>$rowCategory,
					'itemAds'    =>$ads,
					);
		$this->load->view('../../layout/template_user',$data);
	}
	public function contact(){
		$this->load->view('contact');
	}
	public function authorArticle(){
		if(!empty($this->uri->segment(2))){
			$author = $this->uri->segment(2);
			$options = array('task'=>'infoUsername','username'=>$author);
			$userInfo = $this->spanta_model->infoUser($options);
			
			$limit = 2;
			if(!empty($this->uri->segment(4))){
				    $currentPage = $this->uri->segment(4);
			}else{
				
				    $currentPage = 1;
			}

			$options = array('task'=>'user_id','article_user'=>$userInfo->id);
			$totalArticle = $this->spanta_model->listArticle($options);
			
			$offset = $currentPage*$limit-$limit;
			$base_url = $this->base_url.'author/'.$userInfo->username.'/page/';

			$paginator = paginator_options($totalArticle,$limit,$currentPage,$base_url);
			$options = array('task'=>'user_id','article_user'=>$userInfo->id,'limit'=>$limit,'offset'=>$offset);
			$listArticle = $this->spanta_model->listArticle($options);

	        //print_r($listArticleSearch);
			$data = array(
						'paginator'    =>$paginator,
						'title'    =>'Authored by : '.$userInfo->username,
						'content'    =>'pages/author',
						'listArticle'    =>$listArticle,
						);
			$this->load->view('../../layout/template_user',$data);
		}
	}

	public function test(){
		$this->load->view('test');
	}
	public function ajaxCategory($alias){

		$options = array('task'=>'infoCategoryAlias','alias'=>$alias);
		$rowCategoryId = $this->spanta_model->infoCategory($options);
		
		$options = array('task'=>'articleOne','category'=>$rowCategoryId->id);
		$oneArticle = $this->spanta_model->oneArticle($options);
		if(count($oneArticle)<=0){
			echo 'Danh muc chua co bai viet';
			redirect('/my404');
		}
		//print_r($oneArticle);
		$limit = 6;
		$options = array('task'=>'lastIn','category'=>$rowCategoryId->id,'limit'=>null);
		$totalArticle = $this->spanta_model->listArticle($options);

		$options = array('task'=>'articleLink','category'=>$rowCategoryId->id,'limit'=>$limit,'offset'=>0,'id'=>$oneArticle->id);
		$moreArticle = $this->spanta_model->listArticle($options);

		$data = array(
					'title'    =>ucwords(strtolower($rowCategoryId->name).' - tin tức'),
					'content'    =>'pages/cateAjax_2',
					'oneArticle'=>$oneArticle,
					'moreArticle'=>$moreArticle,
					'category'=>$rowCategoryId,
					'limit'=>$limit

					);
		$this->load->view('../../layout/template_user',$data);
	}
	public function procesAjaxCategory(){
		
		$options = array('limit'=>$_POST['limit'],'category'=>$_POST['category'],'moreid'=>$_POST['id'],'id'=>$_POST['idOne']);
		$result = $this->spanta_model->moreLink($options);
		
		$data = array('listArticle'=>$result,'idOne'=>$_POST['idOne'],'category'=>$_POST['category'],'limit'=>$_POST['limit']);
		$this->load->view('pages/procesAjaxCategory',$data);
	}
	
}