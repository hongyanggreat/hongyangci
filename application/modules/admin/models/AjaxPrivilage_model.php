<?php 
class AjaxPrivilage_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->table = 'privileges';
        }
        public function get_privileges(){
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

      

}
       