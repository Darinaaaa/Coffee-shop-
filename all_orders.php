<?php
//error_reporting(0);
if (isset($_COOKIE["hash"]) && isset($_COOKIE["id"])) {
    if ($_COOKIE["id"] === "1" || $_COOKIE["id"] === 1) {
        include 'admin_header.php';
    }
}
require_once 'connection.php'; 
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
$query ='SELECT request.id, request.request_date, user_information.Name, user_information.Surname, user_information.TelNum, delivery.delivery_type, order_status.status_name from request inner join user_information on `user_information`.id = `id_inform` inner join delivery on `delivery`.id = `id_delivery` inner join order_status on `order_status`.id = `id_status` ;';
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
            for ($j = 0 ; $j < $rows2 ; $j++){
                $row2 = mysqli_fetch_row($result2);
                echo "<tr style = 'border-bottom:1px solid black;' ><td style = 'text-align:left;'>$row2[0]</td><td style = 'text-align:right;'>$row2[1]</td></tr>";
            }
        }
        echo "</table></td><td style = 'border-right:1px solid grey;'>0$row[4]</td><td style = 'border-right:1px solid grey;'>$row[5]</td><td>$row[6]</td><td><button class = 'editStatusButton'  id = '$row[0]'>Edit</button></td>";
        echo '</tr>';
        ?>
    <?php
        }
        mysqli_free_result($result);
    }
?>
</table>
    <form action="" class = "chooseStatus" method = "POST">
        <h6>Edit status for reqest # <span></span> </h6>
        <select class="custom-select" id="inputGroupSelect04" name = "status">
            <option selected>Choose new status</option>
            <?php 

                $query1 ='SELECT * FROM `order_status`;';
                $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
                if($result1)
                {
                    $rows1 = mysqli_num_rows($result1);
                    for ($i = 0 ; $i < $rows1 ; $i++){
                        $row1 = mysqli_fetch_row($result1);
                        echo "<option value='$row1[0]'>$row1[1]</option>";
                    }
                        mysqli_free_result($result1);
                }
                mysqli_close($link);
            ?>
        </select>
        <button type = "submit">Change status</button>
    </form>
</div>
<script>
    for (let i = 0; i < document.querySelectorAll('.editStatusButton').length; i++) {
        document.querySelectorAll('.editStatusButton')[i].onclick = function(){
            let item = document.querySelectorAll('.editStatusButton')[i].getAttribute('id');
            document.querySelector('.chooseStatus h6').style.display = "block";
            document.querySelector('.chooseStatus h6 span').innerText = item;
            document.querySelector('.chooseStatus').setAttribute('action', 'editReq.php?item='+item);
        }
    }
</script>
<?php
include 'footer.php';
?>