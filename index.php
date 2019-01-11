<?php

    include("include/db_connect.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TM_limited & Begmenov</title>
    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="js/slick-1.8.0/slick/slick.min.js"></script>
    <script src="general.js"></script>  
    <link rel="stylesheet" type="text/css" href="js/slick-1.8.0/slick/slick.css"/>
    <link rel="stylesheet" type="text/css" href="js/slick-1.8.0/slick/slick-theme.css"/>
    <link rel="stylesheet" href="css/reset.css">
    <link rel="stylesheet" href="css/style.css"> 
    
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
<style>
    body{
        margin-top: -15px;
    }    
</style>

<div id="block-body">
    <?php
    
    include("include/block-header.php");
    
    ?>   
    
     
            
<div class="slider single-item">
    <div><a href="#"><img src="images/1.jpg"></a></div>
    <div><a href="#"><img src="images/2.jpg"></a></div>
    <div><a href="#"><img src="images/3.jpg"></a></div>
    <div><a href="#"><img src="images/1.jpg"></a></div>
    <div><a href="#"><img src="images/2.jpg"></a></div>
    <div><a href="#"><img src="images/3.jpg"></a></div>
</div>            
              
<div id="block-content">
   <h2 class="best-new">Бестселлеры</h2>
 <div id="tovr-grid">
  
  <?php
     
     
  $result = mysql_query("SELECT * FROM table_products ORDER BY RAND() LIMIT 3",$link);
      
    
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
              <a href="view_content.php?id='.$row[products_id].'" ><img src="'. $img_path.'" width = "'.$width.'" height = "'.$height.'"></a>
          </div>
          <div class="text">
            <a href="view_content.php?id='.$row[products_id].'" > '.$row[title].' </a>
            <p>'.$row[mini_features].'</p><br>
            <div class="price-grid"><strong>Цена: '.$row[price].'</strong> грн.</div>
          </div>
          <div class="button ">
            <a class="aaaa" bid="'.$row[products_id].'"><div>Купить</div></a>
          </div>
        </div>
        
        ';
        
        
    }
    while ($row = mysql_fetch_array($result));
    
}
  
         
?>    
</div>  
<h2 class="best-new">Новинки</h2>
 <div id="tovr-grid">
  
  <?php
     
     
  $result = mysql_query("SELECT * FROM table_products  ORDER BY products_id DESC LIMIT 3",$link);
      
    
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
              <a href="view_content.php?id='.$row["products_id"].'" ><img src="'. $img_path.'" width = "'.$width.'" height = "'.$height.'"></a>
          </div>
          <div class="text">
            <a href="view_content.php?id='.$row["products_id"].'" > '.$row[title].' </a>
            <p>'.$row[mini_features].'</p><br>
            <div class="price-grid"><strong>Цена: '.$row[price].'</strong> грн.</div>
          </div>
          <div  class="button">
            <a  class="aaaa"   bid="'.$row[products_id].'"><div>Купить</div></a>
          </div>
        </div>
        
        ';
        
        
    }
    while ($row = mysql_fetch_array($result));
    
}
  
         
?>  

 
    
        
</div>  
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