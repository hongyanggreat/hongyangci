<div class="col-lg-7" style="padding-bottom:120px">
<?php echo validation_errors();?>
                      <?php echo form_open_multipart('');  ?>
                         <?php //echo '<pre>';print_r($info) ?>
                      <h3>Create an account</h3>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" name="username" placeholder="Please Enter User Name" 
                                value="<?php echo set_value('username',isset($info->username)?$info->username:'') ?>"/>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" id="password" style="display: none" disabled class="form-control" name="password" placeholder="Please Enter Password" value=""/>
                                <p><b id="showPass"   style="color: red" >click here </b><i id="changetext">Nếu muốn Thay Đổi Password</i> </p>
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
                                <label>Email</label>
                                <input type="email"  class="form-control" name="email" placeholder="Please Enter email" 
                                value="<?php echo set_value('email',isset($info->email)?$info->email:''); ?>"/>
                            </div>
                            <div class="form-group">
                               
                              <label>Level</label>
                               <select class="form-control" name="level">
                        
                                    <?php 
                                        if(($this->session->userdata('data') == 'success')){
                                          cate_parent($level,0," ",set_value('level',isset($info->level)?$info->level:''));
                                        }else{
                                            echo '<option value="3" '.set_select('level', '3').'>Member</option>';
                                            echo '<option value="4" '.set_select('level', '4').'>Guest</option>';
                                        }
                                     ?>
                                </select>
                            </div>

                            <?php 
                              //echo '<pre>';print_r($a);
                                if(($this->session->userdata('data') == 'success')){ 
                            ?>
                           <div class="form-group">
                               
                                <label>Status </label>

                                <label class="radio-inline">
                                   <input type="radio" name="status" value="0" <?php echo set_value('status', $info->status) == 0 ? "checked" : "";  ?> />InActive

                                </label>
                                <label class="radio-inline">
                                   <input type="radio" name="status" value="1" <?php echo set_value('status', $info->status) == 1 ? "checked" : "";  ?> />Active
                                </label>
                                
                            </div>
                           <?php }else{
                            ?>
                             <div class="form-group">
                                <label class="radio-inline">
                                    <input name="status" value="0"  checked="" type="radio"
                                    <?php 
                                      echo set_value('status') == 0 ? "checked" : ""; 
                                    ?>

                                    >Tài khoản của bạn phải được xác minh.
                                </label>
                                
                            </div>
                            <?php

                            } ?>
                              <input type="submit" class="btn btn-default" name="submit" value="Create an account" />
                            <button type="reset" class="btn btn-default">Reset</button>
                            <a href="<?php echo base_url('/login') ?>" class="">Đăng Nhập</a>

                        <form>
                    </div>