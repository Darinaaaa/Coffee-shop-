<?php
$name = $_POST['name'];
$surname = $_POST['surname'];
$town = $_POST['town'];
$address = $_POST['address'];
$phone = $_POST['phone'];
$coffees = explode(',', $_GET['prods']);
$amount = explode(',', $_GET['am']);
$delivery = $_POST['delivery'];
$today = date("Y-m-d H:i:s");
if ($_POST['comment'] != null) {
    $comment ='"'.$_POST['comment'].'"';
}else{
    $comment = 'no comment';
}
if (isset($_COOKIE["hash"]) && isset($_COOKIE["id"])) {
    $user_id = $_COOKIE["id"];
}else{
    $user_id = '22';
}
require_once 'connection.php'; 
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
$query0 = "SELECT EXISTS(SELECT id FROM user_information WHERE user_information.`Name` = '$name' and user_information.`Surname` = '$surname' and user_information.`Telnum` = '$phone');";
$result0 = mysqli_query($link, $query0) or die("Ошибка " . mysqli_error($link)); 
$row0 = mysqli_fetch_row($result0);
if ($row0[0] == 0){
    $query ="INSERT INTO `user_information` (`Name`, `Surname`, `Town`, `bday`, `address`, `TelNum`, `id_user`) VALUES ('$name', '$surname', '$town', ' ', '$address', '$phone', '$user_id');";
    $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
}
$query1 = "Select id from user_information where user_information.`Name` = '$name' and user_information.`Surname` = '$surname' and user_information.`Telnum` = '$phone';";
$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link));                
$row = mysqli_fetch_row($result1);
echo $row[0];
$query2 = "INSERT INTO `request` (`id_inform`, `id_delivery`, `request_date`, `request_comment`, `id_status`) VALUES ( '$row[0]', '$delivery', '$today', '$comment', '1');";
$result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));    
$query3 = "SELECT id FROM request where id_inform = $row[0] ORDER BY id DESC LIMIT 1 ;";
$result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));
$row3 = mysqli_fetch_row($result3);
for ($i=0; $i < count($coffees); $i++) { 
    $query4 = "INSERT INTO `goods_in_order` (`req_id`, `good_id`, `amount`) VALUES ('$row3[0]', '$coffees[$i]', '$amount[$i]');";
    $result4 = mysqli_query($link, $query4) or die("Ошибка " . mysqli_error($link));
}
header('Location: thanks.php'); 