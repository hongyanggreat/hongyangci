<?php 
function utf8convert($str) {
      if(!$str) return false;
      $utf8 = array(
            'a'=>'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'd'=>'đ|Đ',
            'e'=>'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'i'=>'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
            'o'=>'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'u'=>'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'y'=>'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
                  );
      foreach($utf8 as $ascii=>$uni) $str = preg_replace("/($uni)/i",$ascii,$str);
      return $str;
}
function changTitle($changTitle){

            $changTitle =  preg_replace('/([^\pN\pL\ ]+)/u', '', strip_tags($changTitle));  
            $changTitle = explode ( ' ' , $changTitle);
            foreach($changTitle as $item){
                  if($item ==''){
                        $rong=$item;
                  }else{
                        $ok[]=$item;
                  }
            }
            $changTitle = implode('-', $ok);
            $changTitle = strtolower($changTitle);
            $changTitle = utf8convert($changTitle);

            return $changTitle;
}
function cate_parent($data,$parent =0,$str="--",$selected =0){
      foreach($data as $item){
            if($item->parent == $parent){
                  if($selected !=0 && $item->id == $selected){
                        echo "<option value='".$item->id."' selected ='selected'>$str $item->name</option>";     
                  }else{
                        echo "<option value='".$item->id."'>$str $item->name</option>";     
                  }
               cate_parent($data,$item->id,$str."--",$selected);
            }
      }
}
/*function Convert_address($address){
      $explode = explode('-',$address );
      echo '<pre>';print_r($explode);
      $query_district = $this->db->where('districtid',$explode[1])->get('district'); 
      $result_district = $query_district->row();

}*/
function arr_to_str($array){
      //$CI =& get_instance(); 
      //$CI->load->helper('email');
      $result = explode(',',$array);
      $result =array_unique($result);
      if(!empty($result[0])){
            foreach ($result as $value) {
      
                   $pattern = "/^[a-zA-Z][a-zA-Z0-9]+@[a-zA-Z]+\.[a-zA-Z]{2,3}+$/";
                   $result =  preg_match($pattern,$value,$match).'<br>';
                   if($result==1){
                      foreach ($match as $value) {
                                    
                              $tmp[]= $value;
                        }
                   }
               }
             foreach ($tmp as $value) {
                  $tmp2[]= $value;
             }
             return $tmp2;
      }else{
            return false;
            //return $tmp2 = array('0'=>'');
      }
}
function auth($userlevel){
  $CI =& get_instance(); 
  if($userlevel >2){
            $CI->session->set_flashdata(array('flash_level'=>'danger','flash_message'=>'Canh Bao !! Bạn không có quyền truy cập vào Nội Dung Này. liên hệ Admin để biết thêm chi tiết!'));

      redirect('/admin/cungtot');
    }
}
function RandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}