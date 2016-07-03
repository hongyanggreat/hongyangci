
<div class="col-lg-12" style="padding-bottom:120px">
<?php echo validation_errors();?>
                      <?php echo form_open_multipart('');  ?>
                           
                           

                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="title" placeholder="Nhập Tiêu đề" value="<?php echo set_value('title', ''); ?>"/>
                            </div>
                           <div class="form-group">
                                <label>Danh Mục</label>
                                 <select class="form-control" name="cat_menu">
                                   <option value="">Please Choose Category</option>
                                    <?php cate_parent($parent,0,"--",set_value('cat_menu')) ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <input type="file" name="fImages">
                            </div>
                             <div class="form-group">
                                <label>Giới Thiệu Bài Viết </label>
                                <!-- <div class="fckEditorintro intro">Ẩn FckEditor</div> -->
                                <textarea  id="intro" class="form-control" name="intro" rows="3" placeholder="Giới thiệu"></textarea>
                            </div>
    

                            <div class="form-group">
                                <label>Nội Dung bài viết</label>
                               <!--  <div class="fckEditor contents">Ẩn FckEditor</div> -->
                                <textarea id="contents" class="form-control" name="contents" class="" rows="3" placeholder="Viết Bài"></textarea>
                                    <script>ckeditor ('contents')</script>
                            </div>
                            <?php if($this->session->userdata('info')->level < 3){ ?>
                             <div class="form-group">
                                <label>Status </label>
                                <label class="radio-inline">
                                    <input name="status" value="0" checked=""  type="radio"
                                    <?php 
                                      echo set_value('status') == 0 ? "checked" : ""; 
                                    ?>
                                    >InActive
                                </label>
                                <label class="radio-inline">
                                    <input name="status" value="1"   type="radio"
                                    <?php 
                                      echo set_value('status') == 1 ? "checked" : ""; 
                                    ?>

                                    >Active
                                </label>
                                
                            </div>
                            <?php }else{ ?>
                                <div class="form-group">
                                    <label class="radio-inline">
                                        <input name="status" value="0" checked="" type="radio"
                                        <?php 
                                          echo set_value('status') == 0 ? "checked" : ""; 
                                        ?>
                                        >Bài Viết Của Bạn Cần Phải được Kiểm Duyệt Trước khi Public
                                    </label>
                                </div>
                            <?php } ?>
                
                            <input type="submit" class="btn btn-default" name="submit" value="Add Article" />
                            <button type="reset" class="btn btn-default">Reset</button>
                            
                        <form>
                    </div>

                    <script>
                        $('.fckEditorintro.intro').click(function(){
                                $(this).toggleClass('intro');
                                if ($('.fckEditorintro').hasClass('intro')) {
                                    $("#cke_intro").css('display','block');
                                    $("#intro").css({'display':'none','visibility':'hidden'});
                                    $(this).text('Ẩn FckEditor');
                                }else{
                                    
                                    $("#cke_intro").css('display','none');
                                    $("#intro").css({'display':'block','visibility':'visible'});
                                    $(this).text('Hiện FCK');
                                }

                        });
                         $('.fckEditor.contents').click(function(){
                                $(this).toggleClass('contents');
                                if ($('.fckEditor').hasClass('contents')) {
                                    $("#cke_contents").remove();
                                    $("#contents").css({'display':'none','visibility':'hidden'});
                                    $(this).text('Ẩn FckEditor');
                                }else{
                                    
                                    $("#cke_contents").remove();
                                    $("#contents").css({'display':'block','visibility':'visible'});
                                    $(this).text('Hiện FCK');

                                }

                        });

                    </script>