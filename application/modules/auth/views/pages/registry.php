<style>
  .thanks{
    color: #3b5998;
    font-size: 18px;
    font-weight: bold;
    text-align: center;
  }
  .thanks span{
    font-weight: normal;
    color: #333333
  }
</style>
<div class="col-lg-7 " >
  <img src="http://s33.postimg.org/jtnuuxp9q/temp.jpg" alt="" width="100%">
  <p class="thanks">
     <br>
    Cảm ơn bạn đã ghé thăm!
     <br>
    <span>Chúng tôi mong sớm gặp lại bạn.</span>
  </p>
</div>
<div class="col-lg-4" style="padding-bottom:120px">
<?php // echo validation_errors();?>
                      
                      <?php echo form_open_multipart('');  ?>
                         
                      <h3>Create an account</h3>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" name="username" placeholder="Please Enter User Name" value="<?php echo set_value('username'); ?>"/>
                                <?php echo form_error('username')?>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Please Enter Password" value="<?php echo set_value('password'); ?>"/>
                                <?php echo form_error('password')?>
                                
                            </div>
                             <div class="form-group">
                                <label>Re-Password</label>
                                <input type="password" class="form-control" name="re-password" placeholder="Please Enter Re-Password" value=""/>
                                <?php echo form_error('re-password')?>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="email" placeholder="Please Enter email" value="<?php echo set_value('email'); ?>"/>
                                <?php echo form_error('email')?>
                            </div>
                          
                            


                            <div class="form-group">
                                <label>Level</label>
                                 <select class="form-control" name="level">
                                   <option value="">Please Choose Level</option>
                                    <?php 
                                        if(($this->session->userdata('data') == 'success')){
                                          cate_parent($level,0," ",set_value('level'));
                                        }else{
                                            echo '<option value="3" '.set_select('level', '3').'>Member</option>';
                                            echo '<option value="4" '.set_select('level', '4').'>Guest</option>';
                                        }
                                     ?>
                                </select>
                                <?php echo form_error('Level')?>
                           
                            <?php 
                              //echo '<pre>';print_r($a);
                            if(($this->session->userdata('data') == 'success')){ 
                              $level = $this->session->userdata['info']->level;
                              if(isset($level)&& $level >= 3){
                                redirect(base_url('/admin/cungtot'));
                              }
                            ?>
                            </div>
                           <div class="form-group">
                                <label>Status </label>
                                <label class="radio-inline">
                                    <input name="status" value="0"  type="radio"
                                    <?php 
                                      echo set_value('status') == 0 ? "checked" : ""; 
                                    ?>
                                    >InActive
                                </label>
                                <label class="radio-inline">
                                    <input name="status" value="1"  checked="" type="radio"
                                    <?php 
                                      echo set_value('status') == 1 ? "checked" : ""; 
                                    ?>

                                    >Active
                                </label>
                                <?php echo form_error('status')?>
                                
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
                                <?php echo form_error('status')?>

                            <?php

                            } ?>
                            <div class="form-group">
                               <div class="g-recaptcha" data-sitekey="6LfguyITAAAAAPTRwhOgf_C7OAgjxrjMkIhoSIRj"></div>
                            </div>
                              <input type="submit" class="btn btn-default" name="submit" value="Create an account" />
                            <button type="reset" class="btn btn-default">Reset</button>
                            <a href="<?php echo base_url('/login') ?>" class="">Đăng Nhập</a>

                        <form>
                    </div>
</div>

