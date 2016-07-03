

 <header>
        <div class="wrap-main"> <a class="logo" title="" href="<?php echo base_url('/shopping') ?>"><i class="icontgdd-logo"></i></a>
            <form id="search-site" action="" method="get">
                <input class="topinput" id="search-keyword" name="key" type="text" placeholder="Bạn tìm gì..." autocomplete="off"  maxlength="50" />
                <button class="btntop" type="submit"><i class="icontgdd-topsearch"></i>
                </button>
            </form>
            <nav> 
            <?php 
                $result = $this->db->where('status',1)->get('cate_product')->result();
               // print_r($result);
                foreach ($result as  $value) {
                    echo '<a href="'.base_url('shopping/products/'.$value->alias).'" class=" mobile " id="menu" title="">'.$value->name.'</a> ';
                }

             ?>
                
                <a href="<?php echo base_url('shopping/giohang/') ?>" class="giohang" id="giohang" title="giỏ hàng">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i> <br>Giỏ Hàng
                <span class="cart-button__item-count"><?php echo $this->cart->total_items() ?></span>
                </a> 
            </nav>

        </div>
        <div class="clr"></div>
        <div class="">
           
        </div>
    </header>
    