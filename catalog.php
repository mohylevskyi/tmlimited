<?php

    include("include/db_connect.php");
    $type = $_GET["type"];
    $type = strip_tags($type);
    $type = mysql_real_escape_string($type);
    $type= trim($type);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TM_limited & Begmenov</title>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="js/slick-1.8.0/slick/slick.min.js"></script>
    <link rel="stylesheet" type="text/css" href="js/slick-1.8.0/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="js/slick-1.8.0/slick/slick-theme.css"/>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css">   
    <script src="general.js"></script>  
<script>
$(window).scroll(function() {
if ($(this).scrollTop() > 300){  
$('#menu').addClass("glide");
}
else{
$('#menu').removeClass("glide");
}
});
</script>
</head>

<body>


<div id="block-body">
    <?php
    
    include("include/block-header.php");
    
    ?>   
    
     
<div class="navigation">
    <?php  
   if ($type == 'costume'){
       echo'
      <span>Вы здесь:  </span><a href="index.php"> Главная</a><span> /  Костюмы</span>
       ';
   }elseif ($type == 'shoes') {
      echo'
      <span>Вы здесь:  </span> <a href="index.php">Главная</a><span>/  Обувь</span>
       '; 
   }elseif ($type == 'upclothes'){
       echo'
       <span>Вы здесь:  </span><a href="index.php">Главная</a><span>/  Верхняя одежда</span>
       ';
   };
?>           
</div>            
<div class="slider single-item">
    <div><a href="#"><img src="images/1.jpg"></a></div>
    <div><a href="#"><img src="images/2.jpg"></a></div>
    <div><a href="#"><img src="images/3.jpg"></a></div>
    <div><a href="#"><img src="images/1.jpg"></a></div>
    <div><a href="#"><img src="images/2.jpg"></a></div>
    <div><a href="#"><img src="images/3.jpg"></a></div>
</div>            
              
<div id="block-content">
<?php  
   if ($type == 'costume'){
       echo'
       <h2 class="best-new">Костюмы</h2>
       ';
   }elseif ($type == 'shoes') {
      echo'
       <h2 class="best-new">Обувь</h2>
       '; 
   }elseif ($type == 'upclothes'){
       echo'
       <h2 class="best-new">Верхняя одежда</h2>
       ';
   };
?>       


 <div id="tovr-grid">
  
  
  <?php
 
     
     if (!empty($type)){
         
         
         $querycat = "type_tovara ='$type'";
         
         
     }
     $num = 9;
     $page = (int)$_GET['page'];
     
     $count = mysql_query("SELECT COUNT(*) FROM table_products WHERE $querycat",$link);
     $temp = mysql_fetch_array($count);
     
     if ($temp[0] > 0)
     {
         $tempcount = $temp[0];
         
         $total = (($tempcount - 1) / $num) +1;
         $total = intval($total);
         
         $page = intval($page);
         
         if (empty($page) or $page < 0) $page = 1;
            if($page > $total) $page = $total;
         
         
         $start = $page * $num - $num;
         
         $qury_start_num = "LIMIT $start, $num";
         
         
     }
     
  $result = mysql_query("SELECT * FROM table_products WHERE $querycat  $qury_start_num",$link);
      
    
if (mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    
     do
       {
        
        if ($row["image"] != "" && file_exists("./uploads_images/".$row["image"]))
        {
        $img_path = './uploads_images/'.$row["image"];
        $max_width = 300;
        $max_height = 400;
        list($width, $height) = getimagesize($img_path);
        $ratioh = $max_height/$height;
        $ratiow = $max_width/$width;
        $ratio = min($ratioh, $ratiow);
        $width = intval($ratio*$width);
        $height = intval($ratio*$height);
        }else
        {
        $img_path = "no_images.png";
        $width = 110;
        $height = 200;
        }
        
       
        echo '
        
    
        <div class="grid">     
          <div class="img-grid">
              <a href="view_content.php?id='.$row["products_id"].'"><img src="'. $img_path.'" width = "'.$width.'" height = "'.$height.'"></a>
          </div>
          <div class="text">
            <a href="view_content.php?id='.$row["products_id"].'"> '.$row[title].' </a>
            <p>'.$row[mini_features].'</p><br>
            <div class="price-grid"><strong>Цена: '.$row[price].'</strong> грн.</div>
          </div>
          <div class="button">
            <a class="aaaa"  bid="'.$row[products_id].'"><div>Купить</div></a>
          </div>
        </div>
        
        ';
        
        
    }
    while ($row = mysql_fetch_array($result));
    
}
  
echo '</div> ';
     
if ($page != 1) { $pstr_prev = '<li><a class="psrt-prev" href="catalog.php?page='.($page - 1).'&type='.$type.' "> &lt</a></li>' ;}
if ($page != 1) { $pstr_next = '<li><a class="psrt-next" href="catalog.php?page='.($page + 1).'&type='.$type.' "> &gt</a></li>';}     

     
if($page - 5 > 0){ $page5left = '<li><a href="catalog.php?page='.($page - 5).'&type='.$type.'">'.($page - 5).'</a></li>'; }    
if($page - 4 > 0){ $page4left = '<li><a href="catalog.php?page='.($page - 4).'&type='.$type.'">'.($page - 4).'</a></li>'; }
if($page - 4 > 0) {$page3left = '<li><a href="catalog.php?page='.($page - 3).'&type='.$type.'">'.($page - 3).'</a></li>'; }
if($page - 3 > 0){ $page2left = '<li><a href="catalog.php?page='.($page - 2).'&type='.$type.'">'.($page - 2).'</a></li>'; }
if($page - 1 > 0) {$page1left = '<li><a href="catalog.php?page='.($page - 1).'&type='.$type.'">'.($page - 1).'</a></li>'; }
     
if($page + 5 <= $total){ $page5right = '<li><a href="catalog.php?page='.($page + 5).'&type='.$type.'">'.($page + 5).'</a></li>';  }    
if($page + 4 <= $total){ $page4right = '<li><a href="catalog.php?page='.($page + 4).'&type='.$type.'">'.($page + 4).'</a></li>'; }
if($page + 3 <= $total) {$page3right = '<li><a href="catalog.php?page='.($page + 3).'&type='.$type.'">'.($page + 3).'</a></li>'; }
if($page + 2 <= $total){ $page2right = '<li><a href="catalog.php?page='.($page + 2).'&type='.$type.' ">'.($page + 2).'</a></li>'; }
if($page + 1 <= $total){ $page1right = '<li><a href="catalog.php?page='.($page + 1).'&type='.$type.' ">'.($page + 1).'</a></li>'; }
     

if ($page+5 < $total)
{
    $strtotal = '<li><p class="nav-point">...</p></a><li><a href="catalog.php?page='.$total.'&type='.$type.'">'.$total.'</a></li>';
} else
{
    $strtotal = "";
}

if($total > 1)
{
    echo'
    <div class="pstrnav">
    <ul>
    ';
    echo $pstr_prev.$page5left.$page4left.$page3left.$page2left.$page1left."<li><a class='pstr-active' href='catalog.php? page=".$page."&type='.$type.''>".$page."</a></li>".$page1right.$page2right.$page3right.$page4right.$page5right.$strtotal.$pstr_next;
    echo'
    </li>
    </ul>
    </div>
    ';
    
}
     
         
?>    
 

</div>     
           
                 
                       
                             
                                         
   <?php
    
    include("include/block-footer.php");
    
    ?>     

    
</div>






<script>
 $(function(){
    $('.slider').slick({
        speed: 2300,
        autoplay: true,
        autoplaySpeed: 6000,
        cssEase: 'linear',
        slidesToShow: 1,
        slidesToScroll: 1,
        variableWidth: true,
        infinite: true
    });
});  
   
</script>

</body>
</html>