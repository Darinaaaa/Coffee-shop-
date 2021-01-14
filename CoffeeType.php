<?php
    include 'header.php';
    require_once 'connection.php';
    $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
    $query1 ='SELECT * FROM coffee inner join `coffee_type` on `coffee_type`.id =coffee.Type where `coffee_type`.id = '.$_GET["Type"];
    $result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link)); 
    ?>
        <div class="mainTable" style="">
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
      <?php  mysqli_free_result($result1);
    mysqli_close($link);

    include 'footer.php';
?>