<?php
error_reporting(0);
if ($_COOKIE["hash"] && $_COOKIE["id"]) {
    include 'admin_header.php';
}
require_once 'connection.php'; 

$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
     
$query1 ='SELECT * FROM `coffee`;';
 
$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
?>
<div class="mainTable" style = "margin:auto; width:max-content;">
<table>
<tr>
<th>Id</th>
<th>Name</th>
<th>Sort</th>
<th>Country</th>
<th>Date</th>
<th>Price</th>
<th>Weight</th>
<th>Producer</th>
<th>Type</th>
<th>Amount</th>
<th>Description</th>
<th>Img</th>
</tr>
<?php
    if($result1)
    {
        $rows = mysqli_num_rows($result1);
        for ($i = 0 ; $i < $rows ; ++$i){
            $row = mysqli_fetch_row($result1);
            echo "<tr style = 'border-top:2px solid grey;'>
            <td>$row[0]</td><td>$row[1]</td><td>$row[2]</td><td>$row[3]</td><td>$row[4]</td><td>$row[5]</td><td>$row[6]</td><td>$row[7]</td><td>$row[8]</td><td>$row[9]</td><td style = 'width:400px;'>$row[10]</td><td>$row[11]</td><td><button class = 'deleteItem'>delete</button></td>";
            echo "</tr>";
        }
        mysqli_free_result($result1);
    }
?>
</table>
<script>
    for (let i = 0; i < document.querySelectorAll('.deleteItem').length; i++) {
        document.querySelectorAll('.deleteItem')[i].onclick = function(){
            let delrow = document.querySelectorAll('.deleteItem')[i].parentElement.parentElement.firstElementChild.textContent;
            console.log(delrow);
            window.location.href = 'deleteItem.php?item='+delrow;
        }
    }
</script>
<h2>Add a new prod</h2>
<form action="addNew.php" method = "POST">
    <span style = "color:grey;font-size: 12px;">*You can`t write '</span>
    <label for="name">Name:</label>
    <input type="text" name = "name">
    <label for="sort">Sort:</label>
    <input type="text" name = "sort">
    <label for="country">Country:</label>
    <input type="text" name = "country">
    <label for="date">Date:</label>
    <input type="date" name = "date">
    <label for="price">Price:</label>
    <input type="number" name = "price">
    <label for="weight">Weight:</label>
    <input type="number" name = "weight">
    <label for="producer">Producer:</label>
    <input type="text" name = "producer">
    <label for="type">Type:</label>
    <input type="number" name = "type">
    <label for="amount">Amount:</label>
    <input type="number" name = "amount">
    <label for="description">Description:</label>
    <input type="text" name = "description">
    <label for="img">Image:</label>
    <input type="text" name = "img">
    <span style = "color:grey;font-size: 12px;">*Path must be like: folder/imagename.format</span>
    <button type = "submit">Add new</button>
</form>
</div>
<?php 
include 'footer.php';
?>