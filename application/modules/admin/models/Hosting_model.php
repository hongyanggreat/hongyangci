<?php 
class Hosting_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->table = 'hosting';
        }
        public function get_user(){
            $query = $this->db->get($this->table); 
            return $result = $query->result();
        }
        public function save($post){
            $data = array(
                    'name'     => $post['hosting'],
                    'email'    => $post['email'],
                    'password' => $post['password'],
                    'status'   => $post['status'],
                    'date'     => $post['date'],
                );
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
        public function get_by_id($id){
            $this->db->from($this->table);
            $this->db->where('id',$id);
            $query = $this->db->get();
            return $query->row();
        }
        public function update($post){
             $data = array(
                    'name'     => $post['hosting'],
                    'email'    => $post['email'],
                    'password' => $post['password'],
                    'status'   => $post['status'],
                    'date'     => $post['date'],
                );
            $this->db->where('id', $post['id']);
            $this->db->update($this->table, $data);
        }
        public function update_status($id,$status){
            if($status == 0){
                    $status = 1;
            }else{
                $status = 0;

            }
            $data = array(
                    'status'=>$status,
                );
            $this->db->where('id', $id);
            $result = $this->db->update($this->table, $data);  
        }
        public function delete_by_id($id){
            $this->db->where('id', $id)->delete($this->table);
        }

}
       