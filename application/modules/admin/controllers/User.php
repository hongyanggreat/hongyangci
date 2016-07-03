 
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	public $message = ' ';
	function __construct(){
		parent::__construct();
		$this->load->model('User_model');
		if(($this->session->userdata('data') != 'success')){
              
			  		redirect('login');
		}
		$this->privilage->checkLevel();
		$this->load->library('visit');
	}

 	public function warning(){
       			
       			$this->session->set_flashdata(array('flash_level'=>'warning','flash_message'=>'Danger! Access deny.'));
       			redirect('/user');
 	}
 	public function index(){

      	$listUser = $this->User_model->user_detail();
      	//print_r($listUser);
 		$data = array(
					'content'    =>'user/list',
					'controller' =>'Danh Sách',
					'action'     =>'Thành Viên',
					'title'      =>'Danh Sách Thành Viên Đã Đăng ký',
					'listUser'	=>$listUser,
					);
		$this->load->view('../../layout/template_admin',$data);
     }
     public function filter($status,$id){
     	$options = array('task'=>'filter','id'=>$id,'status'=>$status);
      	$listUser = $this->User_model->update($options);
		redirect('user');

     }
      public function delete($id){
     	$options = array('task'=>'delete','id'=>$id);
      	$listUser = $this->User_model->delete($options);
		redirect('user');

     }
     public function edit($id)
	{	
		
		$userInfo = $this->User_model->userInfo($id);
		$levelEdit = $userInfo->level; 
		

		$idCurrent = $this->session->userdata['info']->id;
		$levelLogin = $this->session->userdata['info']->level;
		if($levelLogin > $levelEdit || ($levelLogin == $levelEdit && $idCurrent != $id )){
				$this->session->set_flashdata(array('flash_level'=>'warning','flash_message'=>'Danger ! You No have Pemission.'));
       			redirect('/user');
		}

		if($idCurrent != $id){

			$level = $this->privilage->level();
		}else{
			$this->session->userdata['info']->level;
			$options = array('task'=>'atlv','lv'=>$this->session->userdata['info']->level);
			$level = $this->User_model->getAuth($options);
		}

		if(isset($_POST['submit'])){
			//print_r($_POST);
			$_POST['id'] = $id;
			$config = array(
				array( 'field' => 'username', 		
						'label' => 'username', 			
						'rules' => 'required|is_unique[users.username]'
				),
				
				array( 'field' => 'email', 	
						'label' => 'email', 		
						'rules' => 'required'
				),
				array( 'field' => 'level', 	
						'label' => 'level', 		
						'rules' => 'required'
				),
				array( 'field' => 'status', 	
						'label' => 'status', 		
						'rules' => 'required'
				),
			);
			if(isset($_POST['password'])){

			$config[] = array( 'field' => 'password', 	
						'label' => 'Password', 		
						'rules' => 'required'
				);
			}

			$this->form_validation->set_rules($config);
			
			  if ($this->form_validation->run())
                {
                	$options = array(
                				'task'=>'edit',
                				'data'=>$_POST,
                		);
                $this->User_model->update($options);
                redirect(base_url('/user'));
                }
		}
               
		$data = array(
					'content'    =>'user/edit',
					'controller' =>'Edit',
					'action'     =>'edit user',
					'title'      =>'Cập nhật Thông tin',
					'info'=>$userInfo,
					'level'=>$level,
					);
		
		$this->load->view('../../layout/template_admin',$data);
	}

	public function status($status)
	{
		foreach ($_POST['checkbox'] as $id) {
			$this->User_model->updateStatus($id,$status);
		}
		redirect('/user');
	}
	public function profile($name)
	{
		$this->config->set_item('language', 'vietnamese');
		$this->load->model('User_model');
		$info = $this->User_model->userInfoName($name);
		$usernameCurrent = $this->session->userdata['info']->username;
		if(count($info) <= 0 || $usernameCurrent != $name){
			redirect('/');
		}
		$source = 'public/upload/admin/user/'.$name;
		$sourceThumb = 'public/upload/admin/user/'.$name.'/thumb';
		if(!is_dir($source)){
			mkdir($source);
			mkdir($sourceThumb);
		}
		
		if(isset($_POST['submit'])){
			
			$config = array(
				array( 'field' => 'username', 		
						'label' => 'username', 			
						'rules' => 'required|callback_username_check'
				),
				array( 'field' => 'email', 		
						'label' => 'email', 			
						'rules' => 'required|callback_email_check'
				),
				
				array( 'field' => 'description', 		
						'label' => 'description', 			
						'rules' => 'max_length[250]'
				),
			);
			if(!empty($_POST['phone'])){

			$config[] = array( 'field' => 'phone', 	
						'label' => 'Phone', 		
						'rules' => 'callback_phone_check'
				);
			}
			$this->form_validation->set_rules($config);
			if ($this->form_validation->run()){
				$config = array(
		 			'upload_path'=>$source,
		 			'allowed_types'=>'gif|jpg|png|jpeg',
		 			'file_name'=>RandomString(10),
		 			'max_size'=>'500',
		 		);
				$this->load->library('upload', $config);

				$result = $this->upload->do_upload('fImages');

				$_POST['image'] = '';

				if($result){
					$file =$this->upload->data();
					$_POST['image'] = $file['file_name'];

					//tao thumb Image
					$this->load->library('image_lib');

					 	$config['image_library'] = 'gd2';
					    $config['source_image'] = $source.'/'.$_POST['image'];
					    $config['new_image'] = $sourceThumb.'/'.$_POST['image'];
					    $config['thumb_marker'] = '';
					    $config['create_thumb'] = TRUE;
					    $config['maintain_ratio'] = TRUE;
					    $config['width']     = 150;
					    $config['height']   = 150;

				    $this->image_lib->clear();
				    $this->image_lib->initialize($config);
				    $this->image_lib->resize();
					
					$img = $this->input->post('imgCurrent');
						$imgCurrent = $source.'/'.$img;
						$thumbImgCurrent = $sourceThumb.'/'.$img;

					if(is_file($imgCurrent)){
						unlink($imgCurrent); // delete file
						unlink($thumbImgCurrent); // delete file
					}
				}else{
					$_POST['image'] = $this->input->post('imgCurrent');
					$this->message = $this->upload->display_errors('');
				}
				$options = array(
                				'task'=>'updateProfile',
                				'data'=>$_POST,
                		);
                $this->User_model->update($options);
              
                $info = $this->User_model->userInfo($this->input->post('id'));
               	$this->session->set_userdata(array(
                                            'info'=>$info
                                            ));  
               	 $newname = 'public/upload/admin/user/'.$this->session->userdata['info']->username;
               
               	rename($source, $newname);
               	//redirect('/cungtot-article');
			}

		}
		$data = array(
			'content'    =>'user/profile',
			'controller' =>'Profile',
			'action'     =>'Update',
			'title'      =>'Update Profile',
			'info'       =>$info,
			'message'    =>$this->message,
		);
		$this->load->view('../../layout/template_admin',$data);
	}
	public function changePass()
	{
		$data = array('status'=>false,'messages'=>'');

			$config = array(
				array( 'field' => 'oldPass', 		
						'label' => 'oldPass', 			
						'rules' => 'trim|required|callback_pass_check'
				),
				array( 'field' => 'newPass', 		
						'label' => 'newPass', 			
						'rules' => 'trim|required'
				),
				array( 'field' => 'rePass', 		
						'label' => 'rePass', 			
						'rules' => 'trim|required|matches[newPass]'
				),
			);
			$this->form_validation->set_rules($config);
			$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
			if ($this->form_validation->run()){
				$options = array('task'=>'changePass','data'=>array('id'=>$_POST['id'],'password'=>$_POST['newPass']));
				$this->User_model->update($options);
				$data['status'] = TRUE;
			}else{
				foreach ($_POST as $key => $value) {
					$data['messages'][$key] = form_error($key);
				}
			}
		
		//print_r($data);
		echo json_encode($data);
	}
	public function pass_check($passOld)
	{
		$userInfo = $this->User_model->userInfo($_POST['id']);
		//echo $_POST['id'];
		$passInfo = $userInfo->password;
		$oldPassword = sha1(sha1($_POST['oldPass']));
		if($oldPassword != $passInfo){
			$this->form_validation->set_message('pass_check', 'The %s Password Old Wrong');
			return FALSE;
		}else{
			return TRUE;
		}
			
	}
	public function username_check($username)
	{
		$this->db->where_not_in('id',$this->input->post('id'));
        $this->db->where('username',$username);

        if($this->db->count_all_results('users') > 0){
			$this->form_validation->set_message('username_check', 'The %s exist in user other');
			return FALSE;
		}
		else
		{
			return TRUE;
		}
	}
	public function phone_check($phone)
		{
			$this->db->where_not_in('id',$this->input->post('id'));
	        $this->db->where('phone',$phone);

	        if( $this->db->count_all_results('users') > 0){
				$this->form_validation->set_message('phone_check', 'The %s exist in user other');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
	}
	public function email_check($email)
		{
			$this->db->where_not_in('id',$this->input->post('id'));
	        $this->db->where('email',$email);

	        if($this->db->count_all_results('users') > 0){
				$this->form_validation->set_message('email_check', 'The %s exist in user other');
				return FALSE;
			}
			else
			{
				return TRUE;
			}
	}

	public function ip_address()
	{
		$this->load->model('Visit_model');
		$result = $this->Visit_model->getIpAddress();
		$data = array(
			'content'    =>'user/ip_address',
			'controller' =>'User',
			'action'     =>'List IP address',
			'title'      =>'List IP Address',
			'result'      =>$result,
		);
		$this->load->view('../../layout/template_admin',$data);
	}

	public function del_ip_address($id){
		$this->load->model('Visit_model');
		$this->Visit_model->delIpAddress($id);
		redirect('/ip_address');
	}
}