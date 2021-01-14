<?php
//error_reporting(0);
require 'connection.php'; 
$link1 = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
if (isset($_COOKIE["hash"]) && isset($_COOKIE["id"])) {
   $query ='SELECT * FROM `user` where id = '.$_COOKIE["id"].';';
   $result = mysqli_query($link1, $query) or die("Ошибка " . mysqli_error($link1)); 
   $row1 = mysqli_fetch_row($result);
   if($row1[7] == 1){
       header('Location: admin_page.php');
   }else{
        include 'logedHeader.php';
   }
}else{
    include 'header.php';
}
$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
$query1 ='SELECT * FROM `coffee`;';
$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
?>
<script>
    function AddToCard(id){
        if(!sessionStorage.getItem('prods')){
            let prods = [];
            prods.push(id);
            sessionStorage.setItem('prods', prods);
            document.cookie = "prods="+prods;
        }else{
            let prods = [];
            prods.push(sessionStorage.getItem('prods').split(','));
            prods.push(id);
            document.cookie = "prods="+prods;
            console.log(prods);
            sessionStorage.setItem('prods', prods);
        }
    }
</script>
<div class="mainTable">
<div class = 'allCommentsBlock'>
<?php foreach($result1 as $row):?>
        <div class = 'catBlock' id = "<?=$row['id']?>">
            <a href = 'card.php?idCof=<?=$row['id']?>'>
                <img  class = 'catalogImg' src = '<?=$row['Img']?>'>
                <div style = 'display:flex; flex-direction:column; width:max-content; justify-content:space-between;'>
                <p class = 'coName'><?=$row['Name']?></p>
                <p class = 'cofPrice'><b>₴</b><?=$row['Price']?></p>
            </div></a>
            <button class = 'toShopCard' onclick ="AddToCard(<?=$row['id']?>)">To shoppingcard</button>
        </div>
<?php endforeach;?>
</div>
<?
    mysqli_free_result($result1);
mysqli_close($link);
?>
    </div>

<?php 
include 'footer.php';
?>