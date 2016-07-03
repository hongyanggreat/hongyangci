 <?php echo form_open('') ?>

<div class="row">
    <div class="col-lg-12 customer">
        <label>Check All</label>
        <input type="checkbox" class="check btn" id="checkAll" >
         <input type="submit" class="btn btn-danger" id="inactive" name="submit" onclick="return confirm('You are Sure!')" value="InActive" /> 
         <input type="submit" class="btn btn-primary" id="active" name="submit" onclick="return confirm('You are Sure!')" value="Active" /> 
        
    </div>
</div>

<script>
    
    $("#checkAll").click(function () {
        $(".check").prop('checked', $(this).prop('checked'));
    });

    $(".customer #active").click(function(){
        //alert('active');
        $("form").attr('action','admin/user/status/1')
    });
    $(".customer #inactive").click(function(){
        //alert('active');
        $("form").attr('action','admin/user/status/0')
    });
  
</script>
 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th></th>
                                <th>Stt</th>
                                <th style="width: 80px;">ID</th>
                                <th>username</th>
                                <th>email</th>
                                <th>IP Addess</th>
                                <th>Level</th>
                                <th>status</th>
                                <th style="width: 80px;">Delete</th>
                                <th style="width: 80px;">Edit</th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php 
                            $i= 1;
                            $idLogin = $this->session->userdata['info']->id;
                              $levelLogin = $this->session->userdata['info']->level;
                            foreach ($listUser as $item) { 
                                
                                if(($levelLogin >= $item->level && $idLogin != $item->id)){
                                      $linkStatus= $linkDelete = $linkEdit = base_url('admin/user/warning') ;
                                 }else{
                                    $linkEdit = base_url('admin/user/edit/'.$item->id) ;
                                    $linkDelete = base_url('admin/user/delete/'.$item->id);
                                    $linkStatus = base_url('admin/user/filter').'/'.$item->status.'/'.$item->id;

                                 }
                                 if($idLogin == $item->id){
                                    $here = '<i style="color:green;font-size:10px" class="fa fa-circle" aria-hidden="true"></i>';
                                    $linkStatus = $linkDelete = base_url('admin/user/warning') ;
                                }else{
                                    $here = '';
                                }
                                if($levelLogin >= $item->level){
                                    $checkbox = '<td><input type="checkbox" name="" value="" disabled ></td>';

                                }else{
                                    
                                    $checkbox = '<td><input type="checkbox" class="check" name="checkbox[]" value="'.$item->id.'"></td>';
                                }

                               
                        ?>
                            <tr class="even gradeC" align="center">
                                <?php   echo $checkbox ?>
                                <td><?php echo $i++ .'  ' .$here?></td>
                                <td><?php echo $item->id ?></td>
                                <td><?php echo $item->username ?></td>
                                <td><?php echo $item->email ?></td>
                                <td><?php echo $item->ip_address ?></td>
                                <?php 
                                    if($item->level == 1){
                                        $level = 'Founder';
                                    }elseif($item->level == 2){
                                        $level = 'Admin';

                                    }else{
                                        $level = 'Member';
                                    }
                                 ?>
                                <td><?php echo $level ?></td>
                                <td>
                                    <?php 
                                        if($item->status == 1)
                                            echo '<a href="'.$linkStatus.'"><i style="color:green;font-size:18px" class="fa fa-check-circle" aria-hidden="true"></i></a>';   
                                        else
                                            echo '<a href="'.$linkStatus.'"><i style="color:#D00000;font-size:18px" class="fa fa-minus-circle" aria-hidden="true"></i></a>';
                                     ?>
                                </td>
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirm('You are Sure!')" href="<?php echo $linkDelete ?>"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="<?php echo $linkEdit?>" onclick="return confirm('You are Sure!')">Edit</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
        
</table>
<?php echo form_close() ?>

