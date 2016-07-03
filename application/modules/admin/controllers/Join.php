 
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Join extends MY_Controller {

	function __construct(){
		parent::__construct();
	}

 	public function index()
	{
		//Join nhieu bang lai voi nhau
		$this->db->select('* ,o.order,dt.name as name_product,b.name as name_buyer');
        $this->db->from('order o'); 
        $this->db->join('donhang_detail dt', 'dt.product_order = o.order', 'left');
		$this->db->join('buyer b', 'b.id = o.user_order', 'left');
		$this->db->join('giaohang gh', 'gh.oder_id = o.order', 'left');
        $this->db->where('o.order',24); 
         $query = $this->db->get();
		if($query->num_rows() != 0){
			 $result = $query->result_array();
			 echo '<pre>';print_r($result);
			return $result ;
		}else{
			return false;
		}

	}
	public function group_by()
		{
			//Group by
			$this->db->select('name, count(name) AS gname')->group_by('name')->order_by('gname', 'desc');
	        $this->db->from('buyer'); 
	         $query = $this->db->get();
			if($query->num_rows() != 0){
				$result = $query->result_array();
				echo '<pre>';print_r($result);
				return $result ;
			}else{
				return false;
			}

		}


}