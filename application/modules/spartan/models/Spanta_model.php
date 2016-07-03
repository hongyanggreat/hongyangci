
<?php 
class Spanta_model extends CI_Model {

        public function __construct()
        {
                parent::__construct();
                $this->tableCategory = 'cungtot_category';
                $this->tableArticle  = 'cungtot_article';
                $this->tableUser     = 'users';
                $this->tableAds     = 'ads';
        }
         public function listCategory($options=null){
            if($options['task'] == 'main-menu'){

              $query = $this->db ->where('order','1');
            }
             if($options['task'] == 'top-menu'){

              $query = $this->db ->where('order','2');
            }
            $query = $this->db->order_by('id','ASC');

            $query = $this->db->get($this->tableCategory); 
            return $result = $query->result();
        }
         public function infoCategory($options=null){
            if($options['task'] == 'infoCategory'){
              $query = $this->db ->where('id',$options['catagory']);
            }
            if($options['task'] == 'infoCategoryAlias'){
              $query = $this->db ->where('alias',$options['alias']);
            }
            if($options['task'] == 'latestIn'){
              $query = $this->db->where('order',1)->order_by('id','RANDOM');
            }
            $query = $this->db->get($this->tableCategory); 
            return $result = $query->row();
         
         }
        public function listArticle($options= null){
          $query = $this->db->select('id,image,alias,title,intro,catagory,view,created_at')->where('status',1); 
          if($options['task'] == 'slider'){
            $query = $this->db->limit(5,0); 
          }
          if($options['task'] == 'featured'){
            $query = $this->db->limit($options['limit'],0)->order_by('view','DESC'); 
          } 
          if($options['task'] == 'popular'){
            $query = $this->db->limit($options['limit'],0)->order_by('view','DESC'); 
          }
          if($options['task'] == 'recent'){
            $query = $this->db->limit($options['limit'],0)->order_by('id','ASC'); 
          }
           if($options['task'] == 'random'){
            $query = $this->db->limit($options['limit'],0)->order_by('id','RANDOM'); 
          }
          if($options['task'] == 'articleLink'){
            if(isset($options['limit']) && $options['offset']){

              $query = $this->db->limit($options['limit'],$options['offset']);
            }
            if(isset($options['limit'])){

              $query = $this->db->limit($options['limit'],0);
            }
            
            $query = $this->db->where('catagory',$options['category'])
                              ->where_not_in('id',$options['id'])
                              ->order_by('id','DESC');
          } 
          if($options['task'] == 'lastIn'){
            $query = $this->db->limit($options['limit'],0)
                              ->where('catagory',$options['category'])
                              ->order_by('id','DESC');
          } 
         
         
          if($options['task'] == 'latestVideo'){
            $query = $this->db->limit($options['limit'],0)
                              ->where('iframe',1)
                              ->order_by('id','DESC');
          }
          if($options['task'] == 'linkLatestNews'){
            $query = $this->db->limit($options['limit'],0)
                              ->where_not_in('id',$options['id'])
                              ->order_by('id','DESC');
          }
          if($options['task'] == 'search'){
            $this->db->like('title', $options['keyword']);
              if(isset($options['limit'])){
                $this->db->limit($options['limit'],$options['offset']);
              }
          } 
          if($options['task'] == 'user_id'){
            $this->db->where('article_user',$options['article_user']);
              if(isset($options['limit'])){
                $this->db->limit($options['limit'],$options['offset']);
              }
          }

          $query = $this->db->get($this->tableArticle); 
          return $result = $query->result();
        } 
        public function moreLink($options){
            if(isset($options['moreid'])){

             $query = $this->db->where('catagory',$options['category'])
                              ->where('id <',$options['moreid'])
                              ->where_not_in('id',$options['id'])
                              ->limit($options['limit'],0)
                              ->order_by('id','DESC');
            }
            $query = $this->db->get($this->tableArticle); 
             return $result = $query->result();
        }
        public function oneArticle($options= null){
          $query = $this->db->select('id,image,alias,title,intro,catagory')->where('status',1); 
           
          if($options['task'] == 'articleOne'){
            $query = $this->db->order_by('id','DESC')
                              ->where('catagory',$options['category'])
                              ;
          }
          if($options['task'] == 'latestNews'){
            $query = $this->db->order_by('id','DESC');
          }
          if($options['task'] == 'next'){
            $query = $this->db->where('catagory',$options['catagory'])->where('id > ',$options['id'])->order_by('id','ASC');
          }
          if($options['task'] == 'preview'){
            $query = $this->db->where('catagory',$options['catagory'])->where('id < ',$options['id'])->order_by('id','DESC');
          }
           
          $query = $this->db->get($this->tableArticle); 
          return $result = $query->row();
        }
         public function detail($options= null){
          $query = $this->db->select('*'); 
           
         
          if($options['task'] == 'detail'){
            $query = $this->db->select(''); 
            $query = $this->db->where('alias',$options['alias'])->where('status',1); 
          }
          if($options['task'] == 'preview'){
            $query = $this->db->select(''); 
            $query = $this->db->where('alias',$options['alias']); 
          }
           
          $query = $this->db->get($this->tableArticle); 
          return $result = $query->row();
        }

        public function infoUser($options=null){
            if($options['task'] == 'info'){
              $query = $this->db->select('id,username,email,image,description')->where('id',$options['id']);
            }
            if($options['task'] == 'infoUsername'){
              $query = $this->db->select('id,username,email,image,description')->where('username',$options['username']);
            }
            $query = $this->db->get($this->tableUser); 
            return $result = $query->row();
         
         } 
       
         public function ads($options){
            if($options['task'] == 'one'){
              $query = $this->db->order_by('id','RANDOM'); 
            } 
           
            $query = $this->db->get($this->tableAds);
            return $result = $query->row();
         }
         public function updateView($options){
            
             $data = array(
                    'view'     => $options['view']
                );

             $this->db->where('alias', $options['alias']);
             $this->db->update($this->tableArticle, $data); 
         }
}