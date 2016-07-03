<article class="single-post-article clr">
    <div class="single-post-media clr">
        <div class="post-thumbnail"> 
        <img src="<?php echo base_url('public/upload/cungtot/'. $item->image) ?>" alt="<?php echo $item->image ?>" width="620" height="350">

        </div>
        <!-- .post-thumbnail -->
    </div>
    <!-- .single-post-media -->
    <header class="post-header clr">
        <h1 class="post-header-title"><?php echo $item->title ?></h1>
        <div class="post-meta clr"> 
            <span class="post-meta-date">Posted on <?php echo $item->created_at ?></span> 
            <span class="post-meta-author">
            by <a href="<?php echo base_url('author/'.$itemUser->username) ?>" title="Posts by <?php echo $item->article_user ?>" rel="author"><?php echo $itemUser->username ?></a>        </span> 
            <span class="post-meta-category">
            in <a href="<?php echo base_url('spartan/category/'.$itemCategory->alias )?>"><?php echo strtolower($itemCategory->name) ?></a>
            </span> 
            <span class="post-meta-comments">
                with <a href="#" class="comments-link"><?php echo number_format($item->view ,0,',','.')?> View</a>            </span> </div>
        <!-- .post-meta -->
    </header>
    <!-- .page-header -->
    <div class="entry clr">
        <div class="ad-spot post-top-ad clr">
            <a href="<?php echo $itemAds->link ?>" title="Ad" target="_blank">
            <img src="<?php echo base_url('public/quangcao/'. $itemAds->image) ?>" alt="Ad" width="250" height="auto">
            </a>
            <i id="close"class="fa fa-times" aria-hidden="true"></i>
        </div>

        <div class="ad-spot2 post-top-ad clr" style="display: none">
            <a href="<?php echo $itemAds->link ?>" title="Ad" target="_blank">
            <img src="<?php echo base_url('public/quangcao/'. $itemAds->image) ?>" alt="Ad" width="250" height="auto">
            </a>
            <i id="closes"class="fa fa-times" aria-hidden="true"></i>
        </div>
        <!-- .ad-spot -->
        <?php echo $item->content ?>
    </div>
    <!-- .entry -->
    



    <div class="next-prev clr">
        <?php 
            if(isset($linkPre)){
               echo '<div class="post-prev">
                        <a href="'.base_url('/').$linkPre->alias.'" rel="next"><img src="http://wpexplorer-demos.com/spartan/wp-content/themes/wpex-spartan/images/prev-post.png" alt="Next Article">Previous Article</a>
                    </div>'; 
            }
        ?>
        <?php 
            if(isset($linkNext)){
               echo '<div class="post-next">
                        <a href="'.base_url('/').$linkNext->alias.'" rel="prev"><img src="http://wpexplorer-demos.com/spartan/wp-content/themes/wpex-spartan/images/next-post.png" alt="Next Article">Next Article</a>
                    </div>'; 
            }
        ?>
    </div>
    <div class="author-bio clr">
        <div class="author-bio-avatar clr">
            <a href="" title="Visit Author Page"><img src="<?php echo base_url('public/upload/admin/user').'/'.$itemUser->username.'/thumb/'.$itemUser->image ?>" class="avatar avatar-60 photo" alt="<?php echo $itemUser->username ?>" height="60" width="60">
            </a>
        </div>
        <!-- .author-bio-avatar -->
        <div class="author-bio-content clr">
            <div class="author-bio-author clr"> Authored by: <a href="<?php echo base_url('author/'.$itemUser->username) ?>"><?php echo $itemUser->username ?></a>
            </div>
            <div class="author-bio-url"> <span>Email:</span><a href="mailto:<?php echo $itemUser->email ?>" target="_blankp"><?php echo $itemUser->email ?></a></div>
            <p><?php echo $itemUser->description ?></p>
        </div>
        <!-- .author-bio-content -->
        <div class="author-bio-social clr"> 
        <a href="https://twitter.com/WPExplorer" title="Twitter" class="twitter" target="_blank"><span class="fa fa-twitter"></span></a> 
        <a href="https://www.facebook.com/WPExplorerThemes" title="Facebook" class="facebook" target="_blank"><span class="fa fa-facebook"></span></a> 
        <a href="https://plus.google.com/+Wpexplorer/posts" title="Google Plus" class="google-plus" target="_blank"><span class="fa fa-google-plus"></span></a> 
        <a href="http://linkedin.com" title="LinkedIn" class="linkedin" target="_blank"><span class="fa fa-linkedin"></span></a> 
        <a href="http://pinterest.com/wpexplorer/" title="Pinterest" class="pinterest" target="_blank"><span class="fa fa-pinterest"></span></a> 
        <a href="http://instagram.com" title="Instagram" class="instagram" target="_blank"><span class="fa fa-instagram"></span></a> </div>
        <!-- .author-bio-social -->
    </div>
    <div id="comments" class="comments-area clr">
        <div class="comments-title"> Facebook Comment </div>
        <div class="fb-comments" data-href="<?php echo current_url() ?>" data-width="100%" data-numposts="5"></div>
    </div>
    <!-- .author-bio -->
    
    <!-- .post-post-pagination -->
    <div class="related-carousel-wrap clr">
        <div class="heading">Related Posts</div>
        <div class="related-carousel owl-carousel clr count-5 owl-loaded owl-drag">
            <!-- .related-carousel-slide -->
            <!-- .related-carousel-slide -->
            <!-- .related-carousel-slide -->
            <!-- .related-carousel-slide -->
            <!-- .related-carousel-slide -->
            <div class="owl-stage-outer">
                <div class="owl-stage" style="transform: translate3d(0px, 0px, 0px); transition: 0s; width: 800px;">
                    <div class="owl-item active" style="width: 140px; margin-right: 20px;">
                        <div class="related-carousel-slide">
                            <a href="http://wpexplorer-demos.com/spartan/first-female-president/" title="First Female President Elected in the U.S.A"> <img src="http://wpexplorer-demos.com/spartan/wp-content/uploads/sites/91/2014/09/shutterstock_115867417-620x350.jpg" alt="First Female President Elected in the U.S.A" width="620" height="350"> First Female President Elected in the U.S.A </a>
                        </div>
                    </div>
                    <div class="owl-item active" style="width: 140px; margin-right: 20px;">
                        <div class="related-carousel-slide">
                            <a href="http://wpexplorer-demos.com/spartan/high-speed-train/" title="New High-Speed Train In Los Angeles"> <img src="http://wpexplorer-demos.com/spartan/wp-content/uploads/sites/91/2014/09/shutterstock_147803525-620x350.jpg" alt="New High-Speed Train In Los Angeles" width="620" height="350"> New High-Speed Train In Los Angeles </a>
                        </div>
                    </div>
                    <div class="owl-item active" style="width: 140px; margin-right: 20px;">
                        <div class="related-carousel-slide">
                            <a href="http://wpexplorer-demos.com/spartan/child-proverty/" title="Non-Profit Organization Helps Stop Child Poverty"> <img src="http://wpexplorer-demos.com/spartan/wp-content/uploads/sites/91/2014/09/shutterstock_128319758-620x350.jpg" alt="Non-Profit Organization Helps Stop Child Poverty" width="620" height="350"> Non-Profit Organization Helps Stop Child Poverty </a>
                        </div>
                    </div>
                    <div class="owl-item active" style="width: 140px; margin-right: 20px;">
                        <div class="related-carousel-slide">
                            <a href="http://wpexplorer-demos.com/spartan/war-statistics/" title="New War Statistics Shared To The Public"> <img src="http://wpexplorer-demos.com/spartan/wp-content/uploads/sites/91/2014/09/shutterstock_136240700-620x350.jpg" alt="New War Statistics Shared To The Public" width="620" height="350"> New War Statistics Shared To The Public </a>
                        </div>
                    </div>
                    <div class="owl-item" style="width: 140px; margin-right: 20px;">
                        <div class="related-carousel-slide">
                            <a href="http://wpexplorer-demos.com/spartan/air-travel-delayed-due-to-snow-storm/" title="Air Travel Delayed Due To Snow Storm"> <img src="http://wpexplorer-demos.com/spartan/wp-content/uploads/sites/91/2014/09/shutterstock_161363804-620x350.jpg" alt="Air Travel Delayed Due To Snow Storm" width="620" height="350"> Air Travel Delayed Due To Snow Storm </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="owl-nav">
                <div class="owl-prev disabled"><span class="fa fa-caret-left"><span></span></span>
                </div>
                <div class="owl-next"><span class="fa fa-caret-right"></span>
                </div>
            </div>
            <div class="owl-dots disabled"></div>
        </div>
        <!-- .related-carousel -->
    </div>
   
    <!-- #comments -->
</article>