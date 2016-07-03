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
                                <textarea class="form-control" name="contents" rows="3" placeholder="Viết Bài"><?php echo set_value('contents',isset($info->content)?$info->content:''); ?></textarea>
                            </div>

                            <input type="submit" class="btn btn-default" name="submit" value="Edit Article" />
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>