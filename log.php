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
$pass = htmlspecialchars($_POST['password']);
$hash = md5(generateCode(10));
$userip = "INET_ATON('".$_SERVER['REMOTE_ADDR']."')";

require_once 'connection.php'; // подключаем скрипт

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
$query ="Select * from user where login='".$login."';";
 
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
$rows = mysqli_num_rows($result);
//echo $rows;
if($rows != 0){ 
    $data = mysqli_fetch_row($result);
    if($data[1] === $pass){
        if ($data[7] == 1) {
            mysqli_query($link, 'UPDATE user SET `user_hash` = "'.$hash.'", `user_ip` = '.$userip.' WHERE id='.$data[0].';');
            setcookie("id", $data['0'], time()+60*60*24*30, "/");
            setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true);  
            header('Location: admin_page.php');
        }else{
            mysqli_query($link, 'UPDATE user SET `user_hash` = "'.$hash.'", `user_ip` = '.$userip.' WHERE id='.$data[0].';');
            setcookie("id", $data['0'], time()+60*60*24*30, "/");
            setcookie("hash", $hash, time()+60*60*24*30, "/", null, null, true);
            header('Location: / ');  
        }
    }else{
        header('Location:login.php?err=uncorrectuser');  
    }
}