<?php
$itemId = $_GET['item'];

require_once 'connection.php'; 
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
$query1 ='DELETE FROM `taso_innodb`.`goods_in_order` WHERE (`req_id` = '.$itemId.');';
$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
if($result1){
$query ='DELETE FROM `taso_innodb`.`request` WHERE (`id` = '.$itemId.');';
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
}
header('Location: new_req.php')
?>