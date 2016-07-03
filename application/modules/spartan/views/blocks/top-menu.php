<script>
    var myVar = setInterval(function(){ myTimer() }, 1000);

    function myTimer() {
        var d = new Date();
        var t = d.toLocaleTimeString();
        document.getElementById("demo").innerHTML = t;
    }
</script>

 <div id="topbar" class="clr">
                <div class="container clr">
                    <div id="topbar-date" class="clr">
                        <div class="topbar-date-full"><span class="fa fa-clock-o"></span><?php echo ' '.gmdate('l, d M Y ')?></div>
                        <div class="topbar-date-condensed"><span class="fa fa-clock-o"></span><?php echo ' '.gmdate(' d M Y ')?></div>
                    </div>
                    <!-- .topbar-date -->
                    <div id="topbar-nav" class="cr">
                        <div class="menu-menu-container">
                            
                            <ul id="menu-menu" class="top-nav sf-menu">
                                 <?php 
                                        $options = array('task'=>'top-menu');
                                        $listMenu = $this->spanta_model->listCategory($options);
                                      // echo '<pre>'; print_r($listMenu);
                                        foreach ($listMenu as $item) {
                                        $query = $this->db->where('parent',$item->id)->get('cungtot_category'); 
                                        $result = $query->result();
                                         
                                 ?>
                              <!--   <li id="menu-item-430" class="menu-item menu-item-type-post_type menu-item-object-page current-menu-item page_item page-item-381 current_page_item menu-item-430"><a href="http://wpexplorer-demos.com/spartan/">Home</a>
                              </li> -->
                                <li id="menu-item-322" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-has-children dropdown menu-item-322">
                                <?php 
                                    if(count($result) >0){
                                        echo ' <a href="#">';
                                    }else{
                                        echo ' <a href="abc">';
                                    }
                                 ?>
                               
                                <?php echo $item->name ?> 
                                <i class="fa fa-caret-down nav-arrow"></i></a>
                                <?php  
                                    if(count($result) >0){

                                ?>
                                     <ul class="sub-menu">
                                        <?php 
                                            foreach ($result as $item) {
                                         ?>
                                        <li id="menu-item-359" class="menu-item menu-item-type-post_type menu-item-object-post menu-item-359"><a href="ddd"><?php echo $item->name ?></a>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                <?php } ?>
                                </li>
                                <?php } ?>
                                <?php 
                                     if(($this->session->userdata('data') != 'success')){
                                 ?>
                                <li>
                                    <a href="<?php echo base_url('login') ?>" class="nav-loginout-link"> <span class="fa fa-lock"></span> Login</a>
                                </li>
                                <?php }else{
                                 ?>
                                 <li>
                                    <a href="<?php echo base_url('cungtot-article') ?>" class="nav-loginout-link"> <span class="fa fa-tachometer"></span> Dashboard</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('logout') ?>" class="nav-loginout-link"> <span class="fa fa-unlock-alt"></span> Logout</a>
                                </li>
                                 <?php } ?>
                            </ul>
                        </div>
                    </div>
                    <!-- #topbar-nav -->
                    <div id="topbar-search" class="clr">
                        <form method="post" class="topbar-searchform" action="<?php echo base_url('search') ?>" role="search">
                            <input type="search" class="field topbar-searchform-input" name="s" value="<?php echo set_value('s'); ?>" placeholder="Type your search & hit enter" />
                            <button type="submit" name="submit" class="topbar-searchform-btn"><span class="fa fa-search"></span>
                            </button>
                        </form>
                    </div>
                    <!-- topbar-search -->
                    <span class="fa fa-search topbar-search-mobile-toggle"></span> <a href="<?php echo base_url('login') ?>" title="Login "><span class="fa fa-user topbar-mobile-login-link"></span></a> <span class="fa fa-bars topbar-nav-mobile-toggle"></span> </div>
                <!-- .container -->
            </div>