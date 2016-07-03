<div class="col-lg-7" style="padding-bottom:120px">

                      <?php 
                        $this->session->set_userdata('login_attempts', 0);
                       /* print_r($this->session->userdata);
                        echo '<hr>';*/
                       ?>
                      <?php echo form_open_multipart('');  ?>
                           
                            <h2 style="color: red">
                                
                            Bạn quên mật khẩu của tài khoản </h2>
<p style="color: #071257;text-align: center;">Bạn phải khai báo địa chỉ email đang sử dụng cho tài khoản của mình. Nếu bạn không thay đổi địa chỉ này thông qua bảng điều khiển thành viên của mình, địa chỉ này sẽ được lấy từ địa chỉ email mà bạn đã đăng ký thành viên.</p>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text"  class="form-control" name="email" placeholder="Please Enter Mail" value="<?php echo set_value('email'); ?>"/>
                            <?php echo validation_errors();?>
                            </div>

                           
                            <input type="submit" class="btn btn-default" name="submit" value="Gửi" />
                            <a href="<?php echo base_url('/login') ?>" class="">Đăng Nhập Lại</a>
                            <a href="<?php echo base_url('/registry') ?>" class="">Đăng Ký</a>
                              
                        <form>
                    </div>