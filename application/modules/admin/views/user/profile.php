<div class="col-lg-7" style="padding-bottom:120px">
<?php echo form_open_multipart(''); ?>
        <div class="form-group">
            <label>User Name</label>
            <input type="hidden" name="id" value="<?php echo isset($info->id)?$info->id:'' ?>">
            <input type="text" class="form-control" name="username" placeholder="Please Enter User Name" 
            value="<?php echo set_value('username',isset($info->username)?$info->username:'') ?>"/>
            <span class="error"> <?php echo form_error('username'); ?></span>
        </div>
        <div class="form-group">
        <style>
            .changePass{
                color: #001A89
            }
            .changePass:hover {
                text-decoration: none;
                cursor: pointer;
                font-weight: bold;
                text-shadow:5px 5px 10px #E0E0E0;
            }
        </style>
            <label>Password </label>  <span>[******]  <a  class="changePass"><i class="fa fa-pencil" aria-hidden="true"></i> Change Password</a> </span>
          
        </div>

        <div class="form-group">
            <label>Current Image</label>
            <br>
            <input type="hidden" name="imgCurrent" value="<?php echo isset($info->image)?$info->image:'' ?>">
            <img src="<?php echo base_url('public/upload/admin/user/'.$info->username.'/thumb/'.$info->image) ?>" alt="">
        </div>
        <div class="form-group">
            <label>Hình Ảnh</label> (hiển thị đẹp nhất với chiều cao và chiều rộng bằng nhau)
            <input type="file" name="fImages">
            <span class="warning"> 
            <?php 
                echo isset($message)?$message:'' ?>
            </span>
        </div>

        <div class="form-group">
            <label>Email</label>
            <input type="email"  class="form-control" name="email" placeholder="Please Enter email" 
            value="<?php echo set_value('email',isset($info->email)?$info->email:''); ?>"/>
            <span class="error"> <?php echo form_error('email'); ?></span>
        </div>

        <div class="form-group">
            <label>Phone</label>
            <input type="text"  class="form-control" name="phone" placeholder="Please Enter phone" 
            value="<?php echo set_value('phone',isset($info->phone)?$info->phone:''); ?>"/>
           
            <span class="error"> <?php echo form_error('phone'); ?></span>
        </div>
         <div class="form-group">
            <label>Description</label>
            <textarea id="description" class="form-control" name="description" rows="5" placeholder="Viết Bài"><?php echo set_value('description',isset($info->description)?$info->description:''); ?></textarea>
        </div>

            <span class="error"> <?php echo form_error('description'); ?></span>
        
          <input type="submit" class="btn btn-default" name="submit" value="Update profile" />
        <button type="reset" class="btn btn-default">Reset</button>
    <form>
</div>



<!-- Modal -->
<div class="modal fade" id="modal_form" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Password</h4>
      </div>
      <div class="modal-body">
      <form action="#" id="formChangePass" class="form-horizontal">
       <input type="hidden"  class="form-control" id="id" name="id" placeholder="" value="<?php echo isset($info->id)?$info->id:'' ?>">
            <div class="form-group">
                <label>Old Password (*)</label>
                <input type="password"  class="form-control" id="oldPass" name="old-pass" placeholder="Please Enter Old Password" 
                value=""/>
                <span class="error"> <?php echo form_error('old-pass'); ?></span>
            </div>
            <div class="form-group">
                <label>New Password (*)</label>
                <input type="password" id="newPass"  class="form-control" name="new-pass" placeholder="Please Enter New Password" 
                value=""/>
                <span class="error"> <?php echo form_error('new-pass'); ?></span>
            </div>
            <div class="form-group">
                <label>Re-Password (*)</label>
                <input type="password" id="rePass"  class="form-control" name="re-pass" placeholder="Please Enter Re-Password" 
                value=""/>
                <span class="error"> <?php echo form_error('re-pass'); ?></span>
            </div>
            </form>
      </div>
      <div class="modal-footer">
        <button type="button" id="btnSave" name="submit" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div>
    </div>

  </div>
</div>

<div class="modal fade" id="success" role="dialog">
  <div class="modal-dialog ">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Bạn đã update thành công Password !</h4>
      </div>
    </div>

  </div>
</div>
<script>
$(document).ready(function(){
    $('.changePass').on('click',function(){
        $('#modal_form').modal('show');

    });


});
function save(){
        $('#btnSave').text('saving...'); 
        $('#btnSave').attr('disabled',true);
        var url = "<?php echo site_url('admin/user/changePass')?>";
        var id = $('#id').val();
        var oldPass = $('#oldPass').val();
        var newPass = $('#newPass').val();
        var rePass = $('#rePass').val();
        $.ajax({
                url : url,
                type: "POST",
                data: {'oldPass':oldPass,'newPass':newPass,'rePass':rePass,'id':id},
                dataType: "json",
                success: function(data){
                    //alert(data.status);
                    
                    if(data.status) //if success close modal and reload ajax table
                    {
                       $('#modal_form').modal('hide');
                       $("input[type=password]").val("");
                       //alert('Bạn đã update thành công Password');
                       $('#success').modal('show');
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
</script>