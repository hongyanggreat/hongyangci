<div>
<?php 
    foreach ($listArticle as $item) {
?>					
<article id="post-74" class="clr post-74 post type-post status-publish format-gallery has-post-thumbnail hentry category-formula-1 category-sports tag-beautiful tag-creative tag-perspective post_format-post-format-gallery loop-entry cat-29 cat-28 ">
    
<div class="loop-entry-media clr">
        <figure class="loop-entry-thumbnail">
                    <a href="<?php echo base_url($item->alias) ?>" title="<?php echo $item->title ?>">
                                <div class="post-thumbnail">
                <img src="<?php echo base_url('/public/upload/cungtot/'.$item->image) ?>" alt="<?php echo $item->image ?>" width="620" height="350">
            </div><!-- .post-thumbnail -->
        </a>
    </figure><!-- .loop-entry-thumbnail -->
</div><!-- .loop-entry-media -->    <div class="loop-entry-content clr">
        
<header>
    <h2 class="loop-entry-title">
        <a href="<?php echo base_url($item->alias) ?>" title="<?php echo $item->title ?>">
           <?php echo $item->title ?></a>
    </h2>
    </header>       
<div class="loop-entry-meta clr">
                    <div class="loop-entry-meta-date">
                    <span class="fa fa-clock-o"></span><?php echo $item->created_at ?></div>
                                        <div class="loop-entry-meta-comments">
                    <span class="fa fa-eye"></span><a href="" class="comments-link"><?php echo number_format($item->view,'0',',','.') ?> View</a>                </div>
                    </div><!-- .loop-entry-meta -->     
<div class="loop-entry-excerpt entry clr"><?php echo substr($item->intro,0,120) ?> &hellip;</div><!-- .loop-entry-excerpt -->  </div><!-- .loop-entry-content -->
</article><!-- .loop-entry -->
<?php } ?>

</div><!-- #blog-wrap -->
<?php echo $paginator ?>
							