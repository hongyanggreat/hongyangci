 <?php echo form_open('') ?>

<?php 

echo "The time is " . date("h:i:sa");
echo time();
echo '<br>';
echo date('d/m/Y h:i:sa', time());
 ?>
 <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>Stt</th>
                                <th>Ip Address</th>
                                <th>Ss_cookie</th>
                                <th>Time</th>
                                <th>Status</th>
                                <th>View</th>
                                <th style="width: 80px;">Delete</th>
                                <th style="width: 80px;">Edit</th>
                            </tr>
                        </thead>
                        <tbody>


                        <?php 
                            $i = 1;
                            foreach ($result as $item) {

                         ?>
                            <tr class="even gradeC" align="center">
                                <td><?php echo $i ++?></td>
                                <td><?php echo $item->ip_address?></td>
                                <td><?php echo substr($item->ss_cookie,0,20)?> ...</td>
                                <td><?php echo date('d/m/Y h:i:sa', $item->time);?></td>
                                <td><?php echo $item->status?></td>
                                <td><?php echo $item->view?></td>
                                
                                <td class="center"><i class="fa fa-trash-o  fa-fw"></i><a onclick="return confirm('You are Sure!')" href="<?php echo base_url('admin/user/del_ip_address/'.$item->id) ?>"> Delete</a></td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="" onclick="return confirm('You are Sure!')">Edit</a></td>
                            </tr>
                        <?php } ?>
                        </tbody>
        
</table>
<?php echo form_close() ?>

