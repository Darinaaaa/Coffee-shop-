<?php
error_reporting(0);
if ($_COOKIE["hash"] && $_COOKIE["id"]) {
    if ($_COOKIE["id"] === "1" || $_COOKIE["id"] === 1) {
        include 'admin_header.php';
    }
}
require_once 'connection.php'; 
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
$query ='SELECT request.id, request.request_date, user_information.Name, user_information.Surname, user_information.TelNum, delivery.delivery_type, order_status.status_name from request inner join user_information on `user_information`.id = `id_inform` inner join delivery on `delivery`.id = `id_delivery` inner join order_status on `order_status`.id = `id_status` where request.id_status = 1 ;';
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
?>
<div class="mainTable" style = "display:flex; justify-content:space-around;">
<table style = "width:max-content;">
<tr>
<th>Id</th>
<th>Date</th>
<th>Name</th>
<th>Surname</th>
<th>TelNum</th>
<th>Delivery</th>
<th>Status</th>
</tr>
<?php
    if($result)
    {
        $rows = mysqli_num_rows($result);
        for ($i = 0 ; $i < $rows ; ++$i){
            $row = mysqli_fetch_row($result);
            echo "<tr style = 'border-top:2px solid grey;'>
            <td style = 'border-right:1px solid grey;'>$row[0]</td><td style = 'border-right:1px solid grey;'>$row[1]</td><td style = 'border-right:1px solid grey;'>$row[2]</td><td style = 'border-right:1px solid grey;'>$row[3]</td>
            <td class = 'dropdown show'><a class='btn btn-secondary dropdown-toggle' href='#' role='button' id='dropdownMenuLink' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
            Product list</a><table class='dropdown-menu' aria-labelledby='dropdownMenuLink style = 'width: 300px !important;'>";
            $query2 ="SELECT coffee.Name, goods_in_order.amount FROM coffee inner join goods_in_order on coffee.id = goods_in_order.good_id where goods_in_order.req_id = $row[0];";
            $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link)); 
            if($result2)
            {
                $rows2 = mysqli_num_rows($result2);
                for ($j = 0 ; $j < $rows ; $j++){
                    $row2 = mysqli_fetch_row($result2);
                    echo "<tr'><td style = 'text-align:left;'>$row2[0]</td><td style = 'text-align:right;'>$row2[1]</td></tr>";
                }
            }
            echo " </table></td><td style = 'border-right:1px solid grey;'>0$row[4]</td><td style = 'border-right:1px solid grey;'>$row[5]</td><td>$row[6]</td><td style = 'border:1px solid black;'><a href = 'apply_req.php?item=$row[0]' class = 'applyReq'>Apply</a></td><td style = 'border:1px solid black;'><a href = 'delete_req.php?item=$row[0]' class = ''>Delete</a></td>";
            echo '</tr>';
        }
        mysqli_free_result($result);
    }
?>
</table>
</div>
<?php
include 'footer.php';
?>