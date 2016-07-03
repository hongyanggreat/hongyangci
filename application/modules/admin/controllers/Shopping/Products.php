<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends Ci_Controller {
	function __construct(){
		parent::__construct();
        $this->load->model('Products_model');
	}
	
	public function index(){	
       $data = array(
					'content' =>'../shopping/shop_products',
					'controller' =>'Products',
					'action'     =>'Add Products',
					'title'      =>'Add Product',
					);
		$this->load->view('../../layout/template_admin',$data);
	}
	public function ajaxlist(){
		
		$list = $this->Products_model->get_product();
		$data = array();
		$i=1;
		foreach ($list as $product) {
			$row = array();
			if($product->status >0){
				$imgStt = 'fa-check-circle';
				$colorStt = 'green';
			}else{
				$imgStt = 'fa-minus-circle';
				$colorStt = '#770208';
			}
				$status = '<a href="javascript:void(0)" title="Edit" onclick="filter_status('."'".$product->id."','".$product->status."'".')"><i style="color:'.$colorStt.';font-size:18px" class="fa '.$imgStt.'" aria-hidden="true"></i></a>';
			
			$row[] = '<input type="checkbox" class="check" name="checkbox[]" value="'.$product->id.'">';
			$row[] = $i++;
			$row[] = $product->name;
			$row[] = $product->price;
			$row[] = $product->gift;
			$class_product = $this->db->where('id',$product->category)->get('class_products')->row();
			$row[] = $class_product->name;

			$cate_product = $this->db->where('id',$class_product->cate_product)->get('cate_product')->row();
			$row[] = $cate_product->name;

			if($product->new > 0){
				
				$new = '<a href="javascript:void(0)" title="Edit" onclick="filter_news('."'".$product->id."','".$product->new."'".')"><img src="'.base_url('/public/admin/images/new.png').'" alt="" width="30"></a>';
			}else{
				$new = '<a href="javascript:void(0)" title="Edit" onclick="filter_news('."'".$product->id."','".$product->new."'".')"><img src="'.base_url('/public/admin/images/old.png').'" alt="" width="30"></a>';
			
			}

			$row[] = $new;
			$row[] = $status;
			$row[] = '<a class="" href="'.base_url('admin/shopping/products/updateProduct/'.$product->id).'" title="Update Products" ><i class="fa fa-plus"></i> update Images</a>';
			
			//add html for action
			$row[] = '<a class="" href="javascript:void(0)" title="Edit" onclick="edit_product('."'".$product->id."'".')"><i class="fa fa-pencil fa-fw"></i> Edit</a>
				  <a class="" href="javascript:void(0)" title="Delete" onclick="delete_product('."'".$product->id."'".')"><i class="fa fa-trash-o  fa-fw"></i> Delete</a>';
		
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
				array( 'field' => 'cate_product', 		
						'label' => 'category Product', 			
						'rules' => 'trim|required'
				),
				array( 'field' => 'class_product', 		
						'label' => 'Class Product', 			
						'rules' => 'trim|required'
				),
				array( 'field' => 'name', 		
						'label' => 'name', 			
						'rules' => 'trim|required|is_unique[shop_products.name]'
				),
				array( 'field' => 'gift', 		
						'label' => 'gift', 			
						'rules' => 'trim|required'
				),
				array( 'field' => 'price', 		
						'label' => 'price', 			
						'rules' => 'trim|required|integer'
				),
				array( 'field' => 'status', 		
						'label' => 'status', 			
						'rules' => 'trim|required'
				),
				
			);
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="text-danger">','</div>');
			if ($this->form_validation->run()){
				
				$data = array(
					'name'     => mb_strtolower($this->input->post('name')),
					'price'    => $this->input->post('price'),
					'gift'     => $this->input->post('gift'),
					'status'   => $this->input->post('status'),
					'category' => $this->input->post('class_product'),
					'parent_cate' => $this->input->post('cate_product'),
					'new'      => 1,
				);
				$this->Products_model->save($data);
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

		$data = $this->Products_model->get_by_id($id);
		$this->load->model('ClassProduct_model');
		$nameClassCategory = $this->ClassProduct_model->get_by_id($data->category);
		$data->nameClassCategory = $nameClassCategory->name;
		echo json_encode($data);
		
	}


	public function ajax_update()
	{
		$this->load->model('ClassProduct_model');
		$this->load->model('CateProduct_model');
		$id = $this->input->post('id');

		$infoProduct = $this->Products_model->get_by_id($id);
		$nameProduct = changTitle($infoProduct->name);
		
		$infoClassProduct = $this->ClassProduct_model->get_by_id($infoProduct->category);
		$aliasClassProduct = $infoClassProduct->alias;

		$infoCateProduct = $this->CateProduct_model->get_by_id($infoProduct->parent_cate);
		$aliasCateProduct = $infoCateProduct->alias;

		$sourceCateProduct  = 'public/shopping/images/products/'.$aliasCateProduct;
		$sourceClassProduct = $sourceCateProduct.'/'.$aliasClassProduct;
		$sourceProduct      = $sourceClassProduct.'/'.$nameProduct;

		$data = array('status'=>false,'messages'=>'');

			$config = array(
				array( 'field' => 'cate_product', 		
						'label' => 'category Product', 			
						'rules' => 'trim|required'
				),
				array( 'field' => 'class_product', 		
						'label' => 'Class Product', 			
						'rules' => 'trim|required'
				),
				array( 'field' => 'name', 		
						'label' => 'name', 			
						'rules' => 'trim|required|callback_product_check'
				),
				array( 'field' => 'gift', 		
						'label' => 'gift', 			
						'rules' => 'trim|required'
				),
				array( 'field' => 'price', 		
						'label' => 'price', 			
						'rules' => 'trim|required|integer'
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
					'name'     => mb_strtolower($this->input->post('name')),
					'price'    => $this->input->post('price'),
					'gift'     => $this->input->post('gift'),
					'status'   => $this->input->post('status'),
					'category' => $this->input->post('class_product'),
					'parent_cate' => $this->input->post('cate_product'),
					'new'      => $this->input->post('news'),
				);
				$this->Products_model->update(array('id' => $this->input->post('id')), $data);

				$infoClassProduct = $this->ClassProduct_model->get_by_id($this->input->post('class_product'));
				$aliasClassProduct = $infoClassProduct->alias;

				$infoCateProduct = $this->CateProduct_model->get_by_id($this->input->post('cate_product'));
				$aliasCateProduct = $infoCateProduct->alias;

				$newSourceCateProduct  = 'public/shopping/images/products/'.$aliasCateProduct;
				$newSourceClassProduct = $sourceCateProduct.'/'.$aliasClassProduct;
				$newSourceProduct      = $sourceClassProduct.'/'.changTitle($this->input->post('name'));
			
				/*rename($sourceCateProduct, $newSourceCateProduct);
				rename($sourceClassProduct, $newSourceClassProduct);*/
				rename($sourceProduct, $newSourceProduct);
//===================

				/*$sourceCat = 'public/shopping/images/products/dien-thoai/test3';
				$newname = 'public/shopping/images/products/dien-thoai/testNews';
				*/
//===================
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
        $this->db->where('name',mb_strtolower($name));
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
	public function product_check($name)
	{

		$this->db->where_not_in('id',$this->input->post('id'));
        $this->db->where('name',mb_strtolower($name));

        if($this->db->count_all_results('shop_products') > 0){
			$this->form_validation->set_message('name_check', 'The %s exist in user other');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function ajax_filter($id,$status){
		$this->Products_model->update_status($id,$status);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_filter_new($id,$news){

		$this->Products_model->update_news($id,$news);
		echo json_encode(array("status" => TRUE));
	}
	public function ajax_delete($id){
		$this->Products_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}

	public function ajaxStatus($status){
		$output = array('status'=>FALSE);
		if(isset($_POST['checkbox'])){
			foreach ($_POST['checkbox'] as $id) {
				$this->Products_model->update_status($id,$status);
			}
				$output['status'] = true;
		}else{
			$output['status'] = false;
		}
		echo json_encode($output);
		
	}
	public function ajax_ClassProduct($value){
		$data = array(
				'status'=>false,
				'output'=>'',
			);
		$result = $this->db->where('cate_product',$value)->get('class_products')->result();
		if(count($result) > 0){
			$data['status'] = true;
			foreach ($result as $key => $value) {
				$data['output'] .= '<option value="'.$value->id.'">'.ucwords($value->name).'</option>';
			}
		}
		echo json_encode($data);

	}
	public function ajaxSession($sess){
		if($sess == 2 ){
			$this->session->set_userdata('statusSS','0');
		}elseif($sess == 1){
			$this->session->set_userdata('statusSS','1');
		}else{
			$this->session->unset_userdata('statusSS');

		}
	}
	public function updateProduct($id){
		$this->load->model('ProductImage_model');

		$product = $this->db->where('id',$id)->get('shop_products')->row();	
		$product->nameProduct = $nameProduct = changTitle($product->name);
		$class_product = $this->db->where('id',$product->category)->get('class_products')->row();

		$product->nameClass = $nameClass = changTitle($class_product->name);
		$cate_product = $this->db->where('id',$class_product->cate_product)->get('cate_product')->row();
		
		$product->nameCate =  $nameCate  =  changTitle($cate_product->name);
		$sourceCat = 'public/shopping/images/products/'.$nameCate;
		$sourceClass    = $sourceCat.'/'.$nameClass;	
		$source    = $sourceCat.'/'.$nameClass.'/'.$nameProduct;	


		if(isset($_POST['submit'])){

			if(!is_dir($sourceCat)){
				mkdir($sourceCat);
			}
			if(!is_dir($sourceClass)){
				mkdir($sourceClass);
			}
			if(!is_dir($source)){
				mkdir($source);
			}
			
			$config = array(
	 			'upload_path'=>$source,
	 			'allowed_types'=>'gif|jpg|png|jpeg',
	 			'file_name'=>RandomString(10),
	 			'max_size'=>'1000',
	 		);
			$this->load->library('upload', $config);

			$result = $this->upload->do_upload('fImages');
			if($result){

				$file =$this->upload->data();

				$img = $this->input->post('imgCurrent');
				$imgCurrent = $source.'/'.$img;

				if(is_file($imgCurrent)){
					unlink($imgCurrent); // delete file
				}
				$data = array(
					'image'=>$file['file_name']
				);
				$this->Products_model->update(array('id' => $id), $data);
			}
			//echo '<pre>';print_r($_FILES);
			// update image extra
			if(!empty($_FILES['userFiles']['name'])){
				$filesCount = count($_FILES['userFiles']['name']);
				if($filesCount > 0){
					for($i = 0; $i < $filesCount; $i++){
						$_FILES['userFile']['name'] = $_FILES['userFiles']['name'][$i];
						$_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
						$_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
						$_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
						$_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];

						$ResultFile = $this->upload->do_upload('userFile');
						if($ResultFile){
							$fileData = $this->upload->data();
							$this->ProductImage_model->save_image($fileData['file_name'],$id);
						}
					}
					
				}
			}
			redirect(base_url('admin/shopping/products/updateProduct/'.$id));

		}	
		
		$product->img = $product_image = $this->ProductImage_model->get_image($id);	
		// echo '<pre>';print_r($product);
			$data = array(
						'content' =>'../shopping/updateProduct',
						'controller' =>'Update',
						'action'     =>'Product',
						'title'      =>'Update Product',
						'product'      =>$product,
					);
			$this->load->view('../../layout/template_admin',$data);
	}
	public function ajaxDelImage($idImg){
		$data = array('status'=>false);

		if(is_file($_POST['img'])){
			unlink($_POST['img']); // delete file
		}
		$this->load->model('ProductImage_model');
		$result = $this->ProductImage_model->delete_image($idImg);
		if($result){
			$data['status'] = true;
		}
		echo json_encode($data);
	}
}

