<?php 
class Privilage_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->table = 'privileges';
        }
         public function listPrivilage($router){
         // echo $pemision;
    	
            $query = $this->db->from($this->table)->where('router',$router)->get() ;
           return $result = $query->row();
        }

}