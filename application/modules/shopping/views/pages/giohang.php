<section>
<?php //echo '<pre>';print_r($this->session->userdata) ?>
<section id="wrap_cart">
        <div class="wrap_header">
            <div class="header">Giỏ hàng của bạn</div>
        </div>
        <div class="wrap_checkout">
            <form id="formtest" class="inputinfo" action="<?php echo base_url('shopping/index/verifyByer') ?>" method="post">
                    <div class="detail_cart">
            <!-- <div class="message" style="display: block;">
                
            </div> -->
        <ul class="listorder">
                <?php 
                    foreach ($products as $item) {
                    $class_product = $this->db->where('id',$item['category'])->get('class_products')->row();
                     //echo '<pre>';print_r($class_product);
                    $nameClass = changTitle($class_product->name);
                    $cate_product = $this->db->where('id',$class_product->cate_product)->get('cate_product')->row();
                    $nameCate  =  changTitle($cate_product->name);
                    $nameProduct =  changTitle($item['name']);
                        
                        $source = base_url('public/shopping/images/products/'.$nameCate.'/'.$nameClass).'/'. $nameProduct.'/';
                 ?>
                <li>
                    <a href="">
                        <img height="80" src="
                            <?php 
                                 if($item['image'] != null){
                                    echo $source.$item['image'];
                                }else{
                                    echo base_url().'public/shopping/images/products/product.jpg';
                                }
                             ?>
                        ">
                    </a>
                    <h3><?php echo  $item['name'] ?></h3>
                    Đơn giá :
                    <?php echo number_format($item['price'],'0',',','.') ?>₫
                    <br>
                    Thành tiền :
                    <strong><?php echo number_format($item['subtotal'],'0',',','.') ?>₫</strong>
                    <div class="promotion">Khuyến Mại :<div class="title"></div><span class="pro261606"><?php echo $item['gift'] ?></label></span></div>
                    <div class="action">
                        Số Lượng : 
                            <span><i class="fa fa-minus-circle " aria-hidden="true"></i></span> 
                            <input type="text" class="qty" name="qty" value="<?php echo $item['qty'] ?>" data-rowid="<?php echo $item['rowid'] ?>">
                            <span><i class="fa fa-plus-circle" aria-hidden="true"></i></span> 
                        <button type="reset" class="delete" data-rowid="<?php echo $item['rowid'] ?>" >Xóa</button>
                    </div>
                </li>
                
                <?php } ?>
           </ul>
            <div class="total">
                <b>Tổng tiền </b>
                <strong><?php echo number_format($this->cart->total(),'0',',','.') ?>₫</strong>
            </div>
    </div>

                <div class="choosegender row-render">
                    <label class="male " data-value="1"><i class="icontgdd-opt"></i>Anh</label>
                    <label class="female check " data-value="0"><i class="icontgdd-opt"></i>Chị</label>
                    <input id="iGender" name="iGender" type="hidden" value="0">
                </div>

                <script>
                    $('.icontgdd-opt').click(function(){
                        var value = $(this).parent().data('value');
                        //alert(value);
                        $('.icontgdd-opt').parent().removeClass('check');
                        $(this).parent().addClass('check');
                        $('#iGender').val(value);
                    });
                </script>
                <div class="row-input">
                    <input type="text" class="name" name="FullName" id="FullName" placeholder="Họ và tên" >
                </div>
                <div class="row-input">
                    <input type="tel" class="phone" name="PhoneNumber" id="PhoneNumber" placeholder="Số điện thoại" >
                </div>
                <div class="clr"></div>
                <div class="wrap_btn">
                <?php 
                    if($this->cart->total_items() > 0){
                        echo '<input type="submit" name="submit" class="buynowmulity" value="Mua ngay">';
                    }else{
                        echo '<br>Giỏ hàng của quý khách chưa có sản phẩm.Hãy nhấp vào tiếp tục mua hàng để chọn sản phẩm ! ';
                    }
                 ?>
                    
                            <!-- <a  class="buynowmulity" >Mua ngay <span>Xem hàng, không thích không mua</span></a> -->
                </div>
            </form>
        </div>
    <div class="continue">
        <a href="<?php echo base_url('/shopping/products/dien-thoai') ?>"><b>‹</b> Tiếp tục mua sắm</a>
    </div>
    <p class="poli">Bạn đồng ý với <a href="">Điều khoản sử dụng</a> của TGDD khi đặt mua</p>
</section>

        <div class="clr"></div>
    </section>

    
    <script>
    $(".fa-minus-circle").click(function(){
        //alert('fa-minus-circle');
        var oldQty = $(this).parent().next().val();
        if(oldQty-1 >= 0 ){
            $(this).parent().next().val(oldQty-1);
        }

        var qty =  oldQty-1;
        var rowid = $(this).parent().next().data('rowid');
         $.ajax({
                    url:'<?php echo base_url('shopping/index/update') ?>',
                    method:'POST',
                    data:{'qty':qty,'rowid':rowid},
                    dataType:'html',
                        success:function(data){
                            location.reload(true); 
                        }
                });
    });
    $(".fa-plus-circle").click(function(){
        var oldQty = parseInt($(this).parent().prev().val());
        $(this).parent().prev().val(oldQty+1);
        var qty =  oldQty + 1;
        var rowid = $(this).parent().prev().data('rowid');
        //alert(rowid);
        $.ajax({
            url:'<?php echo base_url('shopping/index/update') ?>',
            method:'POST',
            data:{'qty':qty,'rowid':rowid},
            dataType:'html',
                success:function(data){
                    location.reload(true); 
                }
        });
    }); 
    $(".delete").click(function(){
        var qty =  0;
        var rowid = $(this).data('rowid');
       // alert(rowid);
        $.ajax({
            url:'<?php echo base_url('shopping/index/update') ?>',
            method:'POST',
            data:{'qty':qty,'rowid':rowid},
            dataType:'html',
                success:function(data){
                    location.reload(true); 
                }
        });
    });
</script>

<script>
    $(document).ready(function(){

        $('.qty').change(function(){
           var qty =  $(this).val();
           var rowid =  $(this).data('rowid');
             $.ajax({
                url:'<?php echo base_url('shopping/index/update') ?>',
                method:'POST',
                data:{'qty':qty,'rowid':rowid},
                dataType:'html',
                    success:function(data){
                          location.reload(true); 
                    }
            });
        });
    });
</script>

<script>
   $('#formtest').submit(function(e){
    e.preventDefault();
    var me = $(this);
    var url = me.attr('action');
    $.ajax({
        url:url,
        type:'post',
        data:me.serialize(),
        dataType:'json',
        success:function(response){
           //alert(response)
            if(response.success == true){
                //alert('success');
                $('.error').remove();
                $('#wrap_cart').html('');
                $.ajax({
                    url:'<?php echo base_url('shopping/index/checkout') ?>',
                    method:'POST',
                    data:me.serialize(),
                    dataType:'html',
                        success:function(data){
                            
                            $('#wrap_cart').html(data);
                        }
                });
            }else{
                $.each(response.message,function(key,value){
                   // alert(key);
                    var element = $('#'+key);
                    element.closest('.row-input').find('.error').remove();
                    element.after(value);
                });
            }
        }
    });    
   });
   
</script>