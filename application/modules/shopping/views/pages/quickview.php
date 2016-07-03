 <div class="fastinfo">
 <i class="closefast icontgdd-closefast" ></i>
            <aside class="slidecolor">
                <div class="colorimg">
                    <img alt="" src="<?php 
                            $source = base_url().'public/shopping/images/products/'.$item->nameCate.'/'.$item->nameClass.'/'.changTitle($item->name).'/';
                        if($item->image != null){
                            echo $source.$item->image;
                        }else{
                            echo base_url().'public/shopping/images/products/product.jpg';
                        }
                     ?>">
                </div>
                    <div class="numcolor"><?php echo count($images); ?> Kiểu Dáng </div>
                    <div class="tabscolor">
                            <?php 
                                if (count($images) > 0) {
                                    foreach ($images as $img) {
                                
                             ?>
                            <a href="javascript:;" onclick="replaceImg(this)">
                                <div>
                                    <img src="<?php echo $source.$img->name; ?>" alt="">
                                </div>
                                <span><?php echo $img->color ?></span>
                            </a>
                            <?php 
                                    }
                                }
                             ?>
                    </div>
                    <script>
                      function replaceImg(n) {
                            var t = $(n).find("img").attr("src");
                            $(".tabscolor a").removeClass("active");
                            $(n).addClass("active");
                            $(".fastinfo .colorimg img").attr("src", t)
                        }
                    </script>
            </aside>
            <aside class="infosale">
                <a class="quicktitle" href=""><?php echo ucwords($item->name) ?></a>
                <div class="price">
                    <strong><?php echo number_format($item->price,'0',',','.') ?>.000 ₫</strong>
                    <span class="status"></span>
                </div>
<div class="promotion"><div class="title"><label>khuyến mãi</label></div><span class="pro261342"><?php echo $item->gift ?><label class="infoend"></label></span></div>                                <div class="infofollow">
                        <span>Phụ Kiện Kèm theo: <b> at here</b></span>
                        <span>Bảo hành chính hãng: Chế độ ở đây- <a class="pWarr" target="_blank" href="">Xem điểm bảo hành</a></span>

                </div>
    <a href="<?php echo base_url('shopping/buy/'.$item->id); ?>" class="buynow" >Mua ngay <span>Xem hàng, không thích không mua</span></a>
                    <a href="" class="buyinstall">Mua trả góp <span>Xét duyệt qua điện thoại</span></a>

                <div class="clr"></div>
                    <ul class="sortdesc">
                             <?php 
                                $tmp = explode('|',$item->description);
                             // echo '<pre>';   print_r($tmp);
                               foreach ($tmp as $des) {
                                 echo '<li>'.$des.'</li>';
                               }

                           /* $i=0;
                               */
                            ?>
                           <!--  <li>Trang bị vi xử lý 8 nhân, RAM 2 GB giúp xử lý tốt các tác vụ đa nhiệm, ứng dụng nặng hay game có đồ họa cao.</li>
                           <li>Khung kim loại được gia công CNC tinh tế, chắc chắn giúp máy mỏng nhưng vẫn đảm bảo cho máy chắc chắn, cứng cáp.</li>
                           <li>Camera 16 MP khẩu độ f/1.9, camera selfie 5 MP góc rộng cho các bức ảnh chụp sáng và đẹp.</li>
                           <li>Cảm biến vân tay giúp tăng cường bảo mật cho thiết bị, giúp an tâm và tiện dụng hơn.</li> -->
                    </ul>
                <div class="viewdetalcomment">
                    <a href="" class="bdr">Xem chi tiết sản phẩm</a>
                        <a href=""><?php echo rand(142546,242546) ?> bình luận, đánh giá</a>                    
                </div>
            </aside>
        </div>