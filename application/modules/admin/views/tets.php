<?php echo form_open_multipart('',array('id'=>'form')); ?>
     
 <h3>User Data</h3>
 <span class="btn btn-success" onclick="add_tets()"><i class="glyphicon glyphicon-plus"></i> Add Cate Product</span>

 <!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title">Person Form</h3>
            </div>
            <div class="modal-body form">
                <div class="form-body">
                    <div class="form-group">
                        <label class="control-label col-md-3">Image</label>
                        <div class="col-md-9">
                            <input type="file" name="fImages">
                            <span class="help-block"></span>
                        </div>
                    </div>
                </div>
                <br>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" name="submit" onclick="save()" class="btn btn-primary">Save</button>
                <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->
  </form>

   <script>
      function add_tets()
        {

            $('.removeForm').remove();
            $('#form')[0].reset(); // reset form on modals
            $('.form-group').removeClass('has-error'); // clear error class
            $('.help-block').empty(); // clear error string
            $('#modal_form').modal('show'); // show bootstrap modal
            $('.modal-title').text('Add  Tets'); // Set Title to Bootstrap modal title
        }
        
      function save(){
         $.ajax({
                url : "<?php echo site_url('admin/test/process')?>",
                type: "POST",
                dataType: "html",
                success: function(data)
                {   
                   alert(data);
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    alert('Error get data from ajax');
                }
            });
      }
 </script>