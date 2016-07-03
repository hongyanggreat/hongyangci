<style>
    #test,#test2{
    width: auto;
    height: 50px;
    background: #4DDBFF;
    text-align: center;
    font-size: 20px;
    font-weight: bold;
    border: 1px solid #ccc;
    }
    .xclose{
        width: auto;
        height: 50px;
        margin: 0 auto;
        text-align: center;
        background: red;

    }
</style>
<div id="test">
    Random number
</div>
<div id="test2">
    Giam so giay dem nguoc tu 5 giay
</div>


  <div class="home-cats clr">
  <?php 
    foreach ($listCategory as $item) {
      
 ?>
    <div class="home-cat-entry clr">
        <h2 class="heading">
                <a href="<?php echo base_url('/').$item->alias ?>" title="Health">
                    <?php echo $item->name ?>                                      </a>
            </h2>
        <ul>
        <?php 
            $options = array('task'=>'articleOne','category'=>$item->id);
            $rowArticle = $this->spanta_model->oneArticle($options);
   //echo count($rowArticle).'===================';
            if(count($rowArticle) >0){
            $options = array('task'=>'infoCategory','catagory'=>$rowArticle->catagory);
            $itemCategory = $this->spanta_model->infoCategory($options);


            //echo '<pre>'; print_r($category);
        ?>
            <li class="home-cat-entry-post-first clr">
                <div class="home-cat-entry-post-first-media clr">
                    <a href="<?php echo base_url('/').$rowArticle->alias ?>" title=""> <img src="<?php echo base_url('public/upload/cungtot/'. $rowArticle->image) ?>" alt="" width="620" height="350" /> </a>
                    <div class="entry-cat-tag cat-28-bg"> <a href="<?php echo base_url('spartan/category/'.$itemCategory->alias) ?>" title="<?php echo  $itemCategory->name ?>"><?php echo $itemCategory->name ?></a> </div>
                    <!-- .entry-cat-tag -->
                </div>
                <h3 class="home-cat-entry-post-first-title">
                    <a href="<?php echo base_url('/').$rowArticle->alias ?>" title="<?php echo $rowArticle->title ?>"><?php echo substr($rowArticle->title,0,25) ?> &hellip;</a>
                </h3>
                <p><?php echo substr($rowArticle->intro,0,120) ?> &hellip;</p>
            </li>
            <!-- .home-cat-entry-post-firs -->
             <?php 
                $options = array('task'=>'articleLink','id'=>$rowArticle->id,'category'=>$item->id,'limit'=>5,'offset'=>0);
                $linkArticle = $this->spanta_model->listArticle($options);
               // echo '<pre>'; print_r($linkArticle);
                foreach ($linkArticle as $item) {
                    
            ?>
            <li class="home-cat-entry-post-other clr"> <a href="<?php echo base_url('/').$item->alias ?>" title="<?php echo $item->title ?>"><?php echo $item->title ?> </a> </li>
            <!-- .home-cat-entry-post-other -->
            <?php } }?>
        </ul>
    </div>
<?php } ?>
    
</div>