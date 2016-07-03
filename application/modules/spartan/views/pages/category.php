<header class="archive-header clr">
    <?php echo $paginator ?>
    
</header>
<div id="blog-wrap" class="clr">
        <article class="archive-featured-post clr">
            <div class="archive-featured-post-media clr">
                <figure class="archive-featured-post-thumbnail">
                    <div class="entry-cat-tag cat-28-bg"> <a href="" title="<?php echo $category->name ?>"><?php echo $category->name ?></a> </div>
                    <!-- .entry-cat-tag -->
                    <a href="<?php echo base_url('/').$oneArticle->alias ?>" title="">
                        <div class="post-thumbnail"> <img src="<?php echo base_url('public/upload/cungtot/'. $oneArticle->image) ?>" alt="<?php echo $oneArticle->title ?>" width="620" height="350"> </div>
                        <!-- .post-thumbnail -->
                    </a>
                </figure>
                <!-- .archive-featured-post-thumbnail -->
            </div>
            <!-- .archive-featured-post-media -->
            <div class="archive-featured-post-content clr">
                <header>
                    <h2 class="archive-featured-post-title">
                <a href="<?php echo base_url('/').$oneArticle->alias ?>" title="<?php echo $oneArticle->title ?>"><?php echo $oneArticle->title ?></a>
            </h2> </header>
                <div class="archive-featured-post-excerpt clr"> <?php echo substr($oneArticle->intro,0,180) ?>&hellip;</div>
                <!-- .archive-featured-post-excerpt -->
            </div>
            <!-- .archive-featured-post-content -->
        </article>
        <!-- .archive-featured-post -->
        <?php
            foreach ($moreArticle as $item) {
        ?>
        <article id="post-439" class="clr post-439 post type-post status-publish format-standard has-post-thumbnail hentry category-nascar category-sports tag-adrenaline tag-thoughts loop-entry  col1 col">
            <div class="loop-entry-media clr">
                <div class="entry-cat-tag cat-26-bg"> <a href="" title="<?php echo number_format($item->view,0,",",".").' View' ?>"><?php echo number_format($item->view,0,",",".") ?> View</a> </div>
                <!-- .entry-cat-tag -->
                <figure class="loop-entry-thumbnail">
                    <a href="<?php echo base_url('/').$item->alias ?>" title="">
                        <div class="post-thumbnail"> <img src="<?php echo base_url('public/upload/cungtot/'. $item->image) ?>" alt="<?php echo $item->image ?>" alt="" width="620" height="350"> </div>
                        <!-- .post-thumbnail -->
                    </a>
                </figure>
                <!-- .loop-entry-thumbnail -->
            </div>
            <!-- .loop-entry-media -->
            <div class="loop-entry-content clr">
                <header>
                    <h2 class="loop-entry-title">
        <a href="<?php echo base_url('/').$item->alias ?>" title="<?php echo $item->title ?>"> <?php echo substr($item->title,0,30) ?> ...</a>
    </h2> </header>
                <div class="loop-entry-meta clr">
                    <div class="loop-entry-meta-date"> <span class="fa fa-clock-o"></span><?php echo $item->created_at ?> </div>
                    <div class="loop-entry-meta-comments"> <span class="fa fa-comments"></span><a href="" class="comments-link"><?php echo number_format(($item->view + 158),0,",",".") ?> Comments</a> </div>
                </div>
                <!-- .loop-entry-meta -->
                <div class="loop-entry-excerpt entry clr"><?php echo substr($item->intro,0,120) ?>&hellip;</div>
                <!-- .loop-entry-excerpt -->
            </div>
            <!-- .loop-entry-content -->
        </article>
        <?php } ?>
    </div>
       <?php echo $paginator ?>