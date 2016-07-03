
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Privilage {
	function __construct(){
		 $this->router = uri_string();
         $this->linkRedirect  = 'cungtot-article';
	}
    public function checkLevel()
    {
    	$CI =&get_instance();
         $CI->userlevel = $CI->session->userdata('info')->level;
    	 $CI->userID = $CI->session->userdata('info')->id;
    	
    	$CI->load->model('Privilage_model');
    	$result = $CI->Privilage_model->listPrivilage($this->router);
    	if(count($result)){
    		
    		if($CI->userlevel <= $result->level){
    			//echo 'duoc phep truy cap';
	    	}else{
	    		//echo 'khong duoc phep truy cap';
	            $CI->session->set_flashdata(array('flash_level'=>'danger','flash_message'=>'Cảnh Báo !! Bạn Không có quyền truy cập .Liên Hệ Với Admin Để Biết thêm chi tiết'));
	    		
	    		redirect($this->linkRedirect);
	    	}
    	}else{
    		
    		$router = $CI->uri->segment(1).'/'.$CI->uri->segment(2).'/'.$CI->uri->segment(3);
    		$result = $CI->Privilage_model->listPrivilage($router);
    		if(count($result)){
	    		if($CI->userlevel <= $result->level){
	    			//echo 'duoc phep truy cap';
		    	}else{
		    		echo 'khong duoc phep truy cap';
		            $CI->session->set_flashdata(array('flash_level'=>'danger','flash_message'=>'Cảnh Báo !! Bạn Không có quyền truy cập .Liên Hệ Với Admin Để Biết thêm chi tiết'));
		    		
		    		redirect($this->linkRedirect);
		    		
		    	}
		    }
    	}
    	
    }
    public function checkId($id){
        $CI =&get_instance();
        $CI->userId = $CI->session->userdata('info')->id;
        $CI->level = $CI->session->userdata('info')->level;

        $CI->load->model('Article_model');
        $result = $CI->Article_model->infoAticle($id);
        $article_user = $result->article_user;
        $CI->load->model('User_model');
        $options = array('task'=>'article_user');
        $level = $CI->User_model->user_detail_where($article_user,$options)->level;

        if($CI->userId != 1){
            if($CI->userId != $article_user){
               if($CI->level == 1 ){
                    if($level ==1){
                        $options = array('task'=>'level');
                        $result = $CI->User_model->user_detail_where($CI->level,$options);
                        foreach ($result as  $value) {
                            $tmp[] = $value->id;
                        }
                        $key =  array_search($CI->userId,$tmp);
                        unset($tmp[$key]);//loai bo phan tu id ra khoi mang

                       $CI->load->model('Article_model');
                       $result2 = $CI->Article_model->listAticleMoreId($tmp);
                        foreach ($result2 as  $value2) {
                        }
                        if($value2->id){
                            echo 'ban khong co quyen chinh sua';
                            $CI->session->set_flashdata(array('flash_level'=>'danger','flash_message'=>'Cảnh Báo !! Bạn Không có quyền Chỉnh sửa Nội Dung .Liên Hệ Với Admin Để Biết thêm chi tiết'));
                            redirect($this->linkRedirect);
                        }
                       
                    }
                }else{
                    echo 'ban khong co quyen sua bai viet nay';
                    $CI->session->set_flashdata(array('flash_level'=>'danger','flash_message'=>'Cảnh Báo !! Bạn Không có quyền Chỉnh sửa Nội Dung .Liên Hệ Với Admin Để Biết thêm chi tiết'));
                    redirect($this->linkRedirect);

                }//lv khong bang 1
            }
        }
    }
    public function checkEditstatus($id){
        $CI =&get_instance();
        $CI->userId = $CI->session->userdata('info')->id;

        $CI->load->model('Article_model');
        $article_user = $CI->Article_model->infoAticle($id)->article_user;
        
        $CI->load->model('User_model');
        $levelUserInfo = $CI->User_model->userInfo($article_user)->level;
        //echo '<pre>';print_r($userInfo);
        
        $CI->level = $CI->session->userdata('info')->level;

        if($CI->level <= 2 ){
            if( $CI->userId !=1){
                if($CI->userId != $article_user){

                    if($CI->level != 1){
                        if($CI->level >= $levelUserInfo ){
                            //echo 'Admin- Cung level hoac LV cao hon nen khong the xoa duoc';
                            $CI->session->set_flashdata(array('flash_level'=>'danger','flash_message'=>'Cảnh Báo !! Bạn Không có quyền Chỉnh sửa Nội Dung .Liên Hệ Với Admin Để Biết thêm chi tiết'));
                           redirect($this->linkRedirect);
                        }
                    }else{
                        if($CI->level == $levelUserInfo){
                            //echo 'khong cho phep';
                            $CI->session->set_flashdata(array('flash_level'=>'danger','flash_message'=>'Cảnh Báo !! Bạn Không có quyền Chỉnh sửa Nội Dung .Liên Hệ Với Admin Để Biết thêm chi tiết'));
                           redirect($this->linkRedirect);
                        }
                    }
                }
            }
        }else{
            //echo '<br>ban khong co quyen UD';
            $CI->session->set_flashdata(array('flash_level'=>'danger','flash_message'=>'Cảnh Báo !! Bạn Không có quyền Chỉnh sửa Nội Dung .Liên Hệ Với Admin Để Biết thêm chi tiết'));
            redirect($this->linkRedirect);
        }
    }

    function level(){
        $CI =&get_instance();
     
        if(isset($CI->session->userdata['info'])){

            $options = array('task'=>'lv','lv'=>$CI->session->userdata['info']->level);
            if( $CI->uri->segment(1) == 'registry'){

                $CI->load->model('Auth_model');
                $level = $CI->Auth_model->getAuth($options);
            }else{
                
                $CI->load->model('User_model');
                $level = $CI->User_model->getAuth($options);
            }
         ///echo '<pre>';  print_r($level);
        }else{
            $level = '';
        }
            return $level;

    }
}

/* End of file Someclass.php */