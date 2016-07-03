<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Khóa Học Lập Trình Laravel Framework 5.x Tại Khoa Phạm">
    <meta name="author" content="Vu Quoc Tuan">
    <title><?php echo $title ?></title>


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
    <script src='https://www.google.com/recaptcha/api.js'></script>

    <link rel="icon" href="<?php echo base_url('/public/icon/icon.png') ?>" />
    <link href="<?php echo base_url('/public/admin') ?>/css/myscc.css" rel="stylesheet">    
</head>

<body>

    <div id="wrapper">
        
        <!-- Navigation -->
       
    
        <!-- Page Content -->
                <div class="row">
                     <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo base_url() ?>">Admin Area - Hongyang</a>
                        </div>
                        <!-- /.navbar-header -->

                        <ul class="nav navbar-top-links navbar-right">
                            <!-- /.dropdown -->
                            <li class="dropdown">
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-user fa-fw"></i>  <i class="fa fa-caret-down"></i>
                                </a>
                                <ul class="dropdown-menu dropdown-user">
                                <?php 
                                    $info = $this->session->userdata('info');
                                    if(isset($info)){
                                        if($info->level == 1){
                                            $level = 'Founder';
                                        }elseif($info->level == 2){
                                            $level = 'Admin';

                                        }
                                    }else{
                                            $level = 'guest';
                                        }
                                 ?>
                                    <li><a href="#"><i class="fa fa-user fa-fw"></i> 
                                    <?php 
                                        if(isset($level))
                                        echo $level ;
                                        else
                                        echo 'guest';
                                    ?>
                                    </a>
                                    </li>
                                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                                    </li>
                                    <li class="divider"></li>
                                   
                                    <li><a href="<?php echo base_url('/cungtot') ?>"><i class="fa  fa-undo"></i> Back</a>
                                    
                                </ul>
                                <!-- /.dropdown-user -->
                            </li>
                            <!-- /.dropdown -->
                        </ul>
                        <!-- /.navbar-top-links -->

                       
                        <!-- /.navbar-static-side -->
                    </nav>
                </div>
        <div id="page-wrapper" >
            <div class="container-fluid">
                <div class="row">
                    <br>
                    <!-- /.col-lg-12 -->
                    <!-- noidungoday -->
                    <?php 
                        if ($this->session->flashdata('flash_level')){

                        echo '<div class="col-lg-12 alert alert-'.$this->session->flashdata('flash_level').'">';
                            echo $this->session->flashdata('flash_message');
                        echo '</div>';
                        }
                     ?>
                    <?php $this->load->view($content) ?>
                    <!-- noidungoday -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    
    <script src="<?php echo base_url('/public/admin') ?>/js/myscript.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url('/public/admin') ?>/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="<?php echo base_url('/public/admin') ?>/js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url('/public/admin') ?>/js/sb-admin-2.js"></script>

    <!-- DataTables JavaScript -->
    <script src="<?php echo base_url('/public/admin') ?>/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('/public/admin') ?>/js/dataTables.bootstrap.min.js"></script>

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
    <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
                responsive: true
        });
    });
    </script>
</body>

</html>
