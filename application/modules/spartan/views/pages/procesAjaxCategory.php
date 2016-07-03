   
<?php
if(count($listArticle) > 0){
$output ='';
     foreach ($listArticle as $item) {
        $output .=  '<article id="post-439" class="clr post-439 post type-post status-publish format-standard has-post-thumbnail hentry category-nascar category-sports tag-adrenaline tag-thoughts loop-entry  col1 col">
            <div class="loop-entry-media clr">
                <div class="entry-cat-tag cat-26-bg"> <a href="" title="'.number_format($item->view,0,",",".").' view">'.number_format($item->view,0,",",".").' View</a> </div>
                <figure class="loop-entry-thumbnail">
                    <a href="'.base_url('/').$item->alias.'" title="">
                        <div class="post-thumbnail"> <img src="'.base_url('public/upload/cungtot/'. $item->image).'" alt="'. $item->image.'" alt="" width="620" height="350"> </div>
                    </a>
                </figure>
            </div>
            <div class="loop-entry-content clr">
                <header>
                    <h2 class="loop-entry-title">
        <a href="'.base_url('/').$item->alias.'" title=""> '.$item->id. substr($item->title,0,30).' ...</a>
    </h2> </header>
                <div class="loop-entry-meta clr">
                    <div class="loop-entry-meta-date"> <span class="fa fa-clock-o"></span><?php echo $item->created_at ?> </div>
                    <div class="loop-entry-meta-comments"> <span class="fa fa-comments"></span><a href="" class="comments-link">'.number_format(($item->view + 158),0,",",".").' Comments</a> </div>
                </div>
                <div class="loop-entry-excerpt entry clr">'.substr($item->intro,0,120).'&hellip;</div>
            </div>
        </article>';
    }
    $output .=  '<div class="row-remove">
                    <button class="btn btn-success" id="see-more-category" data-limit="'.$limit.'" data-id="'.$item->id.'" data-id-one="'.$idOne.'" data-category="'.$category.'">Load more data</button>
                </div>';
   
}else{
    $output =  '<div class="row-remove">
                    <button class="btn btn-danger" id="no-more-category">No Data</button>
                </div>';
}
    echo  $output;
        
?>
