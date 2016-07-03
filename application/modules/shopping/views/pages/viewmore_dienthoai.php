<?php 
//echo '<pre>';print_r($listPhone);

if(count($listPhone) > 0){
    echo $output = '';
    foreach ($listPhone as $item) {
        $class_product = $this->db->where('id',$item->category)->get('class_products')->row();
        $nameClass = changTitle($class_product->name);
        $cate_product = $this->db->where('id',$class_product->cate_product)->get('cate_product')->row();
        $nameCate  =  changTitle($cate_product->name);
        $source = base_url('public/shopping/images/products/'.$nameCate.'/'.$nameClass).'/'.changTitle($item->name).'/';
       $output .= '<div class="cell notbadge">
                    <label class="moi"><b>Mới</b>ra mắt</label>        
                    <a href=""> <img width="150" height="150" class="lazy" src="';
                            if($item->image != null){
                                $output .= $source.$item->image;
                            }else{
                                $output .= base_url().'public/shopping/images/products/product.jpg';
                            }
                        $output .= '"><h3>'.$item->name.'</h3> <strong>'.number_format($item->price,'0',',','.').'.000 đ</strong>
                        <div class="km"> <span>'.$item->gift.'</span> </div>
                        <a href="'.base_url('shopping/buy/'.$item->id).'" class="buy">Mua</a>
                    <figure class="bginfo"> 
                        <span>Màn hình: '.$item->monitor.'</span>
                        <span>HÐH: '.$item->os.'</span><span>CPU: '.$item->cpu.', RAM: '.$item->ram.'</span>
                        <span>Camera: '.$item->camera.'</span>
                        <span>Dung lượng pin: '.$item->battery.'</span> 
                            <a class="viewdetail" data-id="'.$item->id.'">Xem nhanh</a> 
                            <a class="fastview" href="">Xem chi tiết</a> 
                    </figure> 
                    <span class="arr"></span> 
                </div>
                ';
    }
     $output .= '<div class="row-remove">
            <div class="clr"></div>
                <button class="btn btn-success viewmore" id="see-more-phone" data-id-old ="'.$item->id.'" >Xem thêm  Điện thoại</button>
            </div>';
    echo $output;
}else{
    echo $output = '<div class="row-remove">
            <div class="clr"></div>
                <button class="btn btn-danger viewmore"  >No Data</button>
            </div>';
}
            
        
            

 
       