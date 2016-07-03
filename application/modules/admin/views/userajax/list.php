 <h3>User Data</h3>
 <button class="btn btn-success" onclick="add_person()"><i class="glyphicon glyphicon-plus"></i> Add Person</button>
        <button class="btn btn-default" onclick="reload_table()"><i class="fa fa-refresh" aria-hidden="true"></i> Reload</button>
        
 <div class="row">
       
        <br />
        <table id="table" class="table table-striped table-bordered" cellspacing="0" >
            <thead>
                <tr>
                    <th>Stt</th>
                    <th>username</th>
                    <th>email	</th>
                    <th>Level	</th>
                    <th>status  </th>
                    <th>Date	</th>
                    <th style="width:125px;">Action</th>
                </tr>
            </thead>
            
            
            <tfoot>
            <tr>
               <tr>
                    <th>Stt</th>
                    <th>username</th>
                    <th>email	</th>
                    <th>Level	</th>
                    <th>status  </th>
                    <th>Date	</th>
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
            "url": "<?php echo site_url('admin/UserAjax/ajaxlist')?>",
            "type": "POST"
        },


    });

  
    function reload_table()
        {
            table.ajax.reload(null,false); //reload datatable ajax 
        }
    function add_person()
        {
            save_method = 'add';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add Person'); // Set Title to Bootstrap modal title

            $(".col-md-9 p").css('display','none');
            $("#password").css('display','block').removeAttr('disabled');
        }
    function edit_person(id)
        {

            save_method = 'update';
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string

            $(".col-md-9 p").css('display','block');
            $("#password").css('display','none').attr('disabled','disabled');
            //Ajax Load data from ajax
            $.ajax({
                url : "<?php echo site_url('admin/UserAjax/ajax_edit/')?>/" + id,
                type: "GET",
                dataType: "JSON",
                success: function(data)
                {   
                    $('[name="id"]').val(data.id);
                    $('[name="username"]').val(data.username);
                    $('[name="email"]').val(data.email);
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
                url = "<?php echo site_url('admin/UserAjax/ajax_add')?>";
            } else {
                url = "<?php echo site_url('admin/UserAjax/ajax_update')?>";
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
        function delete_person(id)
        {
          if(confirm('Are you sure delete this data?')){
            var url = "<?php echo site_url('admin/UserAjax/ajax_delete')?>/"+id;
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
            if(confirm('Are you sure?')){
                var url = "<?php echo site_url('admin/UserAjax/ajax_filter')?>/"+id+"/"+status;
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
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id"/> 
                    <div class="form-body">
                        <div class="form-group">
                            <label class="control-label col-md-3">Username</label>
                            <div class="col-md-9">
                                <input name="username" placeholder="User name" class="form-control" type="text">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-md-3">Password</label>
                            <div class="col-md-9">
                                <input type="passwordx" id="password" style="display: none" disabled class="form-control" name="password" placeholder="Please Enter Password" value=""/>
                                <p><b id="showPass"   style="color: red" >click here </b><i id="changetext">Nếu muốn Thay Đổi Password</i> </p>
                                <span class="help-block"></span>
                            </div>
                        </div>

<script>


          $("#showPass").click(function(){
            $(this).toggleClass('showPass');
             if($(this).hasClass("showPass")){
                if (confirm('Bạn Có chắc chắn thay đổi mật khẩu Không?')) {
                    //$(this).parent().hide();
                    $('#password').show().removeAttr( "disabled" );
                    $("#changetext").html('Nếu Không Muốn Thay Đổi Password');
                } else {
                    alert('Hủy Lệnh');
                }
             }else{
                if (confirm('Are you sure ?')) {
                    $("#changetext").html('Nếu  Muốn Thay Đổi Password');
                    $('#password').hide().addAttr( "disabled" );
                } else {
                    alert('Bạn Đã Hủy Lệnh');
                }
             }
          });
        </script>

                         <div class="form-group">
                            <label class="control-label col-md-3">Email</label>
                            <div class="col-md-9">
                                <input name="email" placeholder="Email" class="form-control" type="email">
                                <span class="help-block"></span>
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="control-label col-md-3">Level</label>
                           <div class="col-md-9">
                               <select name="level" class="form-control">
                                   <option value="">--Select Level--</option>
                                   <option value="1">Founder</option>
                                   <option value="2">Admin</option>
                                   <option value="3">Member</option>
                               </select>
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