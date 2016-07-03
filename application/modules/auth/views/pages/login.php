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
<div class="col-lg-7 " style="">
  <img src="http://s33.postimg.org/p0jl2ql9q/temp.jpg" alt="" width="100%">
  <p class="thanks">
    Chào Mừng Bạn Đến Với Chúng Tôi! <br>
    <span>Let's Go.</span>
  </p>
</div>
                
<div class="col-lg-4" style="padding-bottom:120px">
<?php echo validation_errors();?>

                      <?php echo form_open_multipart('');  ?>
                           
                            <h3>Đăng Nhập</h3>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text"  class="form-control" name="username" placeholder="Please Enter User Name" value="<?php echo set_value('username'); ?>"/>
                            </div>

                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Please Enter Password" value=""/>
                            </div>
                           <?php 
                           if($this->session->userdata('login_capcha') == 1){
                             ?>
                          <!--  <div class="form-group">
                              <div class="g-recaptcha" data-sitekey="6Lek5CATAAAAAAOo4JBGW5IsA5uHFwW_fXBSeft1"></div>
                           </div> -->
                            <?php } ?>
                             <a href="<?php echo base_url('/forget') ?>" class="">Quên mật Khẩu/Xác Nhận Acc</a>
                              <br><br>
                              <input type="submit" class="btn btn-default login" name="submit" value="Đăng Nhập" />
                              <br><br>
                            Chưa có tài khoản? <a href="<?php echo base_url('/registry') ?>" class="">Đăng Ký</a> 
                           
                        <form>
                    </div>

