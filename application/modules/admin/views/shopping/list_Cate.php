 <form action="#" id="form" class="form-horizontal" method="get">
     
 <h3>User Data</h3>
 <button class="btn btn-success" onclick="add_cate()"><i class="glyphicon glyphicon-plus"></i> Add Cate Product</button>
 <select class="btn btn-default filter" name="choise">
   <option value="">Please Choose Filter</option>
   <option value="0">Active</option>
   <option value="1">InActive</option>
</select>

 <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh" aria-hidden="true"></i> Reload</button>
        
 <div class="row">
       
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" >
            <thead>
                <tr>
                    <th style="width: 100px;">Check All <input type="checkbox" class="check btn" id="checkAll"></th>
                    <th>Stt</th>
                    <th>name</th>
                    <th>Status</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            
            
            <tfoot>
            <tr>
               <tr>
                     <th>Check</th>
                    <th>Stt</th>
                    <th>name</th>
                    <th>Status</th>
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
            "url": "<?php echo site_url('admin/shopping/CategoryProduct/ajaxlist')?>",
            "type": "POST"
        },


    });

  
    function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax 
        }
    function add_cate()
        {

            save_method = 'add';
            $('.removeForm').remove();
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title

        }
    function edit_cate(id)
        {

            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('admin/shopping/CategoryProduct/ajax_edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {   
                    $('[name="id"]').val(data.id);
                    $('[name="name"]').val(data.name);
                    $("[name='status'").filter("[value="+data.status+"]").prop('checked', true);
                    $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                    $('.modal-title').text('Edit Person'); // Set title to Bootstrap modal title

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
                url = "<?php echo site_url('admin/shopping/CategoryProduct/ajax_add')?>";
            } else {
                url = "<?php echo site_url('admin/shopping/CategoryProduct/ajax_update')?>";
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
        function delete_cate(id)
        {
          if(confirm('Are you sure delete this data?')){
            var url = "<?php echo site_url('admin/shopping/CategoryProduct/ajax_delete')?>/"+id;
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
            var url = "<?php echo site_url('admin/shopping/CategoryProduct/ajax_filter')?>/"+id+"/"+status;
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
                var url = "<?php echo site_url('admin/shopping/CategoryProduct/ajaxStatus')?>/"+status;
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
                            <label class="control-label col-md-3">Category Product</label>
                            <div class="col-md-9">
                                <input name="name" id="name" placeholder="Please Enter Category Product" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        
                        <div class="form-group">
                           <label class="control-label col-md-3">Status</label>
                           <div class="col-md-9">
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