
<?php 
class Mcheckout extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->donhang = 'donhang_detail';
                $this->order = 'order';
                $this->buyer = 'buyer';
                $this->giaohang = 'giaohang';
               
        }

		public function order(){
			return $this->db->order_by('order','DESC')->get($this->order)->row();
			//return $this->db->count_all($this->donhang);
		}
		public function saveorder($options){

			$data = array(
				'user_order' => $options['idUser'] ,
				'total_price' => $this->cart->total() ,
			);

			$this->db->insert($this->order, $data); 
			return $this->db->insert_id();
		}
		
		public function savedonhang($value,$order){
			/*print_r($value);
			die;*/
			$data = array(
				'product_id'    => $value['id'] ,
				'qty'           => $value['qty'] ,
				'price'         => $value['price'] ,
				'name'          => $value['name'] ,
				'gift'          => $value['gift'] ,
				'product_order' => $order ,
			);

			$this->db->insert($this->donhang, $data); 
		}
		public function savegiaohang($value,$order){
			
			$data = array(
				'city'     => $value['city'] ,
				'district' => $value['district'] ,
				'ward'     => $value['ward'] ,
				'area'     => $value['area'] ,
				'oder_id'  => $order ,
			);

			$this->db->insert($this->giaohang, $data); 
		}
		public function savebuyer($option){
			if($option['task'] == 'add'){
				$value = $option['value'];
				$data = array(
					'name'     => $value['FullName'] ,
					'phone'    => $value['PhoneNumber'] ,
					'gender'   => $value['iGender'] ,
				);
				$this->db->insert($this->buyer, $data); 
				return $this->db->insert_id();
			}
			if($option['task'] == 'update'){
				$value = $option['value'];

				$data = array(
					'name'     => $value['FullName'] ,
					'phone'    => $value['PhoneNumber'] ,
					'gender'   => $value['iGender'] ,
				);
				$this->db->where('phone', $value['PhoneNumber']);
				$this->db->update($this->buyer, $data); 
				return $idUser = $this->findPhone($value['PhoneNumber'])->id;

			}
			
		}
		public function findPhone($phone){

			 return $this->db->where('phone',$phone)->get($this->buyer)->row();
		}
		
}