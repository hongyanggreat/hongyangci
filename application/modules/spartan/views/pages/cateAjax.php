<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Test</title>
	<link rel="stylesheet" href="">
	  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script type='text/javascript' src='<?php echo base_url('public/spanta') ?>/js/customs.js'></script>
</head>
<body>
	<button class="btn btn-success" id="see-more">Click here</button>
	<div id="show"></div>
</body>
</html>
<script>
      jQuery(document).ready(function(){
        jQuery(document).on('click','#see-more',function(e){
            jQuery.ajax({
                url:'CategoryAjax/success',
                method:'POST',
                dataType:'html',
                 beforeSend:function(){

                   jQuery('#show').append('<span class="load">Loading...</span>');
                },
                complete:function(){
                    jQuery(".load").remove();
                },
                success:function(data){
                    jQuery('#show').append(data);
                    //console.log(data);
                }

            });
        });
    });
    </script>
