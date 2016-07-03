$(document).ready(function(){
 $('#close').click(function(){
 	$('.ad-spot2').show();
 	$('#see-more-category').parent().hide();
 });
 $('#closes').click(function(){
 	$('#see-more-category').parent().hide();
 });
});

/*$(window).scroll(function() {
   if($(window).scrollTop() + $(window).height() == $(document).height()) {
        alert('bottom');
   }
});*/


$(document).ready(function(){
    $(document).on('click','#see-more',function(e){
        $.ajax({
            url:'success',
            method:'POST',
            dataType:'html',
             beforeSend:function(){

                $('#show').append('<span class="load">Loading...</span>');
            },
            complete:function(){
                $(".load").remove();
            },
            success:function(data){
                $('#show').html(data);
            }

        });
    });
});
$(document).ready(function(){
    $(document).on('click','#see-more-category',function(e){
        var id = $('#see-more-category').data('id');
        var idOne = $('#see-more-category').data('id-one');
        var category = $('#see-more-category').data('category');
        var limit = $('#see-more-category').data('limit');
        
        $.ajax({
            url:'../procesAjaxCategory',
            method:'POST',
            data:{'id':id,'category':category,'idOne':idOne,'limit':limit},
            dataType:'html',
             beforeSend:function(){

               $('#see-more-category').html('<span class="load">Loading...</span>');
            },
            complete:function(){
                $(".load").remove();
            },
            success:function(data){
                if(data != ''){

                    $('.row-remove').remove();
                    $('#blog-wrap').append(data);
                }
                //console.log(data);
            }
        });
    });
});
 $('#map').click(function(){
    $('.widget-map iframe').show();   
});
  $("body").mouseup(function(e){
    var map = $("#map"); 
    if(e.target.id != map.attr('id') && !map.has(e.target).length)
    {
        $('.widget-map iframe').slideUp();
    }
    
});

$(document).ready(function() {

    setInterval(function() {
        var randomnumber = Math.floor(Math.random() * 100);
        $('#test').html(randomnumber);
    }, 1000);
});
$(document).ready(function() {
    var i = 5;
        setInterval(function() {
            if(i > 0){

              i--;
            }

            var randomnumber = i;
            $('#test2').html('Giam so giay dem nguoc tu '+randomnumber+' giay');
            if(i == 0){
                //alert('thanh cong');
               // $('#test2').html('Close');
            }
        }, 1000);
    
});

