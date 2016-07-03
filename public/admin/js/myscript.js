$(function() {

  $('div.alert').delay(3000).slideUp(1000);
});


    
/*===================================================*/
    $(document).ready(function(){

        $('#provincial').change(function() {
            var id = $("#provincial").val();
           // alert(id);
            $.ajax(
            {
                url:'district',
                data:{province_id:id},
                type:'POST',
                datatype:'json',
                success:function(data){
                    //alert(data);
                    var option = "";
                    var DataObj = $.parseJSON(data);
                    $.each(DataObj,function(key, value){
                        option += "<option value='"+value['districtid']+"' sele cted='selected'>"+value['name']+"</option>"
                    })
                    $("#district").html(option);
                }
            });
        });
//set_select("provincial",$items->provinceid, ( !empty($data) && $data == $items->provinceid ? TRUE : FALSE ));
/*===================================================*/
        $('#provincial2').change(function() {
            var id = $("#provincial2").val();

            //alert(province_id);
            $.ajax(
            {
                url:'district',
                data:{province_id:id},
                type:'POST',
                datatype:'json',
                success:function(data){
                    //alert(data);
                    var option = "";
                    $.each($.parseJSON(data),function(key, value){
                        option += "<option value='"+value['districtid']+"'>"+value['name']+"</option>"
                    })
                    $("#district2").html(option);
                }
            });
        });
    });
/*===================================================*/

/*===================================================*/

  $('#district').change(function() {
            var ward_id = $(this).val();
            //alert(ward_id);
           /* $.ajax(
            {
                url:'ward',
                data:{ward_id:ward_id},
                type:'POST',
                datatype:'json',
                success:function(data){
                    //alert(data);
                    var option = "";
                    $.each($.parseJSON(data),function(key, value){
                        option += "<option value='"+value['wardid']+"'>"+value['name']+"</option>"
                    })
                    $("#ward").html(option);
                }
            });
        });*/
    });
