<?php 
	function paginator($currentPage,$totalPages,$base_url){
        echo  '<nav class="pagination loop-pagination"><a class="prev page-numbers" href="">';
            if($currentPage <= $totalPages ){
                $lable = 'Pages '.$currentPage . ' of ' .$totalPages;
            }else{
                
                redirect('/qcfree');
            }
         
            echo $lable;  
            echo '</a>';
            if($currentPage > 1){
                $previous = $currentPage-1;
                echo '<a class="prev page-numbers" href="'.$base_url.'/'.$previous.'">← Previous</a>';
            }
            if($currentPage != 1){
                echo '<a class="prev page-numbers" href="'.$base_url.'/'.'1">Trang Đầu</a>';
            }
            $prePage = $currentPage-1;
            if($prePage < $totalPages && $prePage > 1){
                echo '<span class="page-numbers dots">…</span>';
                echo '<a class="prev page-numbers" href="'.$base_url.'/'.$prePage.'">'.$prePage.'</a>';
            }
            echo '<span class="page-numbers current" style="color:#BC0000">'.$currentPage.'</span>';
            $nextpage = $currentPage+1;
            if($nextpage < $totalPages){
                echo '<a class="prev page-numbers" href="'.$base_url.'/'.$nextpage.'">'.$nextpage.'</a><span class="page-numbers dots">…</span>';
            }
            if($currentPage !=$totalPages ){
                echo '<a class="prev page-numbers" href="'.$base_url.'/'.$totalPages.'">Trang Cuối '.$totalPages.'</a>';
            }
            if($currentPage < $totalPages){
                $next = $currentPage+1;
                echo '<a class="prev page-numbers" href="'.$base_url.'/'.$next.'">Next →</a>';
            }
    }
   
    function paginator_options($totalArticle,$limit,$segment,$base_url){
		$totalArticle = count($totalArticle);
        $limit = $limit;
        $totalPages = ceil($totalArticle/$limit);
       
        if($segment >0){
             $currentPage = $segment;
        }else{
            
             $currentPage = 1;
        }
        $offset = $currentPage*$limit-$limit;
        if($currentPage > $totalPages){
            $currentPage = $totalPages;
        }
         $xhtml =  '<div class="site-pagination clr"> <span class="site-pagination-heading">Pages '.$currentPage.' of '.$totalPages.'</span>
                <ul class="page-numbers">';
                if($currentPage >1){

                    $xhtml .='<li><a class="page-numbers page-numbers_hidden" href="'.$base_url.'1'.'">Trang đầu</a></li>';
                     $xhtml .='<li><a class="page-numbers " href="'.$base_url.($currentPage-1).'">&larr; pre</a></li>
                            <li><a class="page-numbers page-numbers_hidden" href="'.$base_url.($currentPage-1).'">'.($currentPage-1).'</a></li>';
                }
                    $xhtml .=' <li><span class="page-numbers current">'.$currentPage.'</span></li>';
                if($currentPage < $totalPages){
                    $xhtml .='<li><a class="page-numbers page-numbers_hidden" href="'.$base_url.($currentPage+1).'">'.($currentPage+1).'</a></li>
                    <li><a class="page-numbers" href="'.$base_url.($currentPage+1).'">next &rarr;</a></li>';
                    $xhtml .='<li><a class="page-numbers page-numbers_hidden" href="'.$base_url.($totalPages).'">Trang cuối</a></li>';
                }
                $xhtml .='</ul>
            </div>
        ';
        if($totalPages > 1){

            return $xhtml;
        }else{
            return '';
        }
	}
 ?>

  