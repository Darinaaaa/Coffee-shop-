<?php
$name = htmlspecialchars($_POST['name']);
$sort = htmlspecialchars($_POST['sort']);
$country = htmlspecialchars($_POST['country']);
$date = htmlspecialchars($_POST['date']);
$price = htmlspecialchars($_POST['price']);
$weight = htmlspecialchars($_POST['weight']);
$producer = htmlspecialchars($_POST['producer']);
$type = htmlspecialchars($_POST['type']);
$amount = htmlspecialchars($_POST['amount']);
$description = htmlspecialchars($_POST['description']);
$img = htmlspecialchars($_POST['img']);
require_once 'connection.php'; 
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
$query ="INSERT INTO `taso_innodb`.`coffee` (`Name`, `Sort`, `Country`, `Date`, `Price`, `Weight`, `Producer`, `Type`, `amount`, `Desc`, `Img`) VALUES ('$name', '$sort', '$country', '$date', '$price', '$weight', '$producer', '$type', '$amount', '$description', '$img');";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
header('Location: add_new_prod.php');