<?php
$itemId = $_GET['item'];
$status = $_POST['status'];

require_once 'connection.php'; 
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
$query ='UPDATE `request` SET `id_status` = '.$status.' WHERE (`id` = '.$itemId.');';
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
header('Location: all_orders.php')
?>