<?php
    include 'header.php';
    require_once 'connection.php'; // подключаем скрипт

    $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
        
    $query1 ='SELECT coffee.id, `Name`,`Sort`,`Weight`,`Price`,`Country`,`Desc`,`img`, `coffee_type`.`coffee_type` FROM `coffee` inner join `coffee_type` on `coffee_type`.id =coffee.Type where coffee.id = '.$_GET["idCof"];
    
    $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
    $row = mysqli_fetch_row($result1);
    ?>
        <div class="coffeeCard">
            <?php 
                echo "<h1 class='coName'>$row[1] </h1>";
                echo "<div class = 'infContainer'>
                    <img class = 'cardImg' src = '$row[7] '>
                    <p class = 'cofSort'><b>Sort:</b>$row[2]</p>
                    <p class = 'cofType'><b>Type:</b>$row[8]</p>
                    <p class = 'cofWeight'><b>Weight:</b>$row[3]</p>
                    <p class = 'cofPrice'><b>Price:  ₴</b>$row[4]</p>
                    <p class = 'cofDesc'><b>Desc:</b>$row[6]</p>
                </div>"
            ?>
        </div>
    <?php 
    if($result1)
    {
        // $rows = mysqli_num_rows($result1);
        // echo "<div class = 'allCommentsBlock' style = ''>";
        // for ($i = 0 ; $i < $rows ; ++$i){
        //     $row = mysqli_fetch_row($result1);
        //     echo "<div class = 'commentBlock' id = '$row[0]'><img src = '$row[11]'><h2>$row[0]</h2><div style = 'display:flex; flex-direction:row; width:100%; justify-content:space-between;'><p>$row[1]</p></div>";
        //     echo "</div>";
        // }
        // echo "</div>";
        mysqli_free_result($result1);
    }
    mysqli_close($link);

    include 'footer.php';
?>