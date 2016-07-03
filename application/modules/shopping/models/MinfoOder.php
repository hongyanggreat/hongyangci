
<?php 
class MinfoOder extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->buyer = 'buyer';
                $this->order = 'order';
                $this->giaohang = 'giaohang';
                $this->donhang_detail = 'donhang_detail';
               
        }
		public function infoUser($phone){
			//return $phone;
			return $this->db->where('phone',$phone)->order_by('id','DESC')->get($this->buyer)->row();

		}
		public function infoOrder($idUser){
			return $this->db->where('user_order',$idUser)->order_by('order','DESC')->get($this->order)->row();

		}
		public function infoGiaohang($order){
			return $this->db->where('oder_id',$order)->get($this->giaohang)->row();

		}
		public function donhang_detail($order){
			return $this->db->where('product_order',$order)->get($this->donhang_detail)->result();

		}
		
		public function infoOders($order){
			$this->db->select('* , dt.name as name_product ');
	        $this->db->from('order o'); 
	        $this->db->join('donhang_detail dt', 'dt.product_order = o.order', 'left');
	        $this->db->join('buyer b', 'b.id = o.user_order', 'left');
	        $this->db->join('giaohang gh', 'gh.oder_id = o.order', 'left');
	        $this->db->where('o.order',$order); 
	         $query = $this->db->get();
			if($query->num_rows() != 0){
				 $result = $query->result_array();
				 //echo '<pre>';print_r($result);
				return $result ;
			}else{
				return false;
			}
		}
}