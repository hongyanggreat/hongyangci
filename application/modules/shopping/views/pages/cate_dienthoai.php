
  <?php   isset($filter)?$this->load->view($filter):'' ?>
<div class="mobilecate">
    <?php 
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

         ?>">
            <h3><?php echo $item->name ?></h3> 
            <strong><?php echo number_format($item->price,'0',',','.') ?>.000 đ</strong>
            <div class="km"> <span><?php echo $item->gift ?></span> </div>
        </a> 



        <a href="<?php echo base_url('shopping/buy/'.$item->id)  ?>" class="buy" data-id="<?php echo $item->id ?>" >Mua</a>
       


        <figure class="bginfo"> 
            <span>Màn hình: <?php echo $item->monitor ?></span>
            <span>HÐH: <?php echo $item->os ?></span><span>CPU: <?php echo $item->cpu ?>, RAM: <?php echo $item->ram ?></span>
            <span>Camera: <?php echo $item->camera ?></span>
            <span>Dung lượng pin: <?php echo $item->battery ?></span> 
                <a class="viewdetail" data-id="<?php echo $item->id ?>">Xem nhanh</a> 
                <a class="fastview" href="">Xem chi tiết</a> 
        </figure> 
    </div>
    <?php } ?>

</div>
<div class="clr"></div>
<div class="row-remove">
    <button class="btn btn-success viewmore" id="see-more-phone" data-id-old ="<?php echo $item->id ?>"  >Xem thêm  Điện thoại</button>
</div>

        <script>
       
            $(document).ready(function(){
                $(document).on('click','#see-more-phone',function(e){
                    var idOld = $('#see-more-phone').data('id-old');

                    var url = '<?php echo base_url('shopping/viewmore') ?>'
                    $.ajax({
                        url:url,
                        method:'POST',
                        data:{'id':idOld},
                        dataType:'html',
                         beforeSend:function(){

                           $('#see-more-phone').html('<span class="load">Loading...</span>');
                        },
                        complete:function(){
                            $(".load").remove();
                        },
                        success:function(data){
                            //alert(data);
                            if(data != ''){

                                $('.row-remove').remove();
                                $('.mobilecate').append(data);
                            }
                        }
                    });
                });
            });

        </script>
         <script>
           /*  var idOld = $('#see-more-phone').data('id-old');
            $(window).scroll(function() {
               if($(window).scrollTop() + $(window).height() == $(document).height()) {
                   $.ajax({
                        url:'viewmore',
                        method:'POST',
                        data:{'id':idOld},
                        dataType:'html',
                         beforeSend:function(){

                           $('#see-more-phone').html('<span class="load">Loading...</span>');
                        },
                        complete:function(){
                            $(".load").remove();
                        },
                        success:function(data){
                            if(data != ''){

                                $('.row-remove').remove();
                                $('.mobilecate').append(data);
                            }
                            //console.log(data);
                        }
                    });
               }
            });*/

        </script>
      
<?php 
//$this->session->sess_destroy();
 ?>

 <div class="contentfast">
    <div class="clr"></div>
</div>