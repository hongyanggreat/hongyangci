 <form action="#" id="form" class="form-horizontal" method="get">
 <h3>Product Data</h3>
 <span class="btn btn-success" onclick="add_product()"><i class="glyphicon glyphicon-plus"></i> Add Class Product</span>
 <select class="btn btn-default filter" name="choise">
   <option value="">Please Choose Filter</option>
   <option value="0">Active</option>
   <option value="1">InActive</option>
</select>

 <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh" aria-hidden="true"></i> Reload</button>
 <button class="btn btn-default" id="view_active">View <i class="fa fa-check-circle" aria-hidden="true"></i> </button>
 <button class="btn btn-default" id="view_inactive">View <i class="fa fa-minus-circle" aria-hidden="true"></i></button>
 <button class="btn btn-default" id="clear_filter"> Clear</button>
 <div class="row">
       
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" >
            <thead>
                <tr>
                    <th style="width: 100px;">Check All <input type="checkbox" class="check btn" id="checkAll"></th>
                    <th>Stt</th>
                    <th>name</th>
                    <th>price</th>
                    <th>gift</th>
                    <th>class product</th>
                    <th>cate product</th>
                    <th>new</th>
                    <th>status</th>
                    <th>image</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            
            
            <tfoot>
            <tr>
               <tr>
                    <th>Check</th>
                    <th>Stt</th>
                    <th>name</th>
                    <th>price</th>
                    <th>gift</th>
                    <th>class product</th>
                    <th>cate product</th>
                    <th>new</th>
                    <th>status</th>
                    <th>image</th>
                    <th>Action</th>
                </tr>
            </tr>
            </tfoot>
        </table>
 </div>

<script>
var save_method; //for save method string
var table;
    table = $('#table').DataTable({ 

       "processing": true, //Feature control the processing indicator.
        "ajax": {
            "url": "<?php echo site_url('admin/shopping/Products/ajaxlist')?>",
            "type": "POST"
        },


    });

  
    function reload_table()
        {   
            table.ajax.reload(null,false); //reload datatable ajax 
        }
    function add_product()
        {

            save_method = 'add';
            $('.removeForm').remove();
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add  Product'); // Set Title to Bootstrap modal title
            $('.disable').attr('disabled','disabled'); // clear error class
        }
    
    function edit_product(id)
        {

            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.disable').removeAttr('disabled'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('admin/shopping/Products/ajax_edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {   
                    $('[name="id"]').val(data.id);
                    $('[name="cate_product"]').val(data.parent_cate);
                    //$('[name="class_product"]').val(data.class_product);
                    var id = data.category;
                    /*var name = "<?php // $cate_product =  $this->db->where('id',1)->get('class_products')->row();echo $cate_product->name; ?>";
                    */
                    $('[name="class_product"]').html('<option value="'+ data.category +'">'+ data.nameClassCategory +'</option>');
                    $('[name="name"]').val(data.name);
                    $('[name="price"]').val(data.price);
                    $('[name="gift"]').val(data.gift);
                    $("[name='status'").filter("[value="+ data.status +"]").prop('checked', true);
                    $("[name='news'").filter("[value="+ data.new +"]").prop('checked', true);
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit  Product'); // Set title to Bootstrap modal title

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
        }
    function save()
        {
            $('#btnSave').text('saving...'); //change button text
            $('#btnSave').attr('disabled',true); //set button disable 
            var url;

            if(save_method == 'add') {
                url = "<?php echo site_url('admin/shopping/Products/ajax_add')?>";
            } else {
                url = "<?php echo site_url('admin/shopping/Products/ajax_update')?>";
            }
           

            // ajax adding data to database
            $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "json",
                success: function(data)
                {
                    if(data.status) //if success close modal and reload ajax table
                    {
                        $('#modal_form').modal('hide');
                        reload_table();
                    }else{
                        $.each(data.messages,function(key,value){
                              var element = $('#'+key);

                                element.closest('div.form-group')
                                .removeClass('has-error')
                                .addClass(value.length > 0?'has-error':'has-success')
                                .find('.text-danger').remove();
                                element.after(value);
                        });
                    }


                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 

                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error ');
                    $('#btnSave').text('save'); //change button text
                    $('#btnSave').attr('disabled',false); //set button enable 

                }
            });
        }
        function delete_product(id)
        {
          if(confirm('Are you sure delete this data?')){
            var url = "<?php echo site_url('admin/shopping/Products/ajax_delete')?>/"+id;
            $.ajax({
                 url : url,
                type: "POST",
                dataType: "JSON",
                success: function(data)
                {
                    if(data.status) {
                        reload_table();
                        alert('Bạn Đã Xóa Thành công!');
                    }
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error ');
                }
            });
          }else{
            
            alert('Bạn Đã hủy Lệnh xóa');
          }

        }
        function filter_status(id,status){
            var url = "<?php echo site_url('admin/shopping/Products/ajax_filter')?>/"+id+"/"+status;
                 $.ajax({
                    url : url,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        if(data.status) {
                            reload_table();
                            //alert('Bạn Đã Cập Nhật Status Thành công!');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error ');
                    }
                });
        } 
        function filter_news(id,news){

            var url = "<?php echo site_url('admin/shopping/Products/ajax_filter_new')?>/"+id+"/"+news;
                 $.ajax({
                    url : url,
                    type: "POST",
                    dataType: "JSON",
                    success: function(data)
                    {
                        if(data.status) {
                            reload_table();
                            //alert('Bạn Đã Cập Nhật Status Thành công!');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error ');
                    }
                });
        }
 
        $("#checkAll").click(function () {
            $(".check").prop('checked', $(this).prop('checked'));
        });
         
        $('.filter').change(function(){

        var status = $(this).val();
           if(status != ''){
                var url = "<?php echo site_url('admin/shopping/Products/ajaxStatus')?>/"+status;
              //  alert(url);
                 $.ajax({
                    url : url,
                    type: "POST",
                    data:$( "form").serialize(),
                    dataType: "json",
                    success: function(data)
                    {
                        if(data.status){
                             reload_table();
                        }else{

                            alert('Please Choose Filter');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        alert('Error ');
                    }
                });

           }
        });
        
        $('#view_active').on('click',function(){
            $(this).removeClass('').toggleClass('btn-success');
            if ($(this).hasClass("btn-success")) {
                 $('.fa-minus-circle').css('color','#770208');
                $('.fa-check-circle').css('color','#fff');
               $('#view_inactive').removeClass('btn-danger');
              var url = "<?php echo site_url('admin/shopping/Products/ajaxSession/1')?>/";
            }else{
                $('.fa-check-circle').css('color','green');
              var url = "<?php echo site_url('admin/shopping/Products/ajaxSession/0')?>/";
            }
             $.ajax({
                    url : url,
                    type: "POST",
                    dataType: "html",
                    success: function(data)
                    {
                        //alert(data);
                        reload_table();
                    }
            });
        });
        $('.fa-check-circle').css('color','green');
        $('.fa-minus-circle').css('color','#770208');

         $('#view_inactive').on('click',function(){
                $(this).removeClass('').toggleClass('btn-danger');
                if ($(this).hasClass("btn-danger")) {
                    $('#view_active').removeClass('btn-success');
                     $('.fa-check-circle').css('color','green');
                     $('.fa-minus-circle').css('color','#fff');
                    var url = "<?php echo site_url('admin/shopping/Products/ajaxSession/2')?>/";
                }else{
                    $('.fa-minus-circle').css('color','#770208');
                  var url = "<?php echo site_url('admin/shopping/Products/ajaxSession/0')?>/";
                }
                 $.ajax({
                        url : url,
                        type: "POST",
                        dataType: "html",
                        success: function(data)
                        {
                           // alert(data);
                            reload_table();
                        }
                });
        }); 
         $('#clear_filter').on('click',function(){
            $('#view_active').removeClass('btn-success');
            $('#view_inactive').removeClass('btn-danger');
            $('.fa-check-circle').css('color','green');
            $('.fa-minus-circle').css('color','#770208');
            var url = "<?php echo site_url('admin/shopping/Products/ajaxSession/0')?>/";
            $.ajax({
                url : url,
                type: "POST",
                dataType: "html",
                success: function(data)
                {
                   // alert(data);
                    reload_table();
                }
            });
        });

         

</script>


 <!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                
                <input type="hidden" value="" name="id"/> 
                <div class="form-body">

                <div class="form-group">
                        <label class="control-label col-md-3">Cate Product</label>
                        <div class="col-md-9">
                            <select class="form-control" name="cate_product" id="cate_product">
                            <option value="">Please Choose Cate Product</option>
                                <?php 
                                    $result = $this->db->get('cate_product')->result();
                                    foreach ($result as $key => $value) {
                                       echo '<option value="'.$value->id.'">'.ucwords($value->name).'</option>';
                                    }
                                 ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
               
                <div class="form-group">
                    <label class="control-label col-md-3">Class Product</label>
                    <div class="col-md-9">
                        <select class="form-control" name="class_product" id="class_product">
                            <option value="">Please Choose Class Product</option>
                        </select>
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Product Name</label>
                    <div class="col-md-9">
                        <input name="name" id="name" placeholder="Please Enter Product Name" class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>


                <div class="form-group">
                    <label class="control-label col-md-3">Price (1000đ)</label>
                    <div class="col-md-9">
                        <input name="price" id="price" placeholder="Please Enter price Product" class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-md-3">Gift</label>
                    <div class="col-md-9">
                        <input name="gift" id="gift" placeholder="Please Enter gift" class="form-control" type="text">
                        <span class="help-block"></span>
                    </div>
                </div>
                
                <div class="form-group">
                   <label class="control-label col-md-3">Status</label>
                   <div class="col-md-9" >
                       <label class="radio-inline">
                            <input name="status" value="0" checked=""  type="radio"
                           
                            >InActive
                        </label>
                        <label class="radio-inline">
                            <input name="status"  value="1"  type="radio"
                                >Active
                        </label>
                       <span class="help-block"></span>
                   </div>
                </div>  
                <div class="form-group">
                   <label class="control-label col-md-3">New</label>
                   <div class="col-md-9">
                       
                        <label class="radio-inline">
                            <input  name="news" class="disable"  value="0"  type="radio" disabled
                                >Old
                        </label>

                        <label class="radio-inline">
                            <input  name="news" value="1" checked=""  type="radio"
                           
                            >New
                        </label>
                       <span class="help-block"></span>
                   </div>
                </div> 

                    
            </div>
        </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" name="submit" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
<script>
    $('#cate_product').change(function(){
        var value = $(this).val();
        //alert(value);
        if(value != ''){
            url = "<?php echo site_url('admin/shopping/Products/ajax_ClassProduct')?>/"+value;
            $.ajax({
                url : url,
                type: "POST",
                dataType: "json",
                success: function(data)
                {
                    if(data.status){
                        $('#class_product').html(data.output);
                    }else{
                        $('#class_product').html('<option value="">Empty :: Please Reselect Cate Product</option>');
                    }
                }
            });
        }
       
    });
    </script>
