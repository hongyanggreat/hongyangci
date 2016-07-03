 <div class="featured-carousel-wrap clr">
                            <h2 class="heading">Featured</h2>
                            <div class="featured-carousel owl-carousel clr count-8">
                            <?php 
                                $options = array('task'=>'featured','limit'=>10);
                                $linkArticleFeatured = $this->spanta_model->listArticle($options);
                                 //echo '<pre>'; print_r($linkArticleFeatured);
                                foreach ($linkArticleFeatured as $item) {
                             ?>
                                <div class="featured-carousel-slide">
                                    <a href="<?php echo base_url('/').$item->alias ?>" title="<?php echo $item->title ?>"> <img src="<?php echo base_url('public/upload/cungtot/'. $item->image) ?>" alt="<?php echo  $item->image ?>" /> <?php echo mb_substr($item->title,0,35) ?> &hellip;</a>
                                </div>
                                <!-- .featured-carousel-->
                            <?php } ?>
                            </div>
                            <!-- .featured-carousel -->
                        </div>