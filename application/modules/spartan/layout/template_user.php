<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php 
            if(isset($title)){
               echo $title;
            }else{
                echo 'Tin Hay Mỗi Ngày';
            }
    ?></title>
     <link rel="icon" href="<?php echo base_url('public/icon/icon.png') ?>" />
    <meta name='robots' content='noindex,follow' />
    
    <link rel='stylesheet' id='symple_shortcode_styles-css' href='http://wpexplorer-demos.com/spartan/wp-content/plugins/symple-shortcodes/shortcodes/css/symple_shortcodes_styles.css' type='text/css' media='all' />
    <link rel='stylesheet' id='wpex-style-css' href='http://wpexplorer-demos.com/spartan/wp-content/themes/wpex-spartan/style.css' type='text/css' media='all' />
    <link rel='stylesheet' id='font-awesome-css' href='http://wpexplorer-demos.com/spartan/wp-content/plugins/symple-shortcodes/shortcodes/css/font-awesome.min.css' type='text/css' media='all' />
    <link rel='stylesheet' id='wpex-responsive-css' href='http://wpexplorer-demos.com/spartan/wp-content/themes/wpex-spartan/css/responsive.css' type='text/css' media='all' />
    <link rel='stylesheet' id='customs' href='<?php echo base_url('public/spanta') ?>/css/customs.css' type='text/css' media='all' />
    <script type='text/javascript' src='http://wpexplorer-demos.com/spartan/wp-includes/js/jquery/jquery.js'></script>
    <script type='text/javascript' src='http://wpexplorer-demos.com/spartan/wp-includes/js/jquery/jquery-migrate.min.js'></script>
    <!--[if IE 8]><link rel="stylesheet" type="text/css" href="http://wpexplorer-demos.com/spartan/wp-content/themes/wpex-spartan/css/ie8.css" media="screen"><![endif]-->
    <!--[if lt IE 9]>
            <script src="http://wpexplorer-demos.com/spartan/wp-content/themes/wpex-spartan/js/html5.js"></script>
        <![endif]-->
    <!-- Category Colors -->
    <style type="text/css">
        .cat-1:after,.layout-toggle {
            background-color: #FFA800
        }
        .cat-2:after,.layout-toggle {
            background-color: #FC1813
        }
        .cat-3:after,.layout-toggle {
            background-color: #5BFF28
        }
        .cat-4:after,.layout-toggle {
            background-color: #8236FF
        }
        .cat-5:after,.layout-toggle {
            background-color: #E1FFE5
        }
        .cat-6:after,.layout-toggle {
            background-color: #362D2B
        }
        .cat-7:after,.layout-toggle {
            background-color: #ECFF6D
        }
        .cat-8:after,.layout-toggle {
            background-color: #F8DCF3
        }
        .cat-9:after,.layout-toggle {
            background-color: #8236FF
        }
        .cat-24-bg,#site-navigation .dropdown-menu .cat-24:after, 
        body.category-24 .layout-toggle 
        {background-color:#FF0315}
        #site-navigation .current-menu-item.cat-24 > a, 
        .wpex-mobile-main-nav .cat-24 > a 
        { color:#7eb943 !important}
        .cat-25-bg,#site-navigation .dropdown-menu .cat-25:after, 
        body.category-25 .layout-toggle 
        {background-color:#7eb943}
        #site-navigation .current-menu-item.cat-25 > a, 
        .wpex-mobile-main-nav .cat-25 > a 
        { color:#7eb943 !important}
        .cat-26-bg,#site-navigation .dropdown-menu .cat-26:after, 
        body.category-26 .layout-toggle 
        {background-color:#7eb943}
        #site-navigation .current-menu-item.cat-26 > a, 
        .wpex-mobile-main-nav .cat-26 > a 
        { color:#7eb943 !important}
        .cat-28-bg,#site-navigation .dropdown-menu .cat-28:after, 
        body.category-28 .layout-toggle 
        {background-color:#249A9C}
        #site-navigation .current-menu-item.cat-28 > a, 
        .wpex-mobile-main-nav .cat-28 > a 
        { color:#7eb943 !important}
    </style>
    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<script>
  (adsbygoogle = window.adsbygoogle || []).push({
    google_ad_client: "ca-pub-7692599218245559",
    enable_page_level_ads: true
  });
</script>
</head>

<div id="fb-root"></div>
<script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.6&appId=1709508595984262";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<body class="home page page-id-381 page-template page-template-templates page-template-homepage page-template-templateshomepage-php symple-shortcodes  symple-shortcodes-responsive wpex-theme right-sidebar fixed-nav">
    <div id="wrap" class="clr">
        <div id="top-wrap" class="clr">
            <?php $this->load->view('blocks/top-menu'); ?>
           
            <!-- #topbar -->
            <header id="header" class="site-header clr container" role="banner">
                <div class="site-branding clr">
                    <div id="logo" class="clr">
                        <div class="site-text-logo clr">
                            <h1><a href="<?php echo base_url('/spartan') ?>" title="Spartan" rel="home">HongYang</a></h1> </div>
                    </div>
                    <!-- #logo -->
                    <div id="blog-description" class="clr">Tin Hot Cho Mọi Người,
                        <br /> Hãy share nếu bạn cảm thấy thích.</div>
                    <!-- #blog-description -->
                </div>
                <!-- .site-branding -->
                <div class="ad-spot header-ad clr">
                    <a href="#" title="Ad"><img src="http://wpexplorer-demos.com/spartan/wp-content/themes/wpex-spartan/images/ad-620x80.png" alt="Ad" />
                    </a>
                </div>
                <!-- .ad-spot -->
            </header>
            <!-- #header -->
            <?php $this->load->view('blocks/main-nav'); ?>
            <!-- #site-navigation-wrap -->
        </div>
        <!-- #top-wrap -->
        <div class="site-main-wrap clr">
            <div id="main" class="site-main clr container">
                <div id="primary" class="content-area clr">
                    <div id="content" class="site-content left-content boxed-content" role="main">
                       
            <?php 
                isset($slider)?($this->load->view($slider)):'Vui Lòng Liên hệ với Admin để thông báo.';
             ?>
                        <!-- #home-slider-wrap -->
                      
            <?php 
                isset($content)?($this->load->view($content)):'Vui Lòng Liên hệ với Admin để thông báo.';
             ?>
                        <!-- .home-cats -->
                       
            <?php $this->load->view('blocks/featured'); ?>
                        <!-- .featured-carousel-wrap -->
                       
            <?php $this->load->view('blocks/ads'); ?>
                        <!-- .ad-spot -->
                    </div>
                    <!-- #content -->
                    <?php $this->load->view('blocks/sidebar') ?>
                    <!-- #secondary -->
                </div>
                <!-- #primary -->
            </div>
            <!--.site-main -->
        </div>
        <!-- .site-main-wrap -->
    </div>
    <!-- #wrap -->
        <?php $this->load->view('blocks/footer') ?>
    <!-- #footer-wrap --><a href="#" class="site-scroll-top"><span class="fa fa-arrow-up"></span></a>
    <script type='text/javascript' src='http://wpexplorer-demos.com/spartan/wp-content/plugins/contact-form-7/includes/js/jquery.form.min.js'></script>
    <script type='text/javascript'>
        /* <![CDATA[ */
        var _wpcf7 = {
            "loaderUrl": "http:\/\/wpexplorer-demos.com\/spartan\/wp-content\/plugins\/contact-form-7\/images\/ajax-loader.gif",
            "recaptchaEmpty": "Please verify that you are not a robot.",
            "sending": "Sending ...",
            "cached": "1"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' src='http://wpexplorer-demos.com/spartan/wp-content/plugins/contact-form-7/includes/js/scripts.js'></script>
    <script type='text/javascript' src='http://wpexplorer-demos.com/spartan/wp-includes/js/comment-reply.min.js'></script>
    <script type='text/javascript' src='http://wpexplorer-demos.com/spartan/wp-content/themes/wpex-spartan/js/plugins.js'></script>
    <script type='text/javascript'>
        /* <![CDATA[ */
        var wpexLocalize = {
            "mobileMenuOpen": "Browse Categories",
            "mobileMenuClosed": "Close navigation",
            "homeSlideshow": "false",
            "homeSlideshowSpeed": "7000",
            "UsernamePlaceholder": "Username",
            "PasswordPlaceholder": "Password",
            "enableFitvids": "true"
        };
        /* ]]> */
    </script>
    <script type='text/javascript' src='<?php echo base_url('public/spanta') ?>/js/global.js'></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script type='text/javascript' src='<?php echo base_url('public/spanta') ?>/js/customs.js'></script>
</body>

</html>

