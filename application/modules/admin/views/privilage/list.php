 <h3>Privilage Data</h3>
 <button class="btn btn-success" onclick="add_router()"><i class="glyphicon glyphicon-plus"></i> Add router</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh" aria-hidden="true"></i> Reload</button>
        
 <div class="row">
       
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" >
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>name</th>
                    <th>router	</th>
                    <th>Level	</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            
            
            <tfoot>
            <tr>
               <tr>
                    <th>stt</th>
                    <th>name</th>
                    <th>router	</th>
                    <th>Level	</th>
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
            "url": "<?php echo site_url('admin/PrivilageAjax/ajaxlist')?>",
            "type": "POST"
        },


    });

  
    function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax 
        }
    function add_router()
        {
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add Router'); // Set Title to Bootstrap modal title


            $(".col-md-9 p").css('display','none');
            $("#password").css('display','block').removeAttr('disabled');
        }
    function edit_router(id)
        {
            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('.id').removeAttr('disabled');
            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('admin/PrivilageAjax/ajax_edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {   
                    $('[name="id"]').val(data.id);
                    $('[name="name"]').val(data.name);
                    $('[name="router"]').val(data.router);
                    $('[name="level"]').val(data.level);
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
                url = "<?php echo site_url('admin/PrivilageAjax/ajax_add')?>";
            } else {
                url = "<?php echo site_url('admin/PrivilageAjax/ajax_update')?>";
            }
           

            // ajax adding data to database
            $.ajax({
                url : url,
                type: "POST",
                data: $('#form').serialize(),
                dataType: "JSON",
                success: function(data)
                {

                    if(data.status) //if success close modal and reload ajax table
                    {

                        $('#modal_form').modal('hide');
                        reload_table();
                    }else{
                    	//alert(data.messages);
                    	$.each(data.messages,function(key,value){
                    			var element = $('#'+key);
                    			element.closest('div.form-group')
                    			.removeClass('has-error')
                    			.addClass(value.length > 0?'has-error':'has-success')
                    			.find('.text-danger').remove();
                    			element.after(value);
                    			}
                    		);
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
        function delete_router(id)
        {
          if(confirm('Are you sure delete this data?')){
            var url = "<?php echo site_url('admin/PrivilageAjax/ajax_delete')?>/"+id;
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
            if(confirm('Are you sure delete this data?')){
                var url = "<?php echo site_url('admin/userajax/ajax_filter')?>/"+id+"/"+status;
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
          
            }else{
                alert('Bạn Đã hủy Lệnh');
            }
        }

        


</script>

 <!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Router Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" class="id" value="" name="id" disabled /> 
                    
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Name</label>
                            <div class="col-md-9">
                                <input id="name" name="name" placeholder="Name Router" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        

                         <div class="form-group">
                            <label class="control-label col-md-3">router</label>
                            <div class="col-md-9">
                                <input name="router" id="router" placeholder="Đường dẫn Router" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div> 
                        <div class="form-group">
                            <label class="control-label col-md-3">level</label>
                            <div class="col-md-9">
	                             <select name="level" id="level" class="form-control">
	                                   <option value="">--Select Level--</option>
	                                   <option value="1">Founder</option>
	                                   <option value="2">Admin</option>
	                                   <option value="3">Member</option>
	                               </select>
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