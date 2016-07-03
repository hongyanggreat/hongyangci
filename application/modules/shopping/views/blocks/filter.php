<div class="filter">
    <!--#region Hãng-->
    <div class="left"> 
        <div class="manufac">
            <label>Xem Theo Hãng<sub></sub> </label>
            <div class="listmanu">
                <aside> 
                <?php
                    foreach ($classProduct as $item) {
                       $cateProuct =  $this->db->where('id',$item->cate_product)->get('cate_product')->row();
                        echo '<a href="'.base_url('/shopping/products/'.$cateProuct->alias.'/'.$item->alias).'">'.$item->name.'</a> ';
                    }
                 ?>
                    
                    
                </aside>
                <aside> </aside>
                <div class="clr"></div>
            </div>
        </div>
    </div>
    <!--#endregion-->
    <!--#region Sort-->
    <div class="sortprice">
        <label>Giá thấp đến cao <sub></sub> </label>
        <div class="listsort"> <a href="/laptop?o=gia-cao-den-thap">Giá cao đến thấp</a> <a href="/laptop?o=xem-nhieu-nhat">Xem nhiều nhất</a> </div>
    </div>
    <!--#endregion-->
    <!--#region Tính năng-->
    <div class="attribute">
        <label>Tính năng <sub></sub> </label>
        <div class="listattribute"> <a href="/laptop?g=core-m">
                        Core M
                    </a> <a href="/laptop?g=celeron">
                        Celeron
                    </a> <a href="/laptop?g=pentium">
                        Pentium
                    </a> 
            <div class="clr"></div>
        </div>
    </div>
    <!--#endregion-->
    <!--#region Giá-->
    <div class="center"> <span>Mức giá:</span> <a href="/laptop?p=duoi-8-trieu">
Dưới 8 triệu                </a> <a href="/laptop?p=tu-8-10-trieu">
Từ 8 - 10 triệu                </a> <a href="/laptop?p=tu-10-12-trieu">
Từ 10 - 12 triệu                </a> <a href="/laptop?p=tu-12-15-trieu">
Từ 12 - 15 triệu                </a> <a href="/laptop?p=tren-15-trieu">
Tr&#234;n 15 triệu                </a> </div>
    <!--#endregion-->
</div>
<div class="clearfilter">
<?php 
    if(!empty($this->session->userdata('nameClass'))){
        echo ' <a href="">'.$this->session->userdata('nameClass').' <i class="icontgdd-delete"></i></a> ';
    }
 ?>
     
</div>
<script>
    $(document).on('click','.listmanu aside a',functopn(){
        alert(1);
    })
</script>