<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends Ci_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('Auth_model');
        
	}
	public function index()
	{	
         if(($this->session->userdata('data') == 'success')){
              
            redirect('cungtot-article');
        }
		if($this->input->post('submit') !=''){
            //print_r($_POST);
           
    			$config = array(
    				array( 'field' => 'username', 		
    						'label' => 'username', 			
    						'rules' => 'required'
    				),
    				array( 'field' => 'password', 	
    						'label' => 'password', 		
    						'rules' => 'required'
    				),

    			);
            if(isset($_POST['g-recaptcha-response'])){
                $config = array(
                        array( 'field' => 'g-recaptcha-response',   
                                'label' => 'Capcha',        
                                'rules' => 'required'
                        ),
                    );
            }
			$this->form_validation->set_rules($config);
			
			  if ($this->form_validation->run()) {
          $username = $_POST['username'];
          $password = $_POST['password']; 
          $result = $this->Auth_model->validate($username,$password);
          if($result == TRUE){
            $info = $this->Auth_model->getinfo($username,$password);
            if($info->level < 4){
              $this->session->set_userdata(array(
                                            'data'=>'success',
                                            /*'login_attempts'=>'0',*/
                                            'info'=>$info
                                            ));  
              $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Chúc mừng bạn đã đăng nhập thành công vào trang quản trị!'));
              redirect('cungtot-article');
            }
          }else{
           
            $login_attempts = $this->session->userdata('login_attempts');
            if ( $login_attempts >= 2 && $login_attempts <= 3 ) 
            {
             //echo $loginOver ='over';
             $this->session->set_userdata('login_capcha', 1);
            }elseif($login_attempts >3){
                redirect('forget');
            }
            if ( !$login_attempts ){
                $this->session->set_userdata('login_attempts', 0);
            }
            //echo '<pre>';
            $attempts = ($this->session->userdata('login_attempts') + 1);
            $this->session->set_userdata('login_attempts', $attempts);
              $this->session->set_flashdata(array('flash_level'=>'danger','flash_message'=>'Mat khau hoac Password sai.Xin Vui Lòng Kiểm Tra Lại!'));
          }          
        }
		}
		//echo '<pre>';print_r($this->session->userdata);
		$data = array(
				'content' =>'pages/login',
				'title'   =>'Login Hệ Thống',
			);
		
		$this->load->view('template',$data);
	}

	/*function validate($username,$password){
        
        $result = $this->db->where(array('username'=>$username,'password'=>$password))->get($this->table);
        
        if($result->num_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
        
     }*/
   
     public function logout(){
     	$this->session->sess_destroy();
        redirect(base_url('/spartan'));
     }
     public function forget(){
     	if($this->input->post('submit') !=''){
			//print_r($_POST);
			$config = array(
				array( 'field' => 'email', 		
						'label' => 'email', 			
						'rules' => 'trim|required|valid_email'
				),
			);

			$this->form_validation->set_rules($config);
			
			  if ($this->form_validation->run())
                {
                   	$username = $_POST['email'];
     				$info = $this->Auth_model->getinfoId($username);
     				//print_r($info);
     				if($info){
     					if(!empty($info->token)){
                        	$this->session->unset_userdata(array('email','token','linkActive'));
                        	$linkActive = site_url().'active/'.$info->id.'/'.$info->token;
                        	$this->session->set_userdata(
                        				array(
                        						'email_forget'=>$username,
                        						'token_forget'=>$info->token,
                        						'linkActive'=>$linkActive,
                        						'verify'=>'forget')
                        			);
                        	//echo '<pre>';print_r($this->session->userdata);

                        	redirect('validate');
                        }else{
                            $infoUser = $this->Auth_model->getinfoEmail(trim($_POST['email']));
                           echo  $linkActive = base_url('/validateAccount/'.$infoUser->id.'-'.$infoUser->password);
                            $message = 'Nhấn Vào đây để Lấy Mật Khẩu Mới <a href="'. $linkActive.'"></a>';

                            $this->load->library('email');
                            $this->email->from('admin@hongyang.esy.es', 'Support Forget Password');
                            $this->email->to($_POST['email']); 

                            $this->email->subject('Link Xác Nhận Quên Mật khẩu');
                            $this->email->message($message);   

                            $result = $this->email->send();
                            if($result){
                                $this->success =  "Mail Của bạn đã được gửi đi";
                            }else{
                                show_error($this->email->print_debugger());
                            }

                            $this->session->set_flashdata(array('flash_level'=>'warning','flash_message'=>'Hệ Thống đã gửi thư xác nhận đến email : '.$_POST['email']));
                        }

                     }else{
           					 $this->session->set_flashdata(array('flash_level'=>'warning','flash_message'=>'Email : '.$_POST['email'].' chưa được đăng ký.Xin vui lòng Đăng ký ở đây'));

                        	redirect('registry');
                     }

                }
		}
     $data = array(
				'content' =>'pages/forget',
				'title'   =>'Gui lai mail xac nhan tai khoan',
			);
		
		$this->load->view('template',$data);
	}
    public function validateAccount($email){
        //echo $email;
        $str =  explode('-',$email);
        //echo '<pre>';print_r($str);
        $id =  trim($str[0]); 
         $validate =  trim($str[1]); 
        $userInfo = $this->Auth_model->getinfoId($id);
        if($userInfo && $validate == $userInfo->password ){
           // echo '<pre>';print_r($userInfo);
            $password = '123';
            $options = array(
                'task'=>'update',
                'id'=>$id,
                'password'=> $password,

            );
            $result = $this->Auth_model->save($options);
            echo $message = 'Password mới của bạn là '.$password.' .Vui lòng đăng nhập và thay đổi lại Password để bảo mật tài khoản';
            if($result){
                echo 'gui mail cho KH';
              myMail('admin@hongyang.esy.es','Support Password News',$userInfo->email,'Password New',$message);
            }else{
                echo 'vui long kiem tra lai hoac lien he voi admin ';
            }

            echo '<hr>';

           echo 'Xin Vui Lòng truy cập lại email để lấy mật khẩu mới mà hệ thống đã gửi lại bạn';
        }else{
           redirect('/');
        }
       
     }
	
}

