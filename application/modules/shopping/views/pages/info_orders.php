

<style>
    .ordersuccess{
        width: 50%;
        margin: 0 auto;
    }
</style>
<?php //echo '<pre>';print_r($infoOrder) ?>
<div class="ordersuccess">
    <div class="colicon"><i class="icontgdd-checksuccess"></i>
    </div>
    <div class="coltext"> <strong class="scc">Đặt hàng thành công!</strong>
        <div class="listinfo">
            <div class="listinfo">
        
                <div><b>1</b>. Danh sách sản phẩm mua:</div>
                <ul class="listcart">
                    <?php 
                        foreach ($infoOrder as $value) {
                            echo '<li>
                                    <h3>
                                        <b>Sản phẩm:  '.ucwords($value['name_product']).' </b> <br>
                                        + Số Lượng '.$value['qty'].' cái .<br> 
                                        + Đơn giá : <strong>'.number_format($value['price'],'0',',','.').'.000 đ</strong> 
                                    </h3> + Khuyến mại Kèm theo sản phẩm :'.ucwords($value['gift']).' </li>';
                        }
                     ?>
                    
                    <h3><b>Tổng tiền</b>: <strong><?php echo number_format($infoOrder[0]['total_price'],'0',',','.') ?>.000 đ</strong></h3> </li>
                </ul>
                <div><b>2</b>. Thông tin người mua hàng: <b><?php 
                if($infoOrder[0]['gender'] == 0){
                    echo 'Chị ';
                }else{
                    echo 'Anh ';
                }
                echo ucwords($infoOrder[0]['name']) ?></b>
                </div>
                <div><b>3</b>. Địa chỉ nhận hàng: <b><?php echo ucwords($infoOrder[0]['area'].' - '.$infoOrder[0]['ward'].' - '.$infoOrder[0]['district'].' - '.$infoOrder[0]['city'])  ?></b>
                </div>
                <div> <b>4</b>. <b>Thanh toán tiền mặt khi nhận hàng</b> </div>
                <div>Nhân viên sẽ liên hệ lại với 
                <?php 
                if($infoOrder[0]['gender'] == 0){
                    echo 'Chị ';
                }else{
                    echo 'Anh ';
                }
                echo ucwords($infoOrder[0]['name']) ?>
                 để xác nhận thông tin đặt hàng trong 5 phút.</div>
            </div>
            <div class="help"> Khi cần trợ giúp vui lòng gọi <a href="tel:0944255241">0944255241</a> hoặc <a href="tel:0936384083">0936384083</a> (7h30 - 22h00) </div>
        </div>
    </div>
</div>