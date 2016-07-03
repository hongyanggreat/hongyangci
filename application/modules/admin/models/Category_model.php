
<?php 
class Category_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->table = 'cungtot_category';
                $this->table_article = 'cungtot_article';
        }
      
         public function listCategory($options=null,$limit= null,$select='*',$oderby='DESC',$start=0){
            if($options['task'] == 'add'){

              $query = $this->db->where('status',1);
            }
          $query = $this->db->order_by('id',$oderby)
                          ->limit($limit,$start)
                          ->select($select)
                          ->get($this->table); 
          return $result = $query->result();
        }
         

        public function listCategoryWhere($limit= null,$where='',$select='*',$oderby='ASC',$start=0){
          $query = $this->db->order_by('id',$oderby)
                          ->limit($limit,$start)
                          ->where('parent',$where)
                          ->where('status',1)
                          ->select($select)
                          ->get($this->table); 
          return $result = $query->result();
        }
        public function listParent($parent){
          $query = $this->db->where('parent',$parent)->where('status',1)->order_by('order','ASC')->get($this->table); 
          return $result = $query->result();
        }
       /* public function infoAticle($id){
          $query = $this->db->where('id',$id)->get($this->table); 
          return $result = $query->row();
        }*/
        public function save($options){
           // echo '<pre>';print_r($options);
          if ($options['task'] == 'add') {
            $row = $options['data'];
            
            if(!empty($row['alias'])){
              $alias = changTitle($row['alias']);
            }else{
              $alias = changTitle($row['name']);
            }
            $data = array(
                    'name'   => $row['name'],
                    'order'  => $row['order'],
                    'status' => $row['status'],
                    'parent' => $row['cat_menu'],
                    'alias'   => $alias,
                    );
            $result =  $this->db->insert($this->table, $data);
            $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Thêm Dữ Liệu Thành Công!'));
          
          } 
          if ($options['task'] == 'edit') {
              $row  = $options['data'];
              $id   = $options['id'];
              if(!empty($row['alias'])){
                $alias = changTitle($row['alias']);
              }else{
                $alias = changTitle($row['name']);
              }
              $data = array(
                  'name'   => $row['name'],
                  'alias'   => changTitle($row['name']),
                  'order'  => $row['order'],
                  'status' => $row['status'],
                  'parent' => $row['cat_menu'],
                  'alias' => $alias,
                  );
              $this->db->where('id', $id);
              $result = $this->db->update($this->table, $data); 
              $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Sửa Dữ Liệu Thành Công!'));

           }
        }

        public function update($id,$status){
           $data = array(
                  'status' => $status,
                  );
              $this->db->where('id', $id);
              $result = $this->db->update($this->table, $data); 
              $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Update Status Thành Công!'));

        }
        public function updateOrder($id,$order){
           $data = array(
                  'order' => $order,
                  );
              $this->db->where('id', $id);
              $result = $this->db->update($this->table, $data); 
              $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Update order Thành Công!'));

        }
        public function infoCategory($id){
          $query = $this->db->where('id',$id)->get($this->table); 
          return $result = $query->row();
        }
        public function article_Category($id,$limit =100 ,$offset = 0){

            $query = $this->db->where('catagory',$id)->order_by('id','DESC')->limit($limit,$offset)->get($this->table_article); 
            return $result = $query->result();
        }
        public function article_Count($id){

            return $query = $this->db->where('catagory',$id)->order_by('id','DESC')->count_all_results($this->table_article); 
        }

        public function delete($id){

            $this->db->where('parent', $id);
            $this->db->from($this->table);
            $count =  $this->db->count_all_results();
            if($count != 0){
               $this->session->set_flashdata(array('flash_level'=>'danger','flash_message'=>'Cảnh Báo !! Bạn Không thể xóa - Danh Mục Chứa Danh Mục Con -Liên Hệ Với Admin!'));

            }else{
                $this->db->where('catagory', $id);
                $this->db->from($this->table_article);
                $count =  $this->db->count_all_results();
                if($count != 0){
                   $this->session->set_flashdata(array('flash_level'=>'danger','flash_message'=>'Cảnh Báo !! Không thể Xóa - Danh mục chứa bài viết -Liên Hệ Admin'));
                 }else{
                    $this->db->where('id', $id);
                    $this->db->delete($this->table); 
                    $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Xóa Dữ Liệu Thành Công!'));
                 }
            }
        }

       public function isNameExist($name) {

         
          $this->db->select('id');
          $this->db->where('name', $name);
          $query = $this->db->get($this->table);

          if ($query->num_rows() > 0) {
              return true;
          } else {
              return false;
          }
      }  


        
       
}