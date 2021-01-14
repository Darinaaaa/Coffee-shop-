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
            require_once 'connection.php'; // подключаем скрипт

            $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
                
            $query1 ='SELECT * FROM `coffee_type`;';
            
            $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
        ?>

        <div style = "display:flex; height:100%;padding-left:50px;">
        <a href = "/"><div class="btn-group">Home</div></a>
        <a href="ShCard.php"><div class = "reg btn-group" style = "margin-right:15px">ShoppingCard</div></a>
            <div class="btn-group">
                <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Type</button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <?php 
                    if($result1)
                    {
                        $rows = mysqli_num_rows($result1);
                        for ($i = 0 ; $i < $rows ; ++$i){
                            $row = mysqli_fetch_row($result1);
                            echo "<a class='dropdown-item' href='CoffeeType.php?Type=$row[0]'>$row[1]</a>";
                        }
                        mysqli_free_result($result1);
                    }
                    mysqli_close($link);
                    ?>
                </div>
            </div>
            <a href="registration.php"><div class = "reg btn-group" style = "margin-right:15px">Registration</div></a>
            <a href="login.php"><div class = "reg btn-group" style = "margin-right:15px">Login</div></a>
        </div>
        
    </header>