<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="<?php echo $title ?>">
    <meta name="author" content="Vu Quoc Tuan">
    <title>
    <?php echo isset($title)?$title:'Home' ?>
    </title>
    <link rel="icon" href="<?php echo base_url('/public/icon/icon.png') ?>" />
    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url('/public/admin') ?>/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url('/public/admin') ?>/css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url('/public/admin') ?>/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">

    <!-- DataTables CSS -->
    <link href="<?php echo base_url('/public/admin') ?>/css/dataTables.bootstrap.css" rel="stylesheet">

    <!-- DataTables Responsive CSS -->
    <link href="<?php echo base_url('/public/admin') ?>/css/dataTables.responsive.css" rel="stylesheet">
    <link href="<?php echo base_url('/public/admin') ?>/css/style.css" rel="stylesheet">
    <script src="<?php echo base_url('/public/admin') ?>/js/jquery.min.js"></script>
    
      <!-- JS - ckeditor & ckeditor -->

    <script src="<?php echo base_url('/public/admin') ?>/js/ckeditor/ckeditor.js"></script>
    <script src="<?php echo base_url('/public/admin') ?>/js/ckfinder/ckfinder.js"></script>
    
    <script>
        var baseURL ="http://localhost/codeigniter";
    </script>
    <script src="<?php echo base_url('/public/admin') ?>/js/func_ckfinder.js"></script>

    <!-- jQuery -->
    
    <script src="<?php echo base_url('/public/admin') ?>/js/myscript.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('/public/admin') ?>/js/bootstrap.min.js"></script>
    
    <script src="<?php echo base_url('assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js')?>"></script>
    
    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('/public/admin') ?>/js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('/public/admin') ?>/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url('/public/admin') ?>/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('/public/admin') ?>/js/dataTables.bootstrap.min.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</head>

<body>
    <div id="wrapper">
        
        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?php echo base_url() ?>">Admin Area - Hongyang </a>
       
                <?php 
                    if($this->uri->segment(1) == 'user'){

                        echo '<a class="navbar-brand" > '.number_format($this->visit->countVisit(),'0',',','.').' Online </a>';
                    }
                ?>
            </div>
            <!-- /.navbar-header -->
            <?php 
                if(isset($this->session->userdata['info'])){
                 $info = $this->session->userdata['info'];
                // echo '<pre>';print_r($info);
                    $name = $info->username;
                    if($info->level == 1){
                        $level = 'founder';
                    }elseif($info->level == 2){
                        $level = 'Admin';

                    }else{
                        $level = 'Member';

                    }
                }
             ?>
            <ul class="nav navbar-top-links navbar-right">
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="<?php echo base_url('profile/'.$name) ?>"><i class="fa fa-user fa-fw"></i> <?php echo $name ?></a></li>
                        <li><a href="#"><i class="fa fa-crosshairs"></i> <?php echo $level ?></a></li>                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a></li>
                        <li class="divider"></li>
                        <li><a href="<?php echo base_url('/logout') ?>"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
               
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                             <script>
                                var myVar = setInterval(function(){ myTimer() }, 1000);

                                function myTimer() {
                                    var d = new Date();
                                    var t = d.toLocaleTimeString();
                                    document.getElementById("demo").innerHTML = t;
                                }
                                </script>
                            <i id="demo"> </i><?php echo ' '.gmdate('D, d M Y T')?>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="<?php echo base_url('/spartan') ?>" target="_blank"><i class="fa fa-link fa-fw"></i> View Page</a>
                            <a href="#"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-users fa-fw"></i> User<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="<?php echo base_url('/userajax') ?>">Ajax User</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('/user') ?>">List User</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('privilage-ajax') ?>">Router</a>
                                </li> 
                                <li>
                                    <a href="<?php echo base_url('ip_address') ?>">IP Address</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('hosting') ?>">My Hosting</a>
                                </li>
                                <li>
                                    <a href="<?php echo base_url('/registry') ?>">Add User</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-tags"></i> Quản lý Category  <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo base_url('cungtot-catagory') ?>">List Category</a></li>
                                <li><a href="<?php echo base_url('cungtot-catagory-add') ?>">Thêm Mới Danh Mục</a></li>
                                
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        
                        <li>
                            <a href="#"><i class="fa fa-bar-chart-o fa-fw"></i> Quản lý Article <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                
                                <li> <a href="<?php echo base_url('cungtot-article') ?>">Danh Sách Bài Viết</a> </li>
                                <li> <a href="<?php echo base_url('cungtot-article-add') ?>">Thêm Mới Bài Viết</a>  </li>
                                <li> <a href="<?php echo base_url('cungtot-article-frame') ?>">Thêm Mới Bài Viết Có Iframe</a> </li>
                                <li> <a href="<?php echo base_url('cungtot-article-all') ?>"><i class="fa fa-lock" aria-hidden="true"></i> All Article - Founder</a> </li>
                                <li> <a href="<?php echo base_url('admin/cungtot/recycle') ?>"><i class="fa fa-lock" aria-hidden="true"></i> Recycle</a></li>
                               
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-tags"></i> Quản lý Shop  <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li><a href="<?php echo base_url('CategoryProduct') ?>">Add Category Products</a></li>
                                <li><a href="<?php echo base_url('ClassProduct') ?>">Add Class Products</a></li>
                                <li><a href="<?php echo base_url('Products') ?>">Add Products</a></li>
                                <li><a href="<?php echo base_url('shopping') ?>" target='_blank'>View Shop</a></li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <!-- Page Content -->
        <div id="page-wrapper">

            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"><?php echo isset($controller)?$controller:'' ?>
                            <small><?php echo isset($action)?$action:'' ?></small>

                        </h1>


                    </div>
                    <!-- /.col-lg-12 -->
                    <!-- noidungoday -->
                    <?php 
                        if ($this->session->flashdata('flash_level')){

                        echo '<div class="col-lg-12 alert alert-'.$this->session->flashdata('flash_level').'">';
                            echo $this->session->flashdata('flash_message');
                        echo '</div>';
                        }
                     ?>
                    <?php 
                        if(isset($content)){

                            $this->load->view($content) ;
                        }else{
                            echo 'duong dan khong ton tai';
                        }
                    ?>
                    <!-- noidungoday -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->


</body>

</html>
