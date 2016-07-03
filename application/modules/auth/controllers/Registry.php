
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Registry extends Ci_Controller {


	function __construct(){
		parent::__construct();
		$this->load->model('Auth_model');
	}
	
	public function capcha(){

		if(isset($_POST['submit'])){
			print_r($_POST);
		}
		$data = array(
				'content' =>'pages/capcha',
				'title'   =>'Capcha GG',
			);
		
		$this->load->view('template',$data);
	}
	public function index()
	{	
		$this->config->set_item('language', 'vietnamese');
		//$this->lang->load('form_validation_lang');
		$this->load->helper('security');

		if($this->input->post('submit') !=''){
			//echo '<pre>';print_r($_POST);
			$config = array(
				array( 'field' => 'username', 		
						'label' => 'User Name', 			
						'rules' => 'trim|required|is_unique[users.username]|min_length[3]|max_length[25]|alpha|xss_clean'

				),
				array( 'field' => 'password', 	
						'label' => 'Password', 		
						'rules' => 'required|trim'
				),
				array( 'field' => 're-password', 	
						'label' => 'Re-password', 		
						'rules' => 'trim|required|matches[password]'
				),
				array( 'field' => 'email', 	
						'label' => 'Email', 		
						'rules' => 'required|callback_mail_check|is_unique[users.email]'
				),
				array( 'field' => 'level', 	
						'label' => 'Level', 		
						'rules' => 'required'
				),
				array( 'field' => 'g-recaptcha-response', 	
								'label' => 'Capcha', 		
								'rules' => 'required'
						),
				
			);
			
			$this->form_validation->set_rules($config);
			
			  if ($this->form_validation->run())
                {
                	$token = $_POST['username'].$_POST['password'].$_POST['email'].$_POST['level'];
                	$_POST['token'] = sha1($token);
                	
                    $id = $this->Auth_model->save(array(
												'task'=>'add',
												'data'=>$_POST,
											));
     				$info = $this->Auth_model->getinfoId($id);
     				$email = $info->email;


                   // $options = array('id'=>$id,'token'=>$_POST['token']) ;
                    $linkActive = site_url().'active/'.$id.'/'.$_POST['token'];
                    $this->session->set_userdata(
                    				array(
                    						'linkActive'=>$linkActive,
                    						'email'=>$email,
                    						'verify'=>'new'
                    					)
                    			); 
        			redirect('validate');
                }
               
		}
			
			$level = $this->privilage->level();



		
		//echo '<pre>';print_r($level);
		$data = array(
				'content' =>'pages/registry',
				'title'   =>'Login Hệ Thống',
				'level'=>$level,
			);
		
		$this->load->view('template',$data);
	}
	public function mail_check($str){
		if (!preg_match("/^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$/",$str)) {
		  $this->form_validation->set_message('mail_check', '<p class="error">{field} :Chưa Đúng Định Dạng Email</p>');

			return FALSE;
		}else{

			return TRUE;
		}

	   
	}
     public function validate(){
     	if($this->session->userdata()['verify'] == 'forget'){
          $email = $this->session->userdata()['email_forget'];
          $token = $this->session->userdata()['token_forget'];
          $linkActive = $this->session->userdata()['linkActive'];

          $this->session->set_userdata(array('email'=>$email,'token'=>$token,'linkActive'=>$linkActive));
     	}
     	if($this->session->userdata('email')){
     		//echo '<pre>';print_r($this->session->userdata);
     		 $link =  '<div>Nhấn <a href="'.base_url('/sendmail').'">Vào đây</a> Để Xác nhận Email Đang Ký Tài Khoan</div>';
     	}else{
     		//echo '<pre>';print_r($this->session->userdata);
     		 $link =  '<div>Nhấn <a href="'.base_url('/registry').'">Vào đây</a> Quay lai trang chu</div>';
     	}
		$data = array(
				'content' =>'pages/validate',
				'title'   =>'validate User',
				'link'   =>$link,
			);
		$this->load->view('template',$data);
     }
     
     
     public function sendmail(){

     	if($this->session->userdata('email')){
 			$linkActive = $this->session->userdata()['linkActive'];
 			 $receiver_email = $this->session->userdata()['email'];

 			 $message = 'Xác Nhân Tài Khoản <a href="'. $linkActive.'">Link Active</a>';
 			 $this->load->library('email');
 			 $this->email->from('info@marketingfree.esy.es', 'Marketing Free');
			 $this->email->to($receiver_email); 

			 $this->email->subject('Xác nhận Tài Khoản.');
			 $this->email->message($message);	

			$result = $this->email->send();
			if($result){
				$this->success =  "Mail Đa được gửi đi";
			}else{
				show_error($this->email->print_debugger());
			}
     		
     	}else{
     			redirect('/cungtot');
     	}

		$data = array(
				'content' =>'pages/sendmail',
				'title'   =>'Send Mail',
				'success'=>$this->success,
			);
		//print_r($data);
		$this->load->view('template',$data);
     } 


     public function active(){
		$id    =  $this->uri->segment(2);
		$token = $this->uri->segment(3);

     	$options = array(
					'id'    =>$id,
					'token' =>$token,
					'task'  =>'active'
     				);
     	$info = $this->Auth_model->getinfoId($id);
     	//echo '<pre>';print_r($info);
     	if($token == $info->token){
     		$this->Auth_model->update($options);
     		redirect('login');
     	}else{
     		redirect('auth/registry/inactive');
     	}

     }
     public function inactive(){
     	echo 'Lỗi Tạm Thời - Nguyên Nhân : <br> 1. Kiểm Tra Lại link Active <br> 2 . Có thể bạn đã là thành viên';
     }
     
	public function lang()
	   {
	      $this->load->helper('language');
	      $this->lang->load('user', 'vietnamese');
	      echo lang('full_name').'<br />';
	      echo lang('email').'<br />';
	      echo lang('phone').'<br />';
	      echo lang('password').'<br />';
	      echo lang('address').'<br />';
	   }
}

