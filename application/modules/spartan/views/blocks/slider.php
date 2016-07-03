 <div id="home-slider-wrap" class="clr">
                            <div id="home-slider" class="owl-carousel">
                               
<?php  
        $options= array('task'=>'slider');
        $result = $this->spanta_model->listArticle($options);
       // echo '<pre>';print_r($result);

        $i =1; 
        foreach ($result as $item) {
            $options = array('task'=>'infoCategory','catagory'=>$item->catagory);
            $rowCategory = $this->spanta_model->infoCategory($options);
 ?>
                                <div class="home-slider-slide" data-dot="<?php echo $i++ ?>">
                                    <div class="entry-cat-tag cat-25-bg"> <a href="<?php echo base_url('spartan/category/'.$rowCategory->alias) ?>" title="Models"><?php echo $rowCategory->name ?></a> </div>
                                    <!-- .entry-cat-tag -->
                                    <div class="home-slider-media">
                                        <a href="" title="Model Shoot For GQ 2015"> <img src="<?php echo base_url('public/upload/cungtot/'. $item->image) ?>" alt="<?php echo $item->image ?>" /> </a>
                                    </div>
                                    <!-- .home-slider-media -->
                                    <div class="home-slider-caption clr">
                                        <h2 class="home-slider-caption-title">
                                    <a href="" title="" rel="bookmark"><?php echo substr($item->title,0,80) ?></a>
                                </h2>
                                        <div class="home-slider-caption-excerpt clr"> <?php echo $item->intro ?>&hellip; </div>
                                        <!-- .home-slider-caption-excerpt -->
                                    </div>
                                    <!--.home-slider-caption -->
                                </div>
                                <!-- .home-slider-slide-->
<?php   } ?>                             
                            </div>
                            <!-- #home-slider -->
                            <div id="home-slider-numbers"></div>
                        </div>