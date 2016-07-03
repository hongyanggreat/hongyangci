<div class="col-lg-7" style="padding-bottom:120px">
<?php echo validation_errors();?>
        <?php echo form_open_multipart('');  ?>
        <?php 
         // echo '<pre>';print_r($info);

         ?>
        <div class="form-group">
            <label>Category Name</label>
            <input class="form-control" name="name" placeholder="Please Enter Category Name" value="<?php echo set_value('name',isset($info->name)?$info->name:''); ?>"/>
        </div>

         
        <div class="form-group">
                                <label>Alias</label>
                                 <?php 
                                    isset($info->alias)?$strAlias = str_replace( '-', ' ', $info->alias ):'';
                                    ?>
                                <input type="text" id="alias" style="display: none" disabled class="form-control" name="alias" placeholder="Please Enter alias" value="<?php echo set_value('name',isset($info->name)?$info->name:''); ?>"/>
                                <p><b id="showAlias"   style="color: red" >click here </b><i id="changetext">Nếu muốn Thay Đổi alias</i> </p>
                            </div>
        <script>
          $("#showAlias").click(function(){
            $(this).toggleClass('showAlias');
             if($(this).hasClass("showAlias")){
                if (confirm('Bạn Có chắc chắn thay đổi alias Không?')) {
                    //$(this).parent().hide();
                    $('#alias').show().removeAttr( "disabled" );
                    $("#changetext").html('Nếu Không Muốn Thay Đổi alias');
                } else {
                    alert('Hủy Lệnh');
                }
             }else{
                if (confirm('Are you sure ?')) {
                    $("#changetext").html('Nếu  Muốn Thay Đổi alias');
                    $('#alias').hide().addAttr( "disabled" );
                } else {
                    alert('Bạn Đã Hủy Lệnh');
                }
             }
          });
        </script>
        <div class="form-group">
            <label>Category Parent</label>
             <select class="form-control" name="cat_menu">
               <option value="0">Please Choose Category</option>
                    <?php cate_parent($parent,0,"--",set_value('cat_menu',isset($info->parent)?$info->parent:'')) ?>

            </select>
        </div>

         <div class="form-group">
            <label>Order</label>
            <input class="form-control" name="order" placeholder="Please Enter Order" value="<?php echo set_value('order',isset($info->order)?$info->order:''); ?>"/>
        </div>

        <div class="form-group">
                                <label>Status</label>
                                <label class="radio-inline">
                                    <input name="status" value="0" checked="" type="radio"
                                    <?php 
                                      echo set_value('status',$info->status) == 0 ? "checked" : ""; 
                                    ?>
                                    >InActive
                                </label>
                                <label class="radio-inline">
                                    <input name="status" value="1" type="radio"
                                    <?php 
                                      echo set_value('status',$info->status) == 1 ? "checked" : ""; 
                                    ?>

                                    >Active
                                </label>
                                
                            </div>
        <input type="submit" class="btn btn-default" name="submit" value="Edit Category" />
        <button type="reset" class="btn btn-default">Reset</button>
        <a href="<?php echo base_url('/admin/cungtot_catagory') ?>" class="btn btn-default">Back</a>
    <form>
</div>