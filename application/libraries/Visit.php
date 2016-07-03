
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

class Visit {

    private $CI;
    
    function __construct(){
        date_default_timezone_set("Asia/Bangkok");
        $timeNew = time()  - 60;
        $this->CI =& get_instance();
        $CI =&get_instance();
        $CI->load->model('mvisit');
        
        $CI->load->helper('cookie');
        
        $CI->load->helper('cookie');
       
        $CI->mvisit->updateStatus($timeNew);
        $visiter =  get_cookie('hongyang_user_visit');
        $randomCookie = RandomString(60);

        if(!isset($visiter)){
            /* $cookie = array(
               'name'   => 'hongyang_user_visit',
               'value'  => $randomCookie,
               'expire' => time()+(86400 * 30),
               'prefix' => 'hongyang_'
            );
            $CI->input->set_cookie($cookie); */
            setcookie('hongyang_user_visit', $randomCookie, time() + (86400 * 30), "/");
            
        }

        $info = $CI->mvisit->info($visiter);
       
        if(count($info) <= 0){
            $CI->mvisit->save($randomCookie);
        }else{
             if(isset($visiter)){
                $view = $info->view + 1;
                $CI->mvisit->update($visiter,$view);
             }
        }
       
       /*  
       $visits = $CI->mvisit->countStatus();
        echo 'Hiện Tại Có '.$visits.' thành viên online';*/


    }
    function countVisit(){
        return $visits = $this->CI->mvisit->countStatus();
    }

    
}
    

/* End of file Someclass.php */