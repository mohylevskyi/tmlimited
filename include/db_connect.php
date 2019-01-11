<?php
$db_host          ='mysql.zzz.com.ua';
$db_user          ='tmlimited';
$db_pass          ='ZhenyaGrave0804';
$db_database      ='zhekagravez';

$link = mysql_connect($db_host, $db_user, $db_pass);

mysql_select_db($db_database, $link) or die("Нет соединения с БД ".mysql_error());
mysql_query("SET names UTF-8");
?>