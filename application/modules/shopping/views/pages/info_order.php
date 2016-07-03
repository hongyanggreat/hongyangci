<style>
    .ordersuccess{
        width: 50%;
        margin: 0 auto;
    }
</style>
<div class="ordersuccess">
    <div class="colicon"><i class="icontgdd-checksuccess"></i>
    </div>
    <div class="coltext"> <strong class="scc">Đặt hàng thành công!</strong>
        <div class="listinfo">
            <div class="listinfo">
        <?php 
            //echo '<pre>'; print_r($infoDetailProduct) 
        ?>
                <div><b>1</b>. Danh sách sản phẩm mua:</div>
                <ul class="listcart">
                    <?php 
                        foreach ($infoDetailProduct as $item) {
                            echo '<li>  <h3><b>- '.$item->qty.' sản phẩm:</b> '.$item->name.' giá <strong>'.number_format($item->price,'0',',','.').'đ</strong> </h3> + Khuyến mại Kèm theo sản phẩm :'.$item->gift.' </li>';
                        }
                     ?>
                    
                    
                    <h3>Tổng tiền: <strong><?php echo number_format($infoOrder->total_price,'0',',','.') ?>đ</strong></h3> </li>
                </ul>
                <?php 
                    if($infoUser->gender == 1){

                        $gender = 'Anh';
                    }else{
                        $gender = 'Chị';

                    }
                 ?>
                <div><b>2</b>. Thông tin người mua hàng: <b><?php echo $gender . ' '.$infoUser->name ?></b>
                </div>
                <div><b>3</b>. Địa chỉ nhận hàng: <b><?php echo $infoGiaohang->area .','.$infoGiaohang->ward .','.$infoGiaohang->district .','.$infoGiaohang->city ?></b>
                </div>
                <div> <b>4</b>. <b>Thanh toán tiền mặt khi nhận hàng</b> </div>
                <div>Nhân viên sẽ liên hệ lại với <?php echo $gender . ' '.$infoUser->name ?> để xác nhận thông tin đặt hàng trong 5 phút.</div>
            </div>
            <div class="help"> Khi cần trợ giúp vui lòng gọi <a href="tel:0944255241">0944255241</a> hoặc <a href="tel:0936384083">0936384083</a> (7h30 - 22h00) </div>
        </div>
    </div>
</div>