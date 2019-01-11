<?php
if($_SERVER["REQUEST_METHOD"] == "POST")
{

include("db_connect.php");

        
$id = ($_POST["id"]);
    $id = strip_tags($id);
    $id = mysql_real_escape_string($id);
    $id= trim($id);
$result = mysql_query("SELECT * FROM cart WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cart_id_products = '$id'",$link);
if (mysql_num_rows($result) > 0)
{
$row = mysql_fetch_array($result);    
$new_count =$row["cart_count"] + 1;
$update = mysql_query ("UPDATE cart SET cart_count='$new_count' WHERE cart_ip = '{$_SERVER['REMOTE_ADDR']}' AND cart_id_products ='$id'",$link);   
}
else
{
    $result = mysql_query("SELECT * FROM table_products WHERE products_id = '$id'",$link);
    $row = mysql_fetch_array($result);
    
      mysql_query("INSERT INTO cart(cart_id_products,cart_price,cart_datetime,cart_ip)
      VALUES( 
                            '".$row['products_id']."',
                            '".$row['price']."',     
       NOW(),
                            '".$_SERVER['REMOTE_ADDR']."'                                                                        
          )",$link); 
}
}
?>