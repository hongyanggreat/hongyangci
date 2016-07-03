<?php 
class ProductImage_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->table = 'product_images';
        }

        public function get_image($id){
            return $this->db->where('product_id',$id)->get($this->table)->result();
        }
        public function save_image($image,$idProduct){
            $data = array(
                    'name'=> $image,
                    'product_id'=> $idProduct,
                );
             $this->db->insert($this->table, $data);
             return $this->db->insert_id();
        }
        public function delete_image($id){
            $this->db->where('id', $id)->delete($this->table);
            return $this->db->affected_rows();
        }
        /*public function get_product(){

            if($this->session->userdata('statusSS') != ''){
                
                $query = $this->db->where('status',$this->session->userdata('statusSS'));
            }
            $query = $this->db->get($this->table); 
            return $result = $query->result();
        }
      
        public function get_by_id($id){
            $this->db->from($this->table);
            $this->db->where('id',$id);
            $query = $this->db->get();
            return $query->row();
        }
        public function update($where, $data){
            $this->db->update($this->table, $data, $where);
            return $this->db->affected_rows();
        }
        public function save($data){
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
        public function delete_by_id($id){
            $this->db->where('id', $id)->delete($this->table);
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
        public function update_news($id,$news){
            if($news == 0){
                    $new = 1;
            }else{
                $new = 0;

            }
            $data = array(
                    'new'=>$new,
                );
            $this->db->where('id', $id);
            $result = $this->db->update($this->table, $data);  
        }

      */

}
       