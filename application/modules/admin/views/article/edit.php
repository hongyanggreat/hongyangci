<div class="col-lg-12" style="padding-bottom:120px">
<?php echo validation_errors();?>
                      <?php echo form_open_multipart('');  ?>
                           <?php // print_r($info) ?>
                           

                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="title" placeholder="Nhập Tiêu đề" value="<?php echo $info->title ?>"/>
                            </div>
                           <div class="form-group">
                                <label>Danh Mục</label>
                                 <select class="form-control" name="cat_menu">
                                   <option value="">Please Choose Category</option>
                                    <?php //cate_parent($parent,0,"--",set_value('cat_menu')) ?>
                                    <?php cate_parent($parent,0,"--",set_value('cat_menu',isset($info->catagory)?$info->catagory:'')) ?>
                                </select>
                            </div>
                             <div class="form-group">
                                <label>Images Current </label> 
                                <input type="hidden" name="imgCurrent" value="<?php echo $info->image ?>">
                            </div>
                             <div class="form-group">
                               <img width="150px" src="<?php echo base_url('/public/upload/cungtot/'.$info->image) ?>" alt="" title="<?php echo $info->image ?>">
                               <hr>
                                <input type="file" name="fImages" value="image">
                            </div>
                             <div class="form-group">
                                <label>Giới Thiệu Bài Viết</label>
                                <textarea class="form-control" name="intro" rows="3" placeholder="Giới thiệu"><?php echo set_value('intro',isset($info->intro)?$info->intro:''); ?></textarea>
                            </div>
    

                            <div class="form-group">
                                <label>Nội Dung bài viết</label>
                                <!-- <div class="fckEditor contents">Ẩn FckEditor</div> -->
                                <textarea id="contents" class="form-control" name="contents" rows="3" placeholder="Viết Bài"><?php echo set_value('contents',isset($info->content)?$info->content:''); ?></textarea>
                                <script>ckeditor ('contents')</script>
                            </div>

                            <input type="submit" class="btn btn-default" name="submit" value="Edit Article" />
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
                                    $("#cke_contents").css('display','block');
                                    $("#contents").css({'display':'none','visibility':'hidden'});
                                    $(this).text('Ẩn FckEditor');
                                }else{
                                    
                                    $("#cke_contents").css('display','none');
                                    $("#contents").css({'display':'block','visibility':'visible'});
                                    $(this).text('Hiện FCK');

                                }

                        });

                    </script>