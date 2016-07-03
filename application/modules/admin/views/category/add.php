
<div class="col-lg-7" style="padding-bottom:120px">
<?php echo validation_errors();?>
                      <?php echo form_open_multipart('');  ?>
                           
                           

                            <div class="form-group">
                                <label>Category Name</label>
                                <input class="form-control" name="name" placeholder="Please Enter Category Name" value=""/>
                            </div>
                            <div class="form-group">
                                <label>Alias</label>
                                <input class="form-control" name="alias" placeholder="Please Enter Alias" value=""/>
                            </div>
                            <div class="form-group">
                                <label>Category Parent</label>
                                 <select class="form-control" name="cat_menu">
                                   <option value="0">Please Choose Category</option>
                                    <?php cate_parent($parent,0,"--",set_value('cat_menu')) ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Order</label>
                                <input class="form-control" name="order" placeholder="Please Enter Order" value=""/>
                            </div>
                           
                            <div class="form-group">
                                <label>Status</label>
                                <label class="radio-inline">
                                    <input name="status" value="0" checked="" type="radio"
                                    <?php 
                                      echo set_value('status') == 0 ? "checked" : ""; 
                                    ?>
                                    >InActive
                                </label>
                                <label class="radio-inline">
                                    <input name="status" value="1" type="radio"
                                    <?php 
                                      echo set_value('status') == 1 ? "checked" : ""; 
                                    ?>

                                    >Active
                                </label>
                                
                            </div>
                           

                            <input type="submit" class="btn btn-default" name="submit" value="Add Category" />
                            <button type="reset" class="btn btn-default">Reset</button>
                        <form>
                    </div>