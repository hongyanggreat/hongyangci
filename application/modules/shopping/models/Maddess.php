
<?php 
class Maddess extends CI_Model {

        public function __construct()
        {
                parent::__construct();
				$this->province = 'province';
				$this->district = 'district';
				$this->ward     = 'ward';
        }
        public function findAllProvince(){
			return $this->db->get($this->province)->result();
		}
		public function findDistrict($provinceid){
			return $this->db->where('provinceid',$provinceid)->get($this->district)->result();
		}
		public function findWard($districtid){
			return $this->db->where('districtid',$districtid)->get($this->ward)->result();
		}
		
}