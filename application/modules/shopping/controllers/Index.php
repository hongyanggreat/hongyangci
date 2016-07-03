<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends CI_Controller {

	public function __construct()
    {
		parent::__construct();
		$this->load->model('mproduct');
		$this->load->model('McateProduct');
		$this->load->model('MclassProduct');
    }
 	
	public function index(){
		$categoryProduct = $this->db->where('status',1)->get('cate_product')->result();
		//echo '<pre>';print_r($categoryProduct);
		$data = array(
					'content'=>'pages/index',
					'cate'=>$categoryProduct,
					);
		$this->load->view('../../layout/template_shopping',$data);
	}
	public function laptop(){
		$result = $this->mproduct->listLaptop();
		$data = array(
					'content'=>'pages/cate_laptop',
					'listLaptop'=>$result,
					'filter'=>'blocks/filter',
					);
		//echo '<pre>';print_r($result);
		$this->load->view('../../layout/template_shopping',$data);
	}	
	public function products($alias){
		$this->session->unset_userdata('nameClass');
		$options = array(
				'task'=>'alias',
				'alias'=>$alias,
			);
		$info = $this->McateProduct->find($options);
		//tim theo parent_cate
		$this->session->set_userdata(array('findProduct'=>$info->id,'findWhere'=>'parent_cate','task'=>'loadmore'));
		$options = array(
					'task'=>'list',
					'where'=>'parent_cate',
					'at'=>$info->id
				);
		$result = $this->mproduct->listProducts($options);
		
		$options = array(
				'task'=>'cate_product',
				'cate_product'=>$info->id,
			);
	
		$classProduct = $this->MclassProduct->find($options);
		$data = array(
					'content'=>'pages/cate_dienthoai',
					'listPhone'=>$result,
					'filter'=>'blocks/filter',
					'classProduct'=>$classProduct,
					);
		$this->load->view('../../layout/template_shopping',$data);
	}
	public function classProduct($cateProduct,$classProduct){
		$options = array(
				'task'=>'alias',
				'alias'=>$cateProduct,
			);
		$info = $this->McateProduct->find($options);
		//echo '<pre>';print_r($info);
		$options = array(
					'task'=>'alias',
					'alias'=>$classProduct,
					'cate_product'=>$info->id
				);
		$infoClass = $this->MclassProduct->find($options);
		//echo '<pre>';print_r($infoClass);
		/*
		die;*/
		//tim theo category of Shop Products
		$this->session->set_userdata(array('nameClass'=>$infoClass->name,'findProduct'=>$info->id,'findWhere'=>'category','task'=>'loadmoreClass','parent'=>$info->id));
		$options = array(
					'task'=>'list',
					'where'=>'category',
					'at'=>$infoClass->id
				);
		$result = $this->mproduct->listProducts($options);
		/*
		echo '<pre>';print_r($result);
		die;*/
		$options = array(
				'task'=>'cate_product',
				'cate_product'=>$info->id,
			);
	
		$classProduct = $this->MclassProduct->find($options);
		$data = array(
					'content'=>'pages/cate_dienthoai',
					'listPhone'=>$result,
					'filter'=>'blocks/filter',
					'classProduct'=>$classProduct,
					);
		$this->load->view('../../layout/template_shopping',$data);
	}
	public function viewmore(){
		//$options = array('task'=>'loadmore','id'=>$_POST['id']);
		//$_POST['6'] = 591;
		//$_POST['id'] = 1;
		$find_Product =$this->session->userdata('findProduct');
		$find_Where =$this->session->userdata('findWhere');
		$task =$this->session->userdata('task');
		$parent = $this->session->userdata('parent');
		$options = array(
						'task'=>$task,
						'id'=>$_POST['id'],
						'parent'=>$parent,
						'where'=>$find_Where,
						'at'=>$find_Product
					);
		//echo '<pre>';print_r($options);
		$result = $this->mproduct->listProducts($options);
		//echo '<pre>';print_r($result);

		$data = array(
					'listPhone'=>$result
					);
		$this->load->view('pages/viewmore_dienthoai',$data);
	}
	public function giohang(){

		//echo '<pre>';print_r($this->cart->contents());
		$data = array(
					'content'=>'pages/giohang',
					'products'=>$this->cart->contents(),
					);
		
		$this->load->view('../../layout/template_shopping',$data);
	}
	public function verifyByer(){

			$data = array(
					'success'=>false,
					'message'=>array(),
				);
			$config = array(
							array( 
								'field' => 'iGender',
						 		'label' => 'Giới Tính', 			
						 		'rules' => 'required',
							 ),
							array( 
								'field' => 'FullName',
						 		'label' => 'FullName', 			
						 		'rules' => 'required',
							 ),array( 
								'field' => 'PhoneNumber',
						 		'label' => 'PhoneNumber', 			
						 		'rules' => 'required|regex_match[/^[0][0-9]{9,10}$/]',
							 ),
						);
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
			if ($this->form_validation->run()){

				/*$this->load->model('mcheckout');
				$idBuyer = $this->mcheckout->savebuyer($_POST);
				$data['idBuyer'] = $idBuyer;*/

				$this->session->set_userdata('infobuyer',$_POST);
				$data['success'] = true;
			}else{
				foreach ($_POST as $key => $value) {
					$data['message'][$key] = form_error($key);
				}
			}
			echo json_encode($data);
	}

	public function countProduct(){
		///
			 $this->session->set_userdata('countProduct',$_POST['countProduct']);
			 $this->session->set_userdata('id_'.$_POST['id'],$_POST['id']);

			 print_r($this->session->userdata);

	}
	public function buy($id){
		$product = $this->mproduct->find($id);
		//$this->cart->insert($data);
		$data = array(
               'id'      => $product->id,
               'qty'     => 1,
               'price'   => $product->price,
               'name'   => $product->name,
               'gift'   => $product->gift,
               'image'   => $product->image,
               'category'   => $product->category,
            );

		$this->cart->insert($data);
		//echo '<pre>';print_r($this->cart->contents());
		redirect('shopping/giohang');
	}
	public function update(){
		$data = array(
		'rowid' =>$_POST['rowid'],
		'qty'   =>$_POST['qty'],
            );

		$this->cart->update($data);
		//print_r($this->cart->contents());
	}
	public function quickview(){
		
		$product = $this->mproduct->find($_POST['id']);
		$product = $this->db->where('id',$_POST['id'])->get('shop_products')->row();	
		
		$class_product = $this->db->where('id',$product->category)->get('class_products')->row();
		$product->nameClass = $nameClass = changTitle($class_product->name);
		$cate_product = $this->db->where('id',$class_product->cate_product)->get('cate_product')->row();
		$product->nameCate =  $nameCate  =  changTitle($cate_product->name);
		//print_r($product);
		

		$this->load->model('mimage');
		$images = $this->mimage->findAll($_POST['id']);
		//echo '<pre>';print_r($images);
		$data = array(
			'item'=>$product,
			'images'=>$images
			);
		$this->load->view('pages/quickview',$data);
	}
	public function checkout(){
		$this->load->model('maddess');
		$province = $this->maddess->findAllProvince();
		$data = array(
				'province'=>$province,
			);
		$this->load->view('pages/checkout',$data);
	}
	public function district(){
		
		$this->load->model('maddess');
		$result = $this->maddess->findDistrict($_POST['province_id']);

		if(count($result) > 0){
			foreach ($result as  $item) 
					$arr_result[$item->districtid] = $item->name;
					echo json_encode($arr_result); 
				}
	}
	public function ward(){
			$this->load->model('maddess');
			$result = $this->maddess->findWard($_POST['distric_id']);

			if(count($result) > 0){
				foreach ($result as  $item) 
						$arr_result[$item->wardid] = $item->name;
						echo json_encode($arr_result); 
					}
		}
	public function validateAddress(){

			$data = array(
					'success'=>false,
					'message'=>array(),
				);
			$config = array(
							array( 
								'field' => 'city',
						 		'label' => 'city', 			
						 		'rules' => 'required',
							 ),
							array( 
								'field' => 'district',
						 		'label' => 'district', 			
						 		'rules' => 'required',
							 ),
							array( 
								'field' => 'ward',
						 		'label' => 'ward', 			
						 		'rules' => 'required',
							 ),
							array( 
								'field' => 'area',
						 		'label' => 'area', 			
						 		'rules' => 'required',
							 ),
							
						);
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<label class="error">', '</label>');
			if ($this->form_validation->run()){
				$data['success'] = true;
				$data['info'] = $_POST;
				//echo '<pre>';print_r($_POST);
			}else{
				foreach ($_POST as $key => $value) {
					$data['message'][$key] = form_error($key);
				}
			}
			echo json_encode($data);
		

	}
	public function save(){
		$this->load->model('mcheckout');
		/*print_r($_POST);
		print_r($this->session->userdata('info'));
		print_r($this->cart->contents());
		*/
		$value = array_merge($_POST,$this->session->userdata('infobuyer'));
		//print_r($value);
		 $phone = $this->session->userdata('infobuyer')['PhoneNumber'];
		$countPhone =  $this->mcheckout->findPhone($phone);
		if(count($countPhone)  == 1){
			 $task = 'update';
		}else{
			
			 $task = 'add';
		}
		
		/*print_r($value);
		die;*/
		$options = array(
						'value'=>$value,
						'task'=>$task
						);
		 $idUser =  $this->mcheckout->savebuyer($options);
		

		$countOrder = $this->mcheckout->order();
		if(count($countOrder) > 0){
			 $donhang = $countOrder->order + 1;
		}else{
			  $donhang = 1;
		}
		$options = array(
						'idUser'=>$idUser,
					);
		$idOrder =  $this->mcheckout->saveorder($options);

		$infoProduct = $this->cart->contents();
		
		foreach ($infoProduct as $value) {

			$this->mcheckout->savedonhang($value,$idOrder);
		}

		$this->mcheckout->savegiaohang($_POST,$idOrder);
		$this->cart->destroy();
	}
	public function infoOrder(){
		
		$this->load->model('MinfoOder');

		$phone = $this->session->userdata['infobuyer']['PhoneNumber'];

		$infoUser = $this->MinfoOder->infoUser($phone);
		if(count($infoUser) <= 0){
			redirect('shopping/products');
		}
		$idUser  = $infoUser->id;
		$infoOrder = $this->MinfoOder->infoOrder($idUser);
		/*echo '<pre>';print_r($infoOrder);
		echo '<pre>';print_r($infoOrder);*/
		$infoOrder = $this->MinfoOder->infoOders($infoOrder->order);
		$data = array(
			'content'           =>'pages/info_orders',
			'infoOrder'           =>$infoOrder,
			);
		$this->load->view('../../layout/template_shopping',$data);
		/*die;

		$order  = $infoOrder->order;

		$infoGiaohang = $this->MinfoOder->infoGiaohang($order);

		$infoDetailProduct = $this->MinfoOder->donhang_detail($order);


		$data = array(
					'content'           =>'pages/info_order',
					'infoUser'          =>$infoUser,
					'infoOrder'         =>$infoOrder,
					'infoGiaohang'      =>$infoGiaohang,
					'infoDetailProduct' =>$infoDetailProduct,
					);
		//echo '<pre>';print_r($result);
		$this->load->view('../../layout/template_shopping',$data);*/
	}
	public function infoOrders(){
		$this->load->model('MinfoOder');
		$infoOrder = $this->MinfoOder->infoOders(24);
		$data = array(
			'content'           =>'pages/info_orders',
			'infoOrder'           =>$infoOrder,
			);
		$this->load->view('../../layout/template_shopping',$data);
	}
	public function clearFilter(){
		$this->session->unset_userdata('nameClass');
	}
	
}