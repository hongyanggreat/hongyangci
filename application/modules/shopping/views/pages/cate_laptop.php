 <?php   isset($filter)?$this->load->view($filter):'' ?>
<ul class="laptopcate">
       
    <?php 
        foreach ($listLaptop as $item) {
     ?>
        <li >
            <a href="" title="">
                    <img width="150" height="150" src="https://cdn3.tgdd.vn/Products/Images/44/75558/lenovo-ideapad-100s-11-200x200.jpg" />
                                <h3><?php echo $item->name ?></h3>
                    <strong><?php echo number_format($item->price,'0',',','.') ?>₫</strong>
                                                    <div class="km">
                            <span><?php echo $item->gift ?></span>                            
                    </div>
            </a>
                <a href="" class="buy">Mua</a>    
            <figure class="bginfo">
                <span>Màn hình: <?php echo $item->monitor ?></span><span>CPU: <?php echo $item->cpu ?></span><span>RAM: <?php echo $item->ram ?></span><span>VGA: <?php echo $item->vga ?></span><span>HĐH: <?php echo $item->os ?></span><span>Pin: <?php echo $item->battery ?></span>
            </figure>
        </li>
    <?php } ?>

        
</ul>
<div class="clr"></div>
        <a href="" class="viewmore">Xem thêm 49 laptop <b></b></a>