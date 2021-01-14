<?php 
$rowId = $_GET['item'];
require_once 'connection.php'; // подключаем скрипт

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
$query ="DELETE FROM `taso_innodb`.`coffee` WHERE (`id` = $rowId);";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
header('Location:add_new_prod.php');