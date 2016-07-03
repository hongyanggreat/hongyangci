
<?php 
class MclassProduct extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->product = 'class_products';
               
        }
        
		public function find($options =''){
			if($options['task'] == 'alias'){
				//print_r($options);
				$this->db->where(array('alias'=>$options['alias'],'cate_product'=>$options['cate_product']));
				return $this->db->get($this->product)->row();
			}
			if($options['task'] == 'cate_product'){
				$this->db->where('cate_product',$options['cate_product']);
				return $this->db->get($this->product)->result();
			}
		}
}