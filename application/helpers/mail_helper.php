<?php 
	function myMail($from,$name,$to,$subject,$message){
        $CI =&get_instance();
        $CI->load->library('email');
        $CI->email->from($from, $name);
        $CI->email->to($to); 

        $CI->email->subject($subject);
        $CI->email->message($message);   

        $result = $CI->email->send();
        if(!$result){
            show_error($CI->email->print_debugger());
        }
    }
   
 ?>

  