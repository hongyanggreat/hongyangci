
<?php 
class Mproduct extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->product = 'shop_products';
               
        }
		public function listLaptop(){
			$query = $this->db->order_by('id','DESC')->where('menu',1)->limit(10,0)->get($this->product); 
		return $result = $query->result();
		}
		public function listProducts($options = null){
			if($options['task'] == 'list' ){

				$query = $this->db->limit(10,0); 
			}
			if($options['task'] == 'loadmore' ){

				$query = $this->db->where('id <',$options['id'])->limit(10,0); 
			}
			if($options['task'] == 'loadmoreClass' ){

				$query = $this->db->where(array('id <'=>$options['id'],'parent_cate'=>$options['parent']))->limit(10,0); 
			}
		$query = $this->db->order_by('id','DESC')->where(array($options['where']=>$options['at'],'status'=>1))->get($this->product); 
		return $result = $query->result();
		}
        
		public function find($id){

			return $this->db->where('id',$id)->get($this->product)->row();
		}
}