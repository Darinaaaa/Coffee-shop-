<?php
error_reporting(0);
if ($_COOKIE["hash"] && $_COOKIE["id"]) {
    include 'logedHeader.php';
}else{
    include 'header.php';
}
require_once 'connection.php'; 
?>

<h1 class="order" style = "text-align:center;">Your order</h1>

<div class="itemlist">
    <table style = "width:max-content; margin:auto;margin-bottom:30px;margin-top:30px;">
    <tr style = "">
    <th>Product name</th>
    <th>Amount</th>
    </tr>
        <?php 
            $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
            $prods = $_GET['prods'];
            $amount = $_GET['amount'];
            $prod = explode(',', $prods);
            $res = array_unique($prod);
            $col = explode(',', $amount);
            //echo count($res);
            //echo count($prod);
            for ($i=0; $i < count($res); $i++) {    
                echo '<tr style = "border-top:1px solid black;">';
                $query ='SELECT * FROM `coffee` where id = '.$res[$i].';';
                //echo $query;
                $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link)); 
                $row = mysqli_fetch_row($result);
                echo "<td style = 'padding-right:100px'>".$row[1]."</td><td style = 'border-left:1px solid black;text-align: center;' class = 'eachAmount'>".$col[$i]."</td>";
                echo '</tr>';
            }
            //echo gettype($prod); 
        ?>
    </table>
</div>
<form method = "POST">
    <input type="text" name = 'name' placeholder = 'Name' >
    <input type="text" name = 'surname' placeholder = 'Surname' >
    <input type="text" name = 'town' placeholder = 'Town' >
    <input type="text" name = 'address' placeholder = 'Address'>
    <input type="tel" name = 'phone' placeholder = 'Tel Num' >
    <select class="custom-select" id="inputGroupSelect04" name = "delivery">
        <option selected>Choose your delivery type</option>
        <?php 
            $query1 ='SELECT * FROM `delivery`;';
            $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
            if($result1)
            {
                $rows = mysqli_num_rows($result1);
                for ($i = 0 ; $i < $rows ; ++$i){
                    $row = mysqli_fetch_row($result1);
                    echo "<option value='$row[0]'>$row[1]</option>";
                }
                    mysqli_free_result($result1);
            }
             mysqli_close($link);
        ?>
    </select>
        <input type="text" name = "comment" placeholder = 'Comment'>


 
    <button type = "submit" class = "makereq">Send</button>
    <script>
    function unique(arr) {
        let result = [];
        for (let str of arr) {
            if (!result.includes(str)) {
            result.push(str);
            }
        }
        return result;
    }
    let eachamount = [];
    for (let i = 0; i < document.querySelectorAll('.eachAmount').length; i++) {
        eachamount.push(document.querySelectorAll('.eachAmount')[i].textContent);
    }
    document.querySelector('.makereq').onclick = function(){
        document.querySelector('form').setAttribute('action', 'makerequest.php?prods='+unique(sessionStorage.getItem('prods').split(','))+'&am='+eachamount);
    }
    </script>
</form>
<?php 
include 'footer.php';
?>