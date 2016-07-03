 <?php echo form_open('') ?>
<div class="row">
    <div class="col-lg-12 customer">
        <label>Check All</label>
        <input type="checkbox" class="check btn" id="checkAll" >
         <input type="submit" class="btn btn-danger" id="inactive" name="submit" onclick="return confirm('You are Sure!')" value="InActive" /> 
         <input type="submit" class="btn btn-primary" id="active" name="submit" onclick="return confirm('You are Sure!')" value="Active" /> 
         <input type="submit" class="btn btn-primary" id="order" name="submit" onclick="return confirm('You are Sure!')" value="Order" /> 
         <input type="submit" class="btn btn-primary" id="delelte" name="submit" onclick="return confirm('You are Sure!')" value="Delete" /> 
    </div>
</div>
 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <?php //echo '<pre>';print_r($post); ?>
                        <thead>
                            <tr align="center">
                                <th style="width: 80px;">Check</th>
                                <th style="width: 80px;">ID</th>
                                <th>Name</th>
                                <th>Alias</th>
                                <th>Status</th>
                                <th>Parent</th>
                                <th style="width: 80px;">Order</th>
                                <th style="width: 80px;">Delete</th>
                                <th style="width: 80px;">Edit</th>
                            </tr>
                        </thead>
                        <tbody>

                           <?php 
                           $i =1;
                          // print_r($post);
                           foreach ($post as $item) {
                           ?>
                            <tr class="even gradeC" align="center">
                                <td><input type="checkbox" class="check" name="checkbox[]" value="<?php echo $item->id ?>"></td>
                                <td><?php 
                                    echo $item->id
                                    //echo $i++ ?></td>
                                <td><?php echo $item->name ?></td>
                                <td><?php echo $item->alias ?></td>
                                <td>
                                    <?php 
                                        if($item->status == 1)
                                            echo '<a href="'.base_url('admin/cungtot_catagory/filter').'/'.$item->status.'/'.$item->id.'"><i style="color:green;font-size:18px" class="fa fa-check-circle" aria-hidden="true"></i></a>';   
                                        else
                                            echo '<a href="'.base_url('admin/cungtot_catagory/filter').'/'.$item->status.'/'.$item->id.'"><i style="color:#D00000;font-size:18px" class="fa fa-minus-circle" aria-hidden="true"></i></a>';
                                     ?>
                                </td>


                                <?php 
                                   
                                  // echo '<pre>'; print_r($result); 
                                        $this->db->where('parent', $item->id);
                                        $this->db->from('cungtot_category');
                                        $count =  $this->db->count_all_results();
                                   if($item->parent == 0){
                                    if($count>0){

                                        echo "<td class='warning'>Parent</td>";
                                    }else{
                                        
                                        echo "<td>Parent-$count</td>";
                                    }
                                   }else{
                                         $query = $this->db->where('id',$item->parent)->get('cungtot_category'); 
                                         $result = $query->row();
                                         if($count>0){

                                                echo "<td class='warning'>$result->name</td>";
                                            }else{
                                                
                                                echo "<td>$result->name-$count</td>";
                                            }
                                   }
                                ?>
                                <td ><input style="width: 40px;text-align: center;" type="text" class="check" name="order[]" value="<?php echo $item->order ?>"></td>
                                
                                
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirm('You are Sure!')" href="<?php echo base_url('admin/cungtot_catagory/delete/'.$item->id) ?>"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="<?php echo base_url('admin/cungtot_catagory/edit/'.$item->id) ?>">Edit</a></td>
                            </tr>
                            <?php } ?>
                        </tbody>
        
</table>
<?php echo form_close() ?>


                    <script>
                        
                        $("#checkAll").click(function () {
                            $(".check").prop('checked', $(this).prop('checked'));
                        });

                        $(".customer #active").click(function(){
                            //alert('active');
                            $("form").attr('action','admin/cungtot_catagory/status/1')
                        });
                        $(".customer #inactive").click(function(){
                            //alert('active');
                            $("form").attr('action','admin/cungtot_catagory/status/0')
                        });
                        $(".customer #order").click(function(){
                            //alert('active');
                            $("form").attr('action','admin/cungtot_catagory/order')
                        });
                        $(".customer #delelte").click(function(){
                            //alert('active');
                            $("form").attr('action','admin/cungtot_catagory/multiDelete')
                        });

                        //@betdream
                    </script>