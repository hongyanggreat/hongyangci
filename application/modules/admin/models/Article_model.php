
<?php 
class Article_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->table = 'cungtot_article';
                $this->table_category = 'cungtot_category';
                $this->table_user = 'users';
                  $this->level=  $this->session->userdata('info')->level;
                  $this->id =  $this->session->userdata('info')->id;

        }
       public function listAll(){
        $query = $this->db->from($this->table)
                          ->join($this->table_category, 'cungtot_article.catagory = cungtot_category.id')
                          ->select('cungtot_article.id,cungtot_article.title,cungtot_article.catagory,cungtot_article.image,cungtot_article.article_user,cungtot_article.alias,cungtot_article.status,cungtot_article.iframe,cungtot_article.view,cungtot_category.name')
                          ->order_by('cungtot_article.id','DESC');
                         
          $query = $this->db->get() ;
           return $result = $query->result();
       }
        public function danhsach(){
         // echo $pemision;
         // Z  echo $this->level;
          if($this->level <= 2){
              //echo '<br> lay bai viet cua chinh minh va bai viet cua thanh vien';
                $queryMaxLevel = $this->db->select_max('level')->get($this->table_user);
                $MaxLevel = $queryMaxLevel->row()->level;
                for($i=$this->level+1;$i <= $MaxLevel;$i++){
                  $inLevel[] =  $i;
                }
              //  print_r($inLevel);

                
               $queryId = $this->db->from($this->table_user)
                                ->select('id')
                              ->or_where_in('level',$inLevel)
                              ->order_by('id','DESC')
                              ->get();
                $resultId = $queryId->result();
               //echo '<pre>'; print_r($resultId);
                foreach ($resultId as $value) {
                //echo '<pre>'; print_r($value);
                $tmp[] = $value->id;
                }
                $tmp[] = $this->id;
                //echo '<pre>';print_r($tmp);
               $query = $this->db->or_where_in('article_user',$tmp);
            }else{
                $query = $this->db->where('article_user',$this->id);
            }
            $query = $this->db->from($this->table)
                          ->join($this->table_category, 'cungtot_article.catagory = cungtot_category.id')
                          ->select('cungtot_article.id,cungtot_article.title,cungtot_article.catagory,cungtot_article.image,cungtot_article.article_user,cungtot_article.alias,cungtot_article.status,cungtot_article.iframe,cungtot_article.view,cungtot_category.name')
                          ->order_by('cungtot_article.id','DESC');
                         
            
            
          $query = $this->db->get() ;
           return $result = $query->result();
        }
        
        public function danhsachRecycle(){
            $query = $this->db->from($this->table)
                          ->select('id,title,alias,intro,image,catagory,article_user,status,view,iframe')
                          ->where('catagory',0)
                          ->order_by('id','DESC');
                         
          $query = $this->db->get();
           return $result = $query->result();
        }
        public function listAticleMoreId($where){
          //echo '<pre>';print_r($where);
          $query = $this->db->or_where_in('article_user',$where)->select('id,title,article_user');
          $query = $this->db->order_by('article_user','DESC')
                        ->get($this->table); 
          return $result = $query->result();
        }
        
        public function infoAticle($id){
          $query = $this->db->where('id',$id)->get($this->table); 
          return $result = $query->row();
        }
        
     
        public function save($options){
            //echo '<pre>';print_r($options);
          if ($options['task'] == 'add') {
            
            $row       = $options['data'];
            
            if(isset($options['image'])){
               $image     = $options['image'];
             }else{
               $image     = 'tiki2.jpg';
             }

            if(isset($row['iframe'])){
              $iframe = $row['iframe'];
            }else{
              $iframe = 0;
              
            }

            //for($i=0;$i<=8;$i++){
            $data = array(
                    'title'        => $row['title'],
                    'alias'        => changTitle($row['title']),
                    'catagory'     => $row['cat_menu'],
                    'intro'        => $row['intro'],
                    'content'      => $row['contents'],
                    'status'       => $row['status'],
                    'iframe'       => $iframe,
                    'image'        => $image,
                    'view'        => rand(50000000, 90000000),
                    'article_user' => $row['user'],


                );

              $result =  $this->db->insert($this->table, $data);
           // }
            $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Thêm Dữ Liệu Thành Công!'));
          
          }
           if ($options['task'] == 'edit') {
               $row = $options['data'];

               //print_r($options);
               $id = $options['id'];
               if(isset($options['image'])){
                 $image     = $options['image'];
               }else{
                 $image     = 'tiki2.jpg';
               }
             
               $data = array(
                    'title'           => $row['title'],
                    'alias'           => changTitle($row['title']),
                    'catagory'        => $row['cat_menu'],
                    'intro'           => $row['intro'],
                    'content'         => $row['contents'],
                    'image'           => $image,
                    'updated_at'      => date('Y-m-d H:s:i'),
                    
                );
               //echo '<pre>';print_r($data);

                $this->db->where('id', $id);
                $result = $this->db->update($this->table, $data); 
                $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Sửa Dữ Liệu Thành Công!'));

           }
         
        }

         public function deleteArticle($id){
            $this->db->where('id', $id);
            $this->db->delete($this->table); 
        }
         public function multidelArticle($id){
            $this->db->where('id', $id);
            $this->db->delete($this->table); 
            $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Xóa Nhiều Dữ Liệu Thành Công!'));

        }
        
       public function update($id,$status){
           $data = array(
                  'status' => $status,
                  'approve'=>$this->user,
                  );
              $this->db->where('id', $id);
              $result = $this->db->update($this->table, $data); 
              $this->session->set_flashdata(array('flash_level'=>'success','flash_message'=>'Success !! Update Status Thành Công!'));

        }
}