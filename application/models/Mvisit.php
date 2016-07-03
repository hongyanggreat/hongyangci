
<?php 
class Mvisit extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->visit = 'visits';
        }
        function save($randomCookie){

          $data = array(
            'ip_address' => $_SERVER['REMOTE_ADDR'] ,
            'time'       => time() ,
            'ss_cookie'   => $randomCookie,
            'status'     => 1 ,
          );
          $this->db->insert($this->visit, $data); 
        }
        function update($visiter,$view){
          $data = array(
            'time' => time(),
            'status'     => 1 ,
            'view'     => $view ,
          );
          $this->db->where('ss_cookie',$visiter);
          $this->db->update($this->visit, $data); 
        }
        function info($visiter){
          return $this->db->where('ss_cookie',$visiter)->get($this->visit)->row();
        }
        function updateStatus($timeNew){
          $data = array(
            'status' => 0,
          );
          $this->db->where('time < ',$timeNew);
          $this->db->update($this->visit, $data); 
        }
        function countStatus(){
          return $this->db->where('status',1)->get($this->visit)->num_rows();

        }
        
}