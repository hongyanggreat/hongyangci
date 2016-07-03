<?php 
class Auth_model extends CI_Model {
	

    protected $table = 'users';
	protected $table_groups = 'groups';
	 public function __construct(){

	 	parent::__construct();

	 }
   
     public function validate($username,$password){

         $password = sha1(sha1($password));
        $result = $this->db->where(array('username'=>$username,'password'=>$password,'status'=>1,'token'=>null))
                        ->get($this->table);
        if($result->num_rows() == 1){
            return TRUE;
        }
     }
     public function getinfo($username,$password){
        $password = sha1(sha1($password));
        
        $query = $this->db->where(array('username'=>$username,'password'=>$password))->get($this->table);
        return $result = $query->row();
     }
     public function getinfoId($param){
        
        $query = $this->db->where('id',$param)->or_where('email',$param)->get($this->table);
        return $result = $query->row();
     } 
     public function getinfoEmail($email){
        
        $query = $this->db->where('email',$email)->get($this->table);
        return $result = $query->row();
     }
     public function getAuth($options = null){
       
        if($options['task'] == 'lv'){
            $this->db->where('id > ',$options['lv']);
        }
        $query = $this->db->get($this->table_groups);
        return $result = $query->result();
     }

     public function save($options){
        if($options['task']=='add'){

            $row = $options['data'];
            if(isset($row['status'])){
                $status = $row['status'];
            }else{
                
                $status = '0';
            }
            $data = array(
                    'username' =>$row['username'],
                    'password' =>sha1(sha1($row['password'])),
                    'email'    =>$row['email'],
                    'level'    =>$row['level'],
                    'status'   =>$status,
                    'ip_address'   =>$this->input->ip_address(),
                    'token'   =>$row['token'],
                    );

            $result =  $this->db->insert($this->table, $data);
            return $this->db->insert_id();
            $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Bạn Đã Đăng ký Thành Công -Vui Lòng Đăng Nhập Vào Hệ THống'));

        }if($options['task']=='update'){
             $data = array(
                    'password' =>sha1(sha1($options['password'])),
                    );
            $this->db->where('id',$options['id']);
            return  $this->db->update($this->table, $data);

        }
     }
     function update($options){
        if($options['task'] == 'active'){
            echo '<pre>';print_r($options);

          $data = array(
              'token' => Null,
              'status' => 1,
              );
          $this->db->where('id', $options['id']);
          $result = $this->db->update($this->table, $data); 
          $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Xác Nhận Tài Khoản Thành Công! Xin vui lòng Đăng nhập'));

        }
       
     }



}

