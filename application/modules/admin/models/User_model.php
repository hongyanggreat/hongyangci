
<?php 
class User_model extends CI_Model {

        protected $table_groups = 'groups';
        
        public function __construct()
        {
                parent::__construct();
                $this->table = 'users';
        }
        public function userInfo($id){
           $query = $this->db->where('id',$id)->get($this->table); 
            return $result = $query->row();
        }
        public function userInfoName($name){
           $query = $this->db->where('username',$name)->get($this->table); 
            return $result = $query->row();
        }
       
        public function user_detail(){
            $query = $this->db->get($this->table); 
           return $result = $query->result();
        }
        public function user_detail_where($where,$options =null){
            if($options['task'] =='level'){

                $query = $this->db->where('level',$where)->select('id')->get($this->table); 
                return $result = $query->result();
            }
            if($options['task'] =='article_user'){
                $query = $this->db->where('id',$where)->select('*')->get($this->table); 
                return $result = $query->row();
            }
        }
        public function delete($options){
        	print_r($options);
        	if($options['task'] == 'delete'){
        		$this->db->where('id', $options['id']);
            	$this->db->delete($this->table); 
       			$this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success! Ban Da xoa thanh vien'));

        	}
        }
        public function update($options){
            
             if($options['task'] == 'changePass'){
                $id = $options['data']['id'];
                $data = array(
                    'password'    =>sha1(sha1($options['data']['password'])),
                );
             }
            if($options['task'] == 'updateProfile'){
               
               $id = $options['data']['id'];

                $data = array(
                    'username'    =>$options['data']['username'],
                    'email'       =>$options['data']['email'],
                    'image'       =>$options['data']['image'],
                    'phone'       =>$options['data']['phone'],
                    'description' =>$options['data']['description'],
                    'updated_at'  =>date('Y-m-d H:i:s'),
                );
                $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Tài khoản <b style="color:red">'.$options['data']['username'].' </b>đã được cập nhật-Vui Lòng Đăng Nhập Vào Hệ THống'));
            }
           
        	if($options['task'] == 'filter'){
        		$id = $options['id'];
        		if($options['status'] == 0){
        			$status = 1;
        		}else{
        			$status = 0;

        		}
        		$data = array(
    				'status'=>$status,
    			);
                $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! User Được Cập nhật thành công'));
        	}
           if($options['task']=='edit'){
                $row = $options['data'];
                $id = $row['id'];
                if(isset($row['status'])){
                    $status = $row['status'];
                }else{
                    
                    $status = '0';
                }
           
                $data = array(
                        'username' =>$row['username'],
                        'email'    =>$row['email'],
                        'level'    =>$row['level'],
                        'status'   =>$status,
                        );

                if(isset($row['password'])){
                     $data['password'] = sha1(sha1($row['password']));
                }
                $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Tài khoản <b style="color:red">'.$options['data']['username'].' </b>đã được cập nhật-Vui Lòng Đăng Nhập Vào Hệ THống'));
            }

            $this->db->where('id',$id);
            $this->db->update($this->table, $data);
        }
      public function getAuth($options = null){
       
        if($options['task'] == 'lv'){
            $this->db->where('id > ',$options['lv']);
        } 
        if($options['task'] == 'atlv'){
            $this->db->where('id',$options['lv']);
        }
        $query = $this->db->get($this->table_groups);
        return $result = $query->result();
     }
      public function updateStatus($id,$status){
        $data = array(
            'status'   =>$status,
            );
        $this->db->where('id',$id);
        $this->db->update($this->table, $data);
        $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Bạn Đã update thành công Trạng thái của User'));
      }
    


}