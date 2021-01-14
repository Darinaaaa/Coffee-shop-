<?php
require 'connection.php'; 
$link1 = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
if (isset($_COOKIE["hash"]) && isset($_COOKIE["id"])) {
    include 'logedHeader.php';
}else{
    header('Location:/');
}
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
$query ='SELECT `login`, `email` FROM `user` where id = '.$_COOKIE["id"].';';
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); ?>
<h1>Your page</h1>
<?php foreach($result as $row1):?>
<h3>Hello,<?=$row1['login']?></h3>
<span>This is your page where you can look through your orders and their details</span>
<h4>Email:<?=$row1['email']?></h4>
<?php endforeach; ?>
<h2>Your orders</h2>
<?php 
$query1 ='SELECT request.id, request.request_date, user_information.Name, user_information.Surname, user_information.TelNum, delivery.delivery_type, order_status.status_name from request inner join user_information on `user_information`.id = `id_inform` inner join delivery on `delivery`.id = `id_delivery` inner join order_status on `order_status`.id = `id_status` where user_information.`id_user` = '.$_COOKIE["id"].' ;';
$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); ?>
<table style = "width:max-content;">
<tr>
<th>Id</th>
<th>Date</th>
<th>Name</th>
<th>Surname</th>
<th>Prods</th>
<th>TelNum</th>
<th>Delivery</th>
<th>Status</th>
</tr>
<?php
    if($result1)
    {
        $rows = mysqli_num_rows($result1);
        for ($i = 0 ; $i < $rows ; ++$i){
            $row = mysqli_fetch_row($result1);
            echo "<tr style = 'border-top:2px solid grey;'>
            <td style = 'border-right:1px solid grey;'>$row[0]</td><td style = 'border-right:1px solid grey;'>$row[1]</td><td style = 'border-right:1px solid grey;'>$row[2]</td><td style = 'border-right:1px solid grey;'>$row[3]</td>
            <td class = 'dropdown show'><a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            Product list</a><table class='dropdown-menu' aria-labelledby='dropdownMenuLink style = 'width: 300px !important;'>";
          $query2 ="SELECT coffee.Name, goods_in_order.amount FROM coffee inner join goods_in_order on coffee.id = goods_in_order.good_id where goods_in_order.req_id = $row[0];";
          $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link)); 
          if($result2)
          {
            $rows2 = mysqli_num_rows($result2);
            for ($j = 0 ; $j < $rows2 ; $j++){
                $row2 = mysqli_fetch_row($result2);
                echo "<tr style = 'border-bottom:1px solid black;' ><td style = 'text-align:left;'>$row2[0]</td><td style = 'text-align:right;'>$row2[1]</td></tr>";
            }
        }
        echo "</table></td><td style = 'border-right:1px solid grey;'>0$row[4]</td><td style = 'border-right:1px solid grey;'>$row[5]</td><td>$row[6]</td>";
        echo '</tr>';
        ?>
    <?php
        }
        mysqli_free_result($result);
    }
?>
</table>
<?php 
include 'footer.php';
?>