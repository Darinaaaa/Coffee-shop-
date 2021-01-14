<?php

function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHI JKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

$login = htmlspecialchars($_POST['login']);
$email = htmlspecialchars($_POST['email']);
$pass = htmlspecialchars($_POST['password']);
$today = date("Y-m-d");  
$role = 2;
$hash = md5(generateCode(10));
$userip = "INET_ATON('".$_SERVER['REMOTE_ADDR']."')";

require_once 'connection.php'; // подключаем скрипт

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
$query ="Select * from user where login='".$login."';";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
$rows = mysqli_num_rows($result);
echo $rows;
if($rows!= 0){ 
    header('Location:registration.php');  
    echo '<script>
    alert("Этот логин уже существует;");
    </script>';
}else{
    $query1 ='INSERT INTO `taso_innodb`.`user` (`password`, `login`, `email`,`user_hash`,`user_ip`, `reg_date`, `role_id`) VALUES ( "'.$pass.'", "'.$login.'", "'.$email.'","'.$hash.'",'.$userip.',"'.$today.'", '.$role.');';
    $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
    if($result1){
        $query2 = "Select * from user where login = '".$login."';";
        $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link)); 
        $data = mysqli_fetch_row($result2);
        setcookie("id", $data['0'], time()+60*60*24*30, "/");
        setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true);  
       header('Location:/');  
    }
}
