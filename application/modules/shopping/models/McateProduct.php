
<?php 
class McateProduct extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->product = 'cate_product';
               
        }
        
		public function find($options){
			if($options['task'] = 'alias'){
				$this->db->where('alias',$options['alias']);
			}
			return $this->db->get($this->product)->row();
		}
}