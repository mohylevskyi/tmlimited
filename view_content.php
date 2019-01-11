<?php

    include("include/db_connect.php");
    $type = $_GET["type"];
    $type = strip_tags($type);
    $type = mysql_real_escape_string($type);
    $type= trim($type);

    $id= $_GET["id"];
    $id = strip_tags($id);
    $id = mysql_real_escape_string($id);
    $id= trim($id);
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
</head>
<body>


<div id="block-body">
   <?php
    
    include("include/block-header.php");
    
    ?>   
        
 <div id="block-content">  
      <?php
    $result = mysql_query("SELECT * FROM table_products  WHERE products_id=$id",$link);
      
    
if (mysql_num_rows($result) > 0)
{
    $row = mysql_fetch_array($result);
    
     do
       {
        
        if ($row["image"] != "" && file_exists("./uploads_images/".$row["image"]))
        {
        $img_path = './uploads_images/'.$row["image"];
        $max_width = 350;
        $max_height = 450;
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
         
         echo'
         
         <div id="view-img">
         <img src="'.$img_path.'" width="'.$width.'" height="'.$height.'">
         <div class="price-grid"><strong>Цена: '.$row[price].'</strong> грн.</div>
         
         
         </div>
         <div id="view-description">
         <div class="">
            <a href="view_content.php?id='.$row["products_id"].'"> '.$row[title].' </a>
            <p>'.$row[mini_features].'</p><br>
          </div>
         <div class="button">
            <a class="aaaa"  bid="'.$row[products_id].'"><div>Купить</div></a>
          </div>
         </div>
         
         
         
         
         
         
         
         
         ';
         
         
         
     }
        while( $row = mysql_fetch_array($result));
        }

     
     
     
     ?>
        
        
        
        
        
    
</div>     
           
                 
                       
                             
                                         
   <?php
    
    include("include/block-footer.php");
    
    ?>     

    
</div>








</body>
</html>