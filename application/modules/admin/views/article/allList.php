

 <?php //echo $level = $this->session->userdata('info')->level; ?>

 <?php echo form_open('admin/cungtot/multidel') ?>
<script>
    /*setInterval(function(){auto_refresh_function();}, 10);*/
</script>
<div class="row">
    <div class="col-lg-12 customer">
        <label>Check All</label>
        <input type="checkbox" class="check btn" id="checkAll" >
         <input type="submit" class="btn btn-primary" name="submit" onclick="return confirm('You are Sure!')" value="Multi Delete Article" /> 
         
    </div>
</div>



 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th style="width: 10px;"></th>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Alias</th>
                                <th>View</th>
                                <th>Author</th>
                                <th>Category</th>
                                <th>image</th>
                                <th>PreView</th>
                                    
                                <th>Status</th>
                                <th>Delete</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                           <?php 
                           $i =1;
                           //echo '<pre>';print_r($post);

                           foreach ($post as $item) {

                           ?>
                            <tr class="even gradeC" align="center">
                                <td><input type="checkbox" class="check" name="checkbox[]" value="<?php echo $item->id ?>"></td>
                                <td><?php 
                                        //echo $i++ ;
                                        echo $item->id;
                                ?></td>
                                <td><?php echo $item->title ?></td>
                                <td><?php echo $item->alias ?></td> 
                                <td><?php echo $item->view ?></td> 
                                <td> 
                                    <?php 
                                        $row = $this->User_model->userInfo($item->article_user);
                                        if($row){

                                            echo $row->username ;
                                        }else{
                                            
                                            echo 'Deny_'.$item->article_user;
                                        }
                                    ?>
                                </td>
                                <td><?php echo $item->name ?></td>
                                <?php 
                                    if(isset($item->image))
                                        $image = base_url('/public/upload/cungtot/'.    $item->image);
                                    else
                                        $image ='';
                                    
                                    if($item->iframe == 1){

                                        $linlEdit = base_url('admin/cungtot/edit/'.$item->id.'/iframe');
                                    }else{
                                        
                                        $linlEdit = base_url('admin/cungtot/edit/'.$item->id);
                                    }
                                 ?>
                                
                                <td >
                                    <img width="100px" src="<?php echo $image ?>" alt="" title="<?php echo $item->image ?>">
                                </td>
                                <?php 
                                $category = $this->category_model->infoCategory($item->catagory);
                               // echo '<pre>';print_r($category) ;
                                     $linkPrevview = 'preview/'.$item->alias;
                                 ?>
                                <td>
                                    <a href="<?php echo $linkPrevview ?>" target="_blank">
                                        <i class="fa fa-eye" aria-hidden="true"> View</i>
                                    </a>
                                </td>
        

                                <td>
                                    <?php 
                                        if($item->status == 1){
                                            echo '<a href="'.base_url('admin/cungtot/filter').'/'.$item->status.'/'.$item->id.'"><i style="color:green;font-size:18px" class="fa fa-check-circle" aria-hidden="true"></i></a>';   
                                        }
                                        else{
                                            echo '<a href="'.base_url('admin/cungtot/filter').'/'.$item->status.'/'.$item->id.'"><i style="color:#D00000;font-size:18px" class="fa fa-minus-circle" aria-hidden="true"></i></a>';
                                        }
                                     ?>
                                </td>

                                <?php 

                                 ?>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirm('You are Sure!')" href="<?php echo base_url('admin/cungtot/delete/'.$item->id) ?>"> Delete </a></td>

                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="<?php echo $linlEdit?>">Edit</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
<?php echo form_close() ?>

                    <script>
                        
                        $("#checkAll").click(function () {
                            $(".check").prop('checked', $(this).prop('checked'));
                        });

                        //@betdream
                    </script>