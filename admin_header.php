<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <?php
           require_once 'connection.php'; 
           $link1 = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
           if ($_COOKIE["hash"] && $_COOKIE["id"]) {
              $query ='SELECT * FROM `user` where id = '.$_COOKIE["id"].';';
              $result = mysqli_query($link1, $query) or die("Ошибка " . mysqli_error($link1)); 
              $row1 = mysqli_fetch_row($result);
              if($row1[7] != 1){
                header('Location: /');
              }
           }
        ?>
        <div style = "display:flex; height:100%;padding-left:50px;">
            <a href = "add_new_prod.php"><div class="btn-group">Add new position</div></a>
            <a href = "all_orders.php"><div class="btn-group">All orders</div></a>
            <a href = "new_req.php"><div class="btn-group">New requests</div></a>
            <a href="logout.php"><div class = "reg btn-group" style = "margin-right:15px">Logout</div></a>
        </div>
    </header>