$(document).ready(function(){
    var base_url = "http://hongyang.com/tintuc/";

  $('.bginfo').on('click','.viewdetail',function(e){
    e.preventDefault();
     var id = $(this).data('id');
        $.ajax({
            url: base_url+ "shopping/index/quickview",
            method:'POST',
            data:{'id':id},
            dataType:'html',
            
            success:function(data){
                //alert(data);
                $('.contentfast').html(data).fadeIn(700);
            }
        });
       
  });

  $('.contentfast').on('click','.closefast',function(e){
      e.preventDefault();
     $('.contentfast').fadeOut(700);
   }); 
});
