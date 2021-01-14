<?php
$itemId = $_GET['item'];

require_once 'connection.php'; 
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
$query ='UPDATE `request` SET `id_status` = 2 WHERE (`id` = '.$itemId.');';
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
header('Location: new_req.php')
?>