
<?php 
class Mimage extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->image = 'product_images';
               
        }
		
		public function findAll($id){
			return $this->db->where('product_id',$id)->get($this->image)->result();
		}
}