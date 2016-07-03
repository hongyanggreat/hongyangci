<div id="site-navigation-wrap" class="clr">
                <div id="site-navigation-inner" class="clr container">
                    <nav id="site-navigation" class="navigation main-navigation clr" role="navigation">
                        <div class="menu-categories-container">
                            <ul id="menu-categories" class="main-nav dropdown-menu sf-menu">
                                <?php 
                                    $options = array('task'=>'main-menu');
                                    $listMenu = $this->spanta_model->listCategory($options);
                                   //echo '<pre>'; print_r($listMenu);
                                    $i= 1;
                                    foreach ($listMenu as $item) {
                                      
                                 ?>
                                <li id="menu-item-<?php echo $item->id ?>" class="menu-item menu-item-type-taxonomy menu-item-object-category  cat-<?php echo $i++ ?>"><a href="<?php echo base_url('spartan/'.$this->category.'/'.$item->alias) ?>"><?php echo $item->name ?></a>
                                </li>
                               <?php  }?>
                            </ul>
                        </div> <a href="#mobile-nav" class="navigation-toggle"><span class="fa fa-bars navigation-toggle-icon"></span><span class="navigation-toggle-text">Browse Categories</span></a> </nav>
                    <!-- #site-navigation -->
                </div>
                <!-- #site-navigation-inner -->
            </div>