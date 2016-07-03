<div class="col-lg-12" style="padding-bottom:120px">
<?php echo validation_errors();?>
                      <?php echo form_open_multipart('');  ?>
                           
                           

                            <div class="form-group">
                                <label>Tiêu Đề</label>
                                <input class="form-control" name="title" placeholder="Nhập Tiêu đề" value=""/>
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
                                <label>Giới Thiệu Bài Viết</label>
                                <textarea class="form-control" name="intro" rows="3" placeholder="Giới thiệu"><iframe src="http://www.youtube.com/embed/ItV3OfX8JwI?modestbranding=1&controls=2&autoplay=1&title=0" frameborder="0" allowfullscreen></iframe></textarea>
                            </div>
                             <div class="form-group">
                                <label>Bài Viết Có Sử Dụng Iframe </label>
                                <input class="form-control" type="text" name="iframe" value="1" style="display: none">
                            </div>

                            <div class="form-group">
                                <label>Nội Dung bài viết</label>
                                <textarea class="form-control" name="contents" rows="3" placeholder="Viết Bài"><video controls="" autoplay="" name="media" style="
    width: 100%" ><source src="videohere" type="video/mp4" "></video></textarea>
                            </div>
                            
                            <?php if($this->session->userdata('info')->level < 3){ ?>
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