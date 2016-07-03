<footer id="footer-wrap" class="site-footer clr">
        <div id="footer" class="container wpex-row clr">
            <div id="footer-widgets" class="clr">
                <div class="footer-box span_1_of_4 col col-1">
                    <div class="footer-widget widget_text clr"><span class="widget-title">Spartan</span>
                        <div class="textwidget">Live the life of luxury and share it with your readers using Spartan. This clean and beautiful theme is perfect for bloggers, photographers, magazines and more. Just take a look at a few of the wonderful features included in this premium theme – we’re sure you’ll love them!</div>
                    </div>
                </div>
                <!-- .footer-box -->
                <div class="footer-box span_1_of_4 col col-2">
                    <div class="footer-widget widget_wpex_recent_news_widget clr">
                    <span class="widget-title">Latest News</span>
                        <ul class="widget-latest-news clr">
                            <?php 
                                $options = array('task'=>'latestNews');
                                $latestNews= $this->spanta_model->oneArticle($options);
                                if(count($latestNews)){
                               // print_r($latestNews);
                                $options = array('task'=>'infoCategory','catagory'=>$latestNews->catagory);
                                $infoCategory = $this->spanta_model->infoCategory($options);
                             ?>
                            <li class="first-post clr">
                                <div class="first-post-media clr">
                                    <a href="<?php echo base_url('/').$latestNews->alias ?>" title=""> <img src="<?php echo base_url('public/upload/cungtot/'. $latestNews->image) ?>" alt="<?php echo $latestNews->image ?>" width="620" height="350" />
                                    </a>
                                    <div class="entry-cat-tag cat-24-bg"> <a href="<?php echo base_url('/spartan/category/'.$infoCategory->alias) ?>" title="<?php echo $infoCategory->name ?>"><?php echo $infoCategory->name ?></a> </div>
                                    <!-- .entry-cat-tag -->
                                </div>
                                <!-- .first-post-media -->
                                <a href="<?php echo base_url('/').$latestNews->alias ?>" title="" class="widget-recent-posts-title"><?php echo $latestNews->title ?></a>
                                <p><?php echo substr($latestNews->intro, 0,120) ?>&hellip;</p>
                            </li>
                             <?php 
                                $options = array('task'=>'linkLatestNews','id'=>$latestNews->id,'limit'=>3);
                                $linkLatestNews= $this->spanta_model->listArticle($options);
                                foreach ($linkLatestNews as $item) {
                             ?>
                            <li> 
                                <a href="<?php echo base_url('/').$item->alias ?>" title="<?php echo $item->title ?>"><?php echo $item->title ?></a> 
                            </li>
                            <?php } }else{
                                echo 'Chưa Có bài Viết Nào.Vui lòng đăng nhập để viết bài';
                                }?>
                        </ul>
                    </div>
                </div>
                <!-- .footer-box -->
                <div class="footer-box span_1_of_4 col col-3">
                    <div class="footer-widget widget_wpex_recent_posts_thumb_widget clr"><span class="widget-title">Latest Video</span>
                        <ul class="widget-recent-posts clr">
                             <?php 
                                $options = array('task'=>'latestVideo','limit'=>3);
                                $latestVideo= $this->spanta_model->listArticle($options);
                                if(count($latestVideo)>0){
                                foreach ($latestVideo as $item) {
                                
                             ?>    
                            <li class="clr widget-recent-posts-li top-thumbnail format-gallery">
                                <a href="<?php echo base_url('/').$item->alias ?>" title="" class="widget-recent-posts-thumbnail clr"> <img src="<?php echo base_url('public/upload/cungtot/'. $item->image) ?>" alt="<?php echo $item->image ?>" width="650" height="250" /> </a>
                                <div class="widget-recent-posts-content clr"> <a href="<?php echo base_url('/').$item->alias ?>" title="" class="widget-recent-posts-title"><?php echo $item->title ?></a> </div>
                                <!-- .widget-recent-posts-content -->
                            </li>
                           <?php } ?>
                           <?php }else{
                            echo 'Không có bài viết nào chứa Video';
                            } ?>
                        </ul>
                    </div>
                </div>
                <!-- .footer-box -->
                <div class="footer-box span_1_of_4 col col-4">
                    <div class="footer-widget widget_wpex_social_widget clr"> <span class="widget-title">Lets Get Social</span>
                        <div class="social-widget-description clr"> Feel like getting on touch or staying upto date with out latest news and updates? </div>
                        <!-- .social-widget-description -->
                        <ul class="clr color flat">
                            <li class="twitter"><a href="<?php echo $this->tt ?>" title="Twitter" target="_blank"><span class="fa fa-twitter"></span></a>
                            </li>
                            <li class="facebook"><a href="<?php echo $this->fb ?>" title="Facebook" target="_blank"><span class="fa fa-facebook"></span></a>
                            </li>
                            <li class="google-plus"><a href="<?php echo $this->gg ?>" title="Google+" target="_blank"><span class="fa fa-google-plus"></span></a>
                            </li>
                            <li class="rss"><a href="<?php echo $this->rss ?>" title="RSS" target="_blank"><span class="fa fa-rss"></span></a>
                            </li>
                        </ul>
                    </div>
                    <div class="footer-widget widget_text clr">
                        <div class="textwidget">
                            <a href="" title="Total Theme"><img src="http://s19.postimg.org/izijrkniq/1464797979.jpg" alt="Total Theme" />
                            </a>
                        </div>
                    </div>
                </div>
                <!-- .footer-box -->
            </div>
            <!-- #footer-widgets -->
        </div>
        <!-- #footer -->
        <div id="footer-bottom" class="clr">
            <div class="container clr">
                <div id="copyright" class="clr" role="contentinfo"> Copyright 2016 hongyanggreat </div>
                <!-- #copyright -->
                <ul id="menu-footer" class="footer-nav clr">
                    <li id="menu-item-378" class="menu-item menu-item-type-custom menu-item-object-custom current-menu-item current_page_item menu-item-home menu-item-378"><a href="">Home</a>
                    </li>
                    <li id="menu-item-379" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-379"><a href="">Archives</a>
                    </li>
                    <li id="menu-item-380" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-380"><a href="">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- .container -->
        </div>
        <!-- #footer-bottom -->
    </footer>