<div class="col-lg-7" style="padding-bottom:120px">
<?php echo validation_errors();?>
                      
                      <?php echo form_open_multipart('');  ?>
                         
                      <h3>Capcha</h3>
                           
                            <div class="form-group">
                               <div class="g-recaptcha" data-sitekey="6LdeWR8TAAAAABsDGaCUrlGv_fsitnOUY8KyxoYw"></div>
                            </div>
                              <input type="submit" class="btn btn-default" name="submit" value="Create an account" />
                            <button type="reset" class="btn btn-default">Reset</button>
                            <a href="<?php echo base_url('/login') ?>" class="">Đăng Nhập</a>

                        <form>
                    </div>