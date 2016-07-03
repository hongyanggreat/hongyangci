<style>
    ul.gallery {
        clear: both;
        float: left;
        width: 100%;
        margin-bottom: -10px;
        padding-left: 3px;
    }
    ul.gallery li.item {
        width: 28%;
        height: 150px;
        display: block;
        float: left;
        margin: 0px 15px 15px 0px;
        font-size: 12px;
        font-weight: normal;
        background-color:#f5f5f5;
        padding: 10px;
        box-shadow: 10px 10px 5px #888888;
        position: relative;
    }

    .item img{width: 100%; height: auto;}

    .item p {
        color: #6c6c6c;
        letter-spacing: 1px;
        text-align: center;
        position: relative;
        margin: 5px 0px 0px 0px;
    }
    .removeImage{
        cursor: pointer;
        position: absolute;
        right: 2px;
        top: 0px;
        color: #a90000
    }
    
    </style>


<div class="col-lg-6" style="padding-bottom:120px">
<?php echo validation_errors();?>
<?php echo form_open_multipart('');  ?>
   
   

    <div class="form-group">
       <h3> Product : <?php echo isset($product->name)?$product->name:'' ?></h3>
    </div>
    <div class="form-group">
        <label>Current Image</label>
        <br>
        <input type="hidden" name="imgCurrent" value="<?php echo isset($product->image)?$product->image:'' ?>">
        <img src="<?php echo base_url('public/shopping/images/products/'.$product->nameCate.'/'.$product->nameClass.'/'.$product->nameProduct).'/'.$product->image ?>" alt="" width="150">
    </div>
    <div class="form-group">
        <label>Hình Ảnh</label>
        <input type="file" name="fImages">
    </div>
    

    <input type="submit" class="btn btn-success" name="submit" value="Add Category" />
    <button type="reset" class="btn btn-default">Reset</button>
</div>
<div class="col-lg-5 box-img" style="padding-bottom:120px">
   <div class="form-group">
        <label>Choose Files</label>
        <input type="file" class="form-control" name="userFiles[]" multiple/>
        <hr>
    </div>

    <?php 
    //echo '<pre>';print_r($product->img ) ?>
    <div class="row">
        <ul class="gallery">
            <?php 
                foreach ($product->img as $value) {
                
             ?>
            <li class="item" id="<?php echo $value->id?>" >
                <i class="fa fa-times removeImage" idImg = "<?php echo $value->id ?>"></i>
                <img src="<?php echo base_url('public/shopping/images/products/'.$product->nameCate.'/'.$product->nameClass.'/'.$product->nameProduct).'/'.$value->name ?>" img="<?php echo $value->name?>" >
            </li> 
           
            <?php } ?>
        </ul>
    </div>
     <hr>
</div>
<form>
<script>
    $('.removeImage').on('click',function(){
        var idImg = $(this).attr('idImg');
        var url ="<?php echo base_url('admin/shopping/products/ajaxDelImage') ?>/" + idImg;
        var nameCate = "<?php echo $product->nameCate ?>";
        var nameClass = "<?php echo $product->nameClass ?>";
        var nameProduct = "<?php echo $product->nameProduct ?>";
        var img = "public/shopping/images/products/" +nameCate + "/" + nameClass + "/" +nameProduct +"/" + $(this).siblings().attr('img');

      $.ajax({
            url : url,
            type: "POST",
            data: {'img':img},
            dataType: "json",
            success: function(data)
            {
                //alert(data);
                
                if(data.status) {
                    $('li#'+idImg).remove();
                }else{
                   // alert('Không thành công');
                }
            }

        });
        
    });
</script>
