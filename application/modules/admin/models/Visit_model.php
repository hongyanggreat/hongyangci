
<?php 
class Visit_model extends CI_Model {

        protected $table_visit = 'visits';
        
        public function __construct()
        {
                parent::__construct();
        }
         function getIpAddress(){

            return $this->db->get($this->table_visit)->result();
         }
          function delIpAddress($id){
            $this->db->where('id', $id);
			$this->db->delete($this->table_visit); 
            $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Bạn Đã xóa thành công IP Address ra khỏi danh sách.'));
         }
        


}