
<?php 
    foreach ($cate as $value) {
    
?>
    <div class="filter">
        <div class="left">
            <span>Danh Mục <?= $value->name?>:</span>
            <?php 
               $classProduct = $this->db->where('cate_product',$value->id)->order_by('id','ASC')->limit(7)->get('class_products')->result();
               foreach ($classProduct as $classProduct) {
                   
                    echo '<a href="'.base_url('/shopping/products/'.$value->alias.'/'.$classProduct->alias).'">'.$classProduct->name.'</a>';
               }
              // print_r($classProduct);
            ?>
                
        </div>
    </div>

<div class="mobilecate">
    <?php 
    $countProduct = $this->db->where(array('parent_cate'=>$value->id,'status'=>1))->get('shop_products')->num_rows();
    $listPhone = $this->db->where(array('parent_cate'=>$value->id,'new'=>1,'status'=>1))->limit(10)->get('shop_products')->result();
        foreach ($listPhone as $item) {
       
    ?>
    <div class="cell notbadge">
        <?php 
            if(!empty($item->new)){

             echo '<label class="moi"><b>Mới</b>ra mắt</label>';
            }
         ?>
        
        <a href=""> <img width="150" height="150" class="lazy" src="
        <?php 

            $class_product = $this->db->where('id',$item->category)->get('class_products')->row();
            $nameClass = changTitle($class_product->name);
            
            $cate_product = $this->db->where('id',$class_product->cate_product)->get('cate_product')->row();
            $nameCate  =  changTitle($cate_product->name);
            $source = base_url('public/shopping/images/products/'.$nameCate.'/'.$nameClass).'/'.changTitle($item->name).'/';
                if($item->image != null){
                    echo  $source .$item->image;
                }else{
                    echo base_url().'public/shopping/images/products/product.jpg';
                }
//                    echo base_url().'public/shopping/images/products/product.jpg';

         ?>">
            <h3><?php echo ucwords( $item->name )?></h3> 
            <strong><?php echo number_format($item->price,'0',',','.') ?>.000 đ</strong>
            <div class="km"> <span><?php echo ucwords($item->gift) ?></span> </div>
        </a> 



        <a href="<?php echo base_url('shopping/buy/'.$item->id)  ?>" class="buy" data-id="<?php echo $item->id ?>" >Mua</a>
       


        <figure class="bginfo"> 
            <span>Màn hình: <?php echo  $item->monitor ?></span>
            <span>HÐH: <?php echo $item->os ?></span><span>CPU: <?php echo $item->cpu ?>, RAM: <?php echo $item->ram ?></span>
            <span>Camera: <?php echo $item->camera?></span>
            <span>Dung lượng pin: <?php echo $item->battery ?></span> 
                <a class="viewdetail" data-id="<?php echo $item->id ?>">Xem nhanh</a> 
                <a class="fastview" href="">Xem chi tiết</a> 
        </figure> 
    </div>
    <?php } ?>

</div>
<div class="clr"></div>
<div class="row-remove">
    <?php echo  $countProduct > 10 ? '<a href="'.base_url('/shopping/products/'.$value->alias).'" class="btn btn-success viewmore" id="see-more-phone"   >Xem thêm '.$countProduct.'  Điện thoại</a>':''; ?>
    
</div>
<?php 
   
    } 
?>
 <div class="contentfast">
    <div class="clr"></div>
</div>

<script>
   /* $(document).on('click','.viewdetail',function(e){
   
     $(document).on('click','.closefast',function(e){*/
     
 </script>