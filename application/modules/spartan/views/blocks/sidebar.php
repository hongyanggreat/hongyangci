
<aside id="secondary" class="sidebar-container" role="complementary">
                        <div class="sidebar-inner">
                            <div class="widget-area">
                                <style>
                                    .aboutme{
                                        border-top: 5px solid #676767;
                                        height: 280px;
                                        width: 100%;
                                        background: url(http://s33.postimg.org/j7uqy270f/shattered_dark.png);
                                    }
                                    .circular{
                                        width: 150px;
                                        height: 150px;
                                       -webkit-border-radius: 75px;
                                    }
                                    .circular img {
                                        width: 100%;
                                    }
                                    center{
                                        margin-top: 20px;
                                    }
                                    .name{
                                        font-size: 18px;
                                        font-weight: bold;
                                        text-align: center;
                                        display: block;
                                    }
                                    .visits{
                                        width: 100%;
                                        background: #7d7d7d;
                                        text-align: center;
                                        padding: 10px;
                                        color: #fff;
                                    }
                                </style>
                                <div class="sidebar-widget visits  clr">
                                    <?php 
        
                                       $visits = $this->visit->countVisit();
                                       echo 'Hiện tại có '.$visits.' thành viên online.';
                                     ?>
                                </div>
                                <div class="sidebar-widget aboutme  clr">
                                    
                                   <center >
                                        <a target="_blank" href="#"><img class="circular" src="https://lh6.googleusercontent.com/-gHWfyoq0VyU/V19z6K2oLPI/AAAAAAAAARw/sdryO5yeB6kotXHaLLjlariSbx1KLehGgCL0B/s553-no/Untitled-1.jpg"></a>
                                    </center>
                                   <span class="name">My Family</span>
                                  
                                </div>
                                
                                <div class="sidebar-widget widget_search clr">
                                    <form method="post" id="searchform" class="site-searchform" action="<?php echo base_url('search') ?>" role="search">
                                        <input type="search" class="field" name="s" value="<?php echo set_value('s'); ?>" id="s" placeholder="Search..." />
                                        <button type="submit" name="submit"><span class="fa fa-search"></span>
                                        </button>
                                    </form>
                                </div>
                               
                                <div class="sidebar-widget widget_wpex_tabs_widget clr">
                                    <div class="wpex-tabs-widget clr">
                                        <div class="wpex-tabs-widget-inner clr">
                                            <div class="wpex-tabs-widget-tabs clr">
                                                <ul>
                                                    <li><a href="#" data-tab="#wpex-widget-popular-tab" class="active">Popular</a>
                                                    </li>
                                                    <li><a href="#" data-tab="#wpex-widget-recent-tab">Recent</a>
                                                    </li>
                                                    <li><a href="#" data-tab="#wpex-widget-comments-tab" class="last">Ngẫu Nhiên</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- .wpex-tabs-widget-tabs -->
                                            <div id="wpex-widget-popular-tab" class="wpex-tabs-widget-tab active-tab clr">
                                                <ul class="clr">
                                                 <?php 
                                                    $options = array('task'=>'popular','limit'=>5);
                                                    $linkArticlePopular= $this->spanta_model->listArticle($options);
                                                     //echo '<pre>'; print_r($linkArticleFeatured);
                                                    $i=1;
                                                    foreach ($linkArticlePopular as $item) {
                                                 ?>
                                                    <li class="clr">
                                                        <a href="<?php echo base_url('/').$item->alias ?>" title="<?php echo $item->title ?>" class="clr"> <span class="counter"><?php echo $i++ ?></span> <span class="title strong"><?php echo $item->title ?>:</span><?php echo substr($item->intro,0,80) ?> &hellip;</a>
                                                    </li>
                                                   <?php  } ?>
                                                </ul>
                                            </div>
                                            <!-- wpex-tabs-widget-tab -->



                                            <div id="wpex-widget-recent-tab" class="wpex-tabs-widget-tab  clr">
                                                <ul class="clr">
                                                <?php 
                                                    $options = array('task'=>'recent','limit'=>5);
                                                    $linkArticleRecent= $this->spanta_model->listArticle($options);
                                                     //echo '<pre>'; print_r($linkArticleFeatured);
                                                    foreach ($linkArticleRecent as $item) {
                                                 ?>
                                                    <li class="clr">
                                                        <a href="<?php echo base_url('/').$item->alias ?>" title="<?php echo $item->title ?>" class="clr"> <img src="<?php echo base_url('public/upload/cungtot/'. $item->image) ?>" alt="<?php echo $item->image ?>" width="100" height="100" /> <span class="title strong"><?php echo $item->title ?>:</span> <?php echo substr($item->intro,0,80) ?>.&hellip; </a>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>
                                            <!-- wpex-tabs-widget-tab -->
                                            <div id="wpex-widget-comments-tab" class="wpex-tabs-widget-tab clr">
                                                <ul class="clr">
                                                 <?php 
                                                    $options = array('task'=>'random','limit'=>5);
                                                    $linkArticleRecent= $this->spanta_model->listArticle($options);
                                                     //echo '<pre>'; print_r($linkArticleFeatured);
                                                    foreach ($linkArticleRecent as $item) {
                                                 ?>
                                                    <li class="clr">
                                                        <a href="<?php echo base_url('/').$item->alias ?>" title="Read Comment" class="clr"> <img src="<?php echo base_url('public/upload/cungtot/'. $item->image) ?>" class="avatar avatar-100 photo" alt="<?php echo $item->image ?>" height="100" width="100" /> <span class="title strong"><?php echo $item->title ?>:</span> <?php echo substr($item->intro,0,80) ?>&hellip;&hellip; </a>
                                                    </li>
                                                   <?php } ?>
                                                </ul>
                                            </div>
                                            <!-- .wpex-tabs-widget-tab -->
                                        </div>
                                        <!-- .wpex-tabs-widget-inner -->
                                    </div>
                                    <!-- .wpex-tabs-widget -->
                                </div>
                                <div class="sidebar-widget widget_tag_cloud clr"><span class="widget-title">Tags</span>
                                    <div class="tagcloud">
                                    <?php 
                                        $tags = $this->spanta_model->listCategory();
                                        foreach ($tags as $item) {
                                     ?>
                                    <a href="<?php echo base_url('spartan/'.$this->category.'/'.$item->alias) ?>" class='tag-link-46 tag-link-position-1' title='' style='font-size: 17.5454545455pt;'><?php echo ucwords(strtolower($item->name))  ?></a> 
                                    <?php } ?>
                                    </div>
                                </div>
                                <div class="sidebar-widget widget_wpex_slider_widget clr"><span class="widget-title">Slider Widget</span>
                                    <div class="slider-widget owl-carousel clr">
                                    <?php 
                                        $options = array('task'=>'random','limit'=>10);
                                        $widgetSlide = $this->spanta_model->listArticle($options);
                                        if(count($widgetSlide)>0){ 
                                        foreach ($widgetSlide as $item) {
                                        $options = array('task'=>'infoCategory','catagory'=>$item->catagory);
                                        $infoCategory = $this->spanta_model->infoCategory($options);  

                                     ?>
                                        <div class="slider-widget-slide clr">
                                            <a href="<?php echo base_url('/').$item->alias ?>" title="$item->title" class="widget-recent-posts-thumbnail clr"> <img src="<?php echo base_url('public/upload/cungtot/'. $item->image) ?>" alt="<?php echo $item->image ?>"  />
                                                <div class="slider-widget-title"><?php echo $item->title ?></div>
                                            </a>
                                            <div class="entry-cat-tag cat-24-bg"> <a href="<?php echo base_url('spartan/'.$this->category.'/'.$infoCategory->alias) ?>" title="Landscape"><?php echo $infoCategory->name ?></a> </div>
                                            <!-- .entry-cat-tag -->
                                        </div>
                                        <!-- .widget-slider-slide -->
                                       <?php } ?>
                                       <?php }else{
                                            echo 'Chưa Có bài Viết.Vui Lòng Đăng Nhập Để Viết Bài.';
                                        } ?>
                                    </div>
                                    <!-- .widget-slider -->
                                </div>
                                    <?php 
                                        $options = array('task'=>'latestIn');
                                        $rowCategory = $this->spanta_model->infoCategory($options);
                                        if(count($rowCategory)>0){

                                    ?>
                                <div class="sidebar-widget widget_wpex_recent_posts_thumb_widget clr"><span class="widget-title">Latest In <?php echo $rowCategory->name ?></span>
                                    <ul class="widget-recent-posts clr">
                                        <?php 
                                            $options = array('task'=>'lastIn','limit'=>3,'category'=>$rowCategory->id);
                                            $aticleLastIn = $this->spanta_model->listArticle($options);

                                            if(count($aticleLastIn) >0){
                                            foreach ($aticleLastIn as $item) {
                                         ?>
                                            <li class="clr widget-recent-posts-li left-thumbnail format-">
                                                <a href="<?php echo base_url('/').$item->alias ?>" title="" class="widget-recent-posts-thumbnail clr"> <img src="<?php echo base_url('public/upload/cungtot/'. $item->image) ?>" alt="" width="620" height="350" /> </a>
                                                <div class="widget-recent-posts-content clr"> <a href="<?php echo base_url('/').$item->alias ?>" title="" class="widget-recent-posts-title"><?php echo $item->title ?></a>
                                                    <div class="widget-recent-posts-date">September 22, 2014</div>
                                                </div>
                                                <!-- .widget-recent-posts-content -->
                                            </li>
                                           <?php }?>
                                           <?php }else{
                                            echo 'Chưa Có bài Viết.Vui Lòng Đăng Nhập Để Viết Bài.';
                                            } ?>
                                    </ul>
                                </div>
                                <?php } ?>
                                <div class="sidebar-widget  widget-map">
                                        <button id="map">Xem Bản đồ</button>
                                       
                                      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1861.9128600120382!2d105.76405907939619!3d21.039658273132016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x313454c0c93ed581%3A0xf9cf61eb410fc93e!2zTmfDtSAxOTkgSOG7kyBUw7luZyBN4bqtdSwgQ-G6p3UgRGnhu4VuLCBU4burIExpw6ptLCBIw6AgTuG7mWksIFZpZXRuYW0!5e0!3m2!1sen!2s!4v1465810663418" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </aside>
                  