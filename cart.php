<?php
session_start();
    include("include/db_connect.php"); 

    if (isset($_POST["submitdata"])){
        $_SESSION["order_delivery"] = $_POST["order_delivery"];
        $_SESSION["order_fio"] = $_POST["order_fio"];
        $_SESSION["order_email"] = $_POST["order_email"];
        $_SESSION["order_phone"] = $_POST["order_phone"];
        $_SESSION["order_address"] = $_POST["order_address"];
        
        
       header("Location: cart.php?action=completion"); 
        
    }

    $result = mysql_query("SELECT * FROM cart,table_products WHERE table_products.products_id = cart.cart_id_products",$link);            

            if (mysql_num_rows($result) > 0){
                
               $row = mysql_fetch_array($result); 
                
                do{
                    $int = $row["cart_price"] * $row["cart_count"];
                    $all_price = $all_price + $int;
                }
                    
                   while ($row = mysql_fetch_array($result)); 
                    
                   $itogpricecart =$all_price;
            }

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
</head>




<body>


<div id="block-body">
    <?php
    
    include("include/block-header.php");
    
    ?>   
    
     
            

<div id="block-content">
<?php 
    
    $action = $_GET["action"];
    switch ($action){
        case  'onclick':
          
            echo'
            <div id="block-step">
            
                <div id="name-step">
                    <ul>
                        <li><a class="active" href="cart.php?action=onclick">Корзина товаров </a>/</li>
                        <li><a href="cart.php?action=confirm"> Контактная информация </a>/</li>
                        <li><a href="cart.php?action=completion"> Завершение</a></li>
                    </ul>
                </div>
                <hr>
            </div>
            
            ';
            
$result = mysql_query("SELECT * FROM cart,table_products WHERE table_products.products_id = cart.cart_id_products",$link);            

            if (mysql_num_rows($result) > 0){
                
               $row = mysql_fetch_array($result); 
                
                do{
                    $int = $row["cart_price"] * $row["cart_count"];
                    $all_price = $all_price + $int;
                    
                    if ($row["image"] != "" && file_exists("./uploads_images/".$row["image"]))
                            {
                            $img_path = './uploads_images/'.$row["image"];
                            $max_width = 120;
                            $max_height = 200;
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
                <div class="block-list-cart">
                    <div class="img-cart">
                        <p><img src="'.$img_path.'" width="'.$width.'" height="'.$height.'"</p>
                    
                    </div>
                    <div class="title-cart">
                        <p><a href="">'.$row["title"].'</a></p>
                        <p class="mini-features">
                             '.$row["mini_features"].'
                        </p> 
                    </div>
                    <div class="count-cart">
                        <ul id="input-count-style">
                        
                            <li>
                            <p  class="count-minus count-style" iid="'.$row["cart_id"].'">-</p>
                            </li>

                            <li>
                            <p>
                            <input type="text" id="input-id'.$row["cart_id"].'" iid="'.$row["cart_id"].'" class="count-input"  maxlength="3" value="'.$row["cart_count"].'">
                            </p>
                            </li>

                            <li>
                            <p class="count-plus count-style" iid="'.$row["cart_id"].'">+</p>
                            </li>
                        </ul>
                    </div>
                    <div class="size-cart">
        
                        <select>
                            <option>41</option>
                            <option>42</option>
                            <option>43</option>
                            <option>44</option>
                            <option>45</option>
                        </select>
    
                    </div>
                    <div id="tovar'.$row["cart_id"].'" class="price-product">
                        <h5><span class="span-count">'.$row["cart_count"].'</span> x <span></span>'.$row["cart_price"].'</h5><p price="'.$row["cart_price"].'">'.$int.'</p>
                    </div>
                    <div class="delete-cart">
                        <a href=""><img src="images/close.png"></a>
                    </div>
               
                </div>
                 <hr>
            '; 
            }
                    
               while ($row = mysql_fetch_array($result));
                
                echo'
                    <h2 class="itog-price">Итого: <strong>'.$itogpricecart.'</strong>руб</h2>
                    <p class="button-next"><a href="cart.php?action=confirm">Далее</a></p>
                
                
                
                ';
                    
                
                
                
                
            }
            
            
            
            
            
            
            
            
            
        break;    
        case 'confirm':
            echo'
            <div id="block-step">
            
                <div id="name-step">
                    <ul>
                        <li><a href="cart.php?action=onclick">Корзина товаров </a>/</li>
                        <li><a class="active" href="cart.php?action=confirm"> Контактная информация </a>/</li>
                        <li><a href="cart.php?action=completion"> Завершение</a></li>
                    </ul>
                </div>
            </div>
            
            ';
           if ($_SESSION['order_delivery']=="По почте") $chck1 = "checked";
           if ($_SESSION['order_delivery']=="Самовывоз") $chck2 = "checked";
           
            echo'
            <div class="second-step">
            <h3 class="title-h3">Способы доставки</h3>
            <form method="post">
                <ul id="info-radio">
                <li>
                <input type="radio" id="order1"  name="order_delivery" class="order_delivery" value="По почте"  '.$chck1.' > 
                <label for="order1" class="label_delivery" >По почте</label>
                </li>
                <li>
                <input type="radio" id="order2" name="order_delivery" class="order_delivery" value="Самовывоз"  '.$chck2.'> 
                <label for="order2" class="label_delivery">Самовывоз</label>
                </li>
                </ul>
            <h3 class="title-h3">Информация для доставки:</h3>
            <ul id="info-order">
                <li><label for="order_fio">ФИО</label><input type="text" name="order_fio" placeholder="Иванов Иван Иванович" id="order_fio" value="'.$_SESSION["order_fio"].'"></li>
                <li><label for="order_email">E-mail</label><input type="text" name="order_email" placeholder="playzonezheka@gmail.com" id="order_email" value="'.$_SESSION["order_email"].'"></li>
                <li><label for="order_phone">Телефон</label><input type="number"  name="order_phone" id="order_phone" placeholder="380669306431" value="'.$_SESSION["order_phone"].'"></li>
                <li><label for="order_address">Адрес доставки</label><input type="text" name="order_address" placeholder="Харьков, Целиноградская 32 к228" id="order_address" value="'.$_SESSION["order_address"].'"></li>
            </ul>
             <p class="button-next"><button name="submitdata">Далее</button></p>
            </form>
           
            </div>
            ';
        break;
            
            
            
        case 'completion':
            echo'
            <div id="block-step">
            
                <div id="name-step">
                    <ul>
                        <li><a href="cart.php?action=onclick">Корзина товаров </a>/</li>
                        <li><a href="cart.php?action=confirm"> Контактная информация </a>/</li>
                        <li><a  class="active" href="cart.php?action=completion"> Завершение</a></li>
                    </ul>
                </div>
            </div>
            ';
            
            
           
                echo'
                <ul id="list-info">
                <li><strong>Способ доставки:</strong><span>'.$_SESSION['order_delivery'].'</span></li>
                <li><strong>ФИО:</strong><span>'.$_SESSION['order_fio'].'</span></li>
                <li><strong>E-mail:</strong><span>'.$_SESSION['order_email'].'</span></li>
                <li><strong>Телефон:</strong><span>'.$_SESSION['order_phone'].'</span></li>
                <li><strong>Адрес:</strong><span>'.$_SESSION['order_address'].'</span></li>
                
                </ul>
                
                ';
                
                echo'
                    <h2 class="itog-price-end">Итого: <strong>'.$itogpricecart.'</strong>руб</h2>
                    <p class="button-next-end"><button>Оплатить</button></p>

                    ';
            
            
            
            
            
        break;
            
        default:
        break;    
            
            
            
    }
        
    
    
?>    
 

 
    
        
</div>  
    
           
                 
                       
                             
                                         
   <?php
    
    include("include/block-footer.php");
    
    ?>     
       
</div>

</body>
</html>