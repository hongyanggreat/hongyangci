<?php 

    $info = $this->session->userdata('infobuyer');
  //  print_r($info);
?>
<div class="wrap_checkout" id="wrap_cart">
    <div class="ordersuccess">
        <div class="colicon"><i class="icontgdd-checksuccess"></i>
        </div>
        <div class="coltext">
            <strong class="scc">Đặt hàng thành công!</strong>
            <span class="thk">
           
            Cảm ơn 
                <?php 
               // print_r($info);
                    if ($info['iGender'] == 0) {
                        echo 'Chị';
                    }else{

                        echo 'Anh';
                    } 
                ?> 
            <b><?php echo $info['FullName'] ?></b> đã đặt mua hàng tại Shop Điện Thoại Hong Yang</span>
        </div>
    </div>
    <div class="giuhang">Giao hàng miễn phí</div>
    <form class="inputinfo" id="formtest" action="<?php echo base_url('shopping/index/validateAddress') ?>">
        <ul class="tabs">
            <li style="width: 100%"><a class="tab active">Giao tận nơi</a>
            </li>

        </ul>
        <div id="buyathome" class="content athome">
            <div class="checkandbuy">
                <ul class="chooselocal">
                    <li class="lipro">
                        <h3 class="selected" id="province"><b></b>Chọn tỉnh thành</h3>
                         <input type="hidden" name="city" id="city" placeholder="">
                        <div class="city province" style="display: none;">
                            <aside class="listcity">
                               <?php 
                               // echo '<pre>';print_r($province);
                                    foreach ($province as $item) {
                                       echo '<a data-value="'.$item->provinceid.'" data-name="'.$item->name.'">'.$item->name.'</a>'; 
                                    }
                                 ?>
                            </aside>
                        </div>
                    </li>
                    <li class="lidis">
                        <h3 class="selected" id="dist"><b></b>Chọn Quận Huyện</h3>
                         <input type="hidden" name="district" id="district">
                        <div class="city distric" style="display: none;">
                            <aside class="listdistric listcity">
                            Vui Lòng chọn Tỉnh Thành!
                            </aside>
                        </div>
                    </li>
                    <li></li>
                    <li class="liw">
                        <h3 class="selected" id="war"><b></b>Chọn Phường Xã</h3>
                        <input type="hidden" name="ward" id="ward">
                        <div class="city ward" style="display: none;">
                            <aside class="listward listcity">
                            Vui Lòng chọn Quận huyện!
                            </aside>
                        </div>
                    </li>
                     <li class="add">
                        <input type="text" placeholder="Số nhà, tên đường" name="area" id="area" class="ShipAtHome">
                    </li>
                   
                </ul>

                 

                 <script>
                      $(document).ready(function()
                        {
                            $("body").mouseup(function(e)
                            {
                                var province = $("#province"); 
                                var dist    = $("#dist"); 
                                var war    = $("#war"); 

                                if(e.target.id != province.attr('id') && !province.has(e.target).length)
                                {
                                    $('.province').slideUp();
                                }
                                if(e.target.id != dist.attr('id') && !dist.has(e.target).length)
                                {
                                    $('.distric').slideUp();
                                }
                                if(e.target.id != war.attr('id') && !war.has(e.target).length)
                                {
                                    $('.ward').slideUp();
                                }
                                
                            });
                        });
                             
                        $('li.lipro').on('click','h3',function(e){
                            e.preventDefault();
                            $('.province').slideDown();

                        });
                        $('li.lidis').on('click','h3',function(e){
                            e.preventDefault();
                            $('.distric').slideDown();
                        });
                        $('li.liw').on('click','h3',function(e){
                            e.preventDefault();
                            $('.ward').slideDown(); 
                        });
                    
                                
                        $('.listcity a').click(function(e){
                             e.preventDefault();
                            var province = $(this).data('name');
                            var province_id = $(this).data('value');
                            $('li.lipro h3').html('<b></b>'+ province);
                            $('input#city').val(province);
                            $('.lipro').css("background", "#fff");
                            $('.lidis').css("background", "#f9f9f9");
                            $('.liw').css("background", "#f9f9f9");
                           $.ajax({
                                url:'<?php echo base_url('shopping/index/district') ?>',
                                method:'POST',
                                data:{'province_id':province_id},
                                dataType:'json',
                                    success:function(data){
                                        var output = '';
                                        $.each(data,function(key,value){
                                            output += '<a data-id="'+ key +'" data-value="'+ value +'">'+value+'</a>';
                                            $('li.lidis h3').html('<b></b> Chọn Quận Huyện');
                                            $("#district").val('');
                                            $('li.liw h3').html('<b></b> Chọn Phường Xã');
                                            $("#ward").val('');
                                        });
                                            $('.listdistric').html(output);       
                                        //location.reload(true); 
                                    }
                            });
                        });
                        
                       
                      $('.listdistric').on( 'click', 'a', function() {
                            var distric = $(this).data('value');
                            var distric_id = $(this).data('id');
                           // alert(distric_id);
                            $('li.lidis h3').html('<b></b>'+ distric);
                            $('input#district').val(distric);
                            $('.lidis').css("background", "#fff");
                            $('.liw').css("background", "#f9f9f9");
                            $.ajax({
                                url:'<?php echo base_url('shopping/index/ward') ?>',
                                method:'POST',
                                data:{'distric_id':distric_id},
                                dataType:'json',
                                    success:function(data){
                                      //  alert(data);
                                        var output = '';
                                        $.each(data,function(key,value){
                                            output += '<a data-id="'+ key +'" data-value="'+ value +'">'+value+'</a>';
                                            $('li.liw h3').html('<b></b> Chọn Phường Xã');
                                            $("#ward").val('');

                                        });
                                            $('.listward').html(output);       
                                    }
                            });
                        });


                    

                       $('.listward ').on('click','a',function(e){
                             var ward = $(this).data('value');
                            // alert(ward); 
                            $('li.liw h3').html('<b></b>'+ ward);
                            $('input#ward').val(ward);
                            $('.liw').css("background", "#fff");
                            $('.ShipAtHome').focus().css("background", "#fff");

                        });
                    </script>
            </div>
            <div class="clr"></div>
            <div class="choosetime">
                <strong>Chọn thời gian nhận hàng</strong>
              
            </div>
            <div class="clr"></div>
        </div>
        
    <div class="actionSubmit wrap_btn">
            <div class="clr"></div>
        <input type="submit" class="btnpayonline " name="submit" value="Hoàn tất">
    </div>
  
    <a class="home" href="/">Về trang chủ</a>
</div>
</form>
<script>
   $('#formtest').submit(function(e){
    e.preventDefault();
    var me = $(this);
    var url = me.attr('action');
    var address = $('#address').val();
//    alert(address);

    $.ajax({
        url:url,
        type:'post',
        
        data:$(this).serialize(),
        //data:{city:'city'},
        dataType:'json',
        success:function(response){
           // alert(response);
             if(response.success == true){
                $('li').find('.error').remove();
                
                 $.ajax({
                    url:'<?php echo base_url("shopping/index/save") ?>',
                    type:'post',
                    data:$('#formtest').serialize(),
                    dataType:'html',
                    success:function(d){
                       //alert(d);
                        window.location.href = "<?php echo base_url('shopping/infoOrder') ?>";
                    }
                 });   
             }else{
                $.each(response.message,function(key,value){
                   // alert(key);
                    var element = $('#'+key);
                    element.closest('li').find('.error').remove();
                    element.after(value);
                });
             }
           
        }
    });    
   });
   
</script>