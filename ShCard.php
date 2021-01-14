<?php 
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
?>
<div style = "width:max-content; margin:auto">
    <table class = "shcard">

    </table>
    <button class ='gto'>Go To Order</button>
</div>
<script>    
        function getCookie(name) {
            let matches = document.cookie.match(new RegExp(
                "(?:^|; )" + name.replace(/([\.$?*|{}\(\)\[\]\\\/\+^])/g, '\\$1') + "=([^;]*)"
            ));
            return matches ? decodeURIComponent(matches[1]) : undefined;
        }
        function unique(arr) {
            let result = [];
            for (let str of arr) {
                if (!result.includes(str)) {
                result.push(str);
                }
            }
            return result;
        }
        function updateShCard(){
            let arr = getCookie('prods').split(',');
            arr.sort(function(a, b) {
            return a - b;
            });
            let arr1 = unique(arr);
            console.log(arr1);
            <?php 
            $prods = $_COOKIE['prods'];
            $prod = explode(',', $prods);
            $res = array_unique($prod);
            $str = implode(",", $res);
            $link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link)); 
            $query2 ='SELECT * FROM coffee WHERE `id` in ('.$str.');';
            $result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link)); 
            $rows3 = mysqli_num_rows($result2);
            ?>
            while (document.querySelector('.shcard').firstChild) {
                document.querySelector('.shcard').removeChild(document.querySelector('.shcard').firstChild);
            }
            let amount = [];
            <?php for($i=0; $i < $rows3; $i++) { ?>
               <?php $row3 = mysqli_fetch_row($result2); ?>
                    let row<?=$i?> = document.createElement('tr');
                    let name<?=$i?>= document.createElement('td');
                    let count<?=$i?> = document.createElement('td');
                    let imgTd<?=$i?> = document.createElement('td');
                    let img<?=$i?> = document.createElement('img');
                    img<?=$i?>.setAttribute('src', '<?=$row3[11]?>');
                    img<?=$i?>.setAttribute('height', '100');
                    imgTd<?=$i?>.appendChild(img<?=$i?>);
                    count<?=$i?>.className = "addCol";
                    count<?=$i?>.style.marginRight = '0px';
                    name<?=$i?>.textContent = "<?=$row3[1]?>";
                    row<?=$i?>.appendChild(name<?=$i?>);
                    let k<?=$i?> = 0;
                    for (let m = 0; m < arr.length; m++) {
                        if (arr[m] == arr1[<?=$i?>]) {
                            k<?=$i?>++;
                        }
                    }
                    let am<?=$i?> = document.createElement('p');
                    am<?=$i?>.className = "amount";
                    let plus<?=$i?> = document.createElement('button');
                    plus<?=$i?>.className = 'plus<?=$row3[0]?>';
                    plus<?=$i?>.setAttribute('onclick', 'plusItem(<?=$row3[0]?>)');
                    let minuse<?=$i?> = document.createElement('button');
                    minuse<?=$i?>.setAttribute('onclick', 'minusItem(<?=$row3[0]?>)');
                    minuse<?=$i?>.className = 'minuse<?=$row3[0]?>';
                    plus<?=$i?>.textContent = '+';
                    minuse<?=$i?>.textContent = '-';
                    am<?=$i?>.textContent = k<?=$i?>;
                    count<?=$i?>.appendChild(minuse<?=$i?>);
                    count<?=$i?>.appendChild(am<?=$i?>);
                    count<?=$i?>.appendChild(plus<?=$i?>);
                    count<?=$i?>.style.display = "inline-flex";
                    row<?=$i?>.appendChild(count<?=$i?>);
                    row<?=$i?>.appendChild(imgTd<?=$i?>);
                    document.querySelector('.shcard').appendChild(row<?=$i?>);
                    amount.push(k<?=$i?>);
            <?php } ?>
            if(amount.indexOf('0') == 1){
                amount.splice(amount.indexOf('0'), 1);
            }
            sessionStorage.setItem('amount', amount);
            document.cookie = "amount="+amount;
        }
        updateShCard();
        function minusItem(elem){
            let arr = getCookie('prods').split(',');
            arr.sort(function(a, b) {
                return a - b;
            });
            console.log(arr);
            let arr1 = arr.map(function(el){
                return +el;
            })
            console.log(arr1);
            let amount = [];
            let prItem = +document.querySelector('.minuse'+elem).nextElementSibling.textContent;
            document.querySelector('.minuse'+elem).nextElementSibling.textContent = prItem -1;
            arr1.splice(arr1.indexOf(elem), 1);
            document.querySelectorAll('.amount').forEach(element => amount.push(element.textContent));
            console.log(amount);
            console.log(arr1);
            if(amount.indexOf('0') == 1){
                amount.splice(amount.indexOf('0'), 1);
            }
            console.log(amount);
            sessionStorage.clear();
            sessionStorage.setItem('prods', arr1);
            document.cookie = "prods="+arr1;
            sessionStorage.setItem('amount', amount);
            document.cookie = "amount="+amount;
            if (document.querySelector('.minuse'+elem).nextElementSibling.textContent == 0) {
                document.querySelector('.minuse'+elem).parentElement.parentElement.remove();
            }
        }
        function plusItem(elem){
            let arr = getCookie('prods').split(',');
            arr.sort(function(a, b) {
                return a - b;
            });
            console.log(arr);
            let arr1 = arr.map(function(el){
                return +el;
            });
            console.log(arr1);
            let amount = [];
            let prItem = +document.querySelector('.plus'+elem).previousElementSibling.textContent;
            document.querySelector('.plus'+elem).previousElementSibling.textContent = prItem +1;
            arr1.push(elem);
            document.querySelectorAll('.amount').forEach(element => amount.push(element.textContent));
            sessionStorage.clear();
            sessionStorage.setItem('prods', arr1);
            document.cookie = "prods="+arr1;
            sessionStorage.setItem('amount', amount);
            document.cookie = "amount="+amount;
        }
    </script>
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
        document.querySelector('.gto').onclick = function(){
            let amount = [];
            for (let i = 0; i < document.querySelectorAll('.amount').length; i++) {
                amount.push(document.querySelectorAll('.amount')[i].textContent);
            }
            window.location.href = 'gotoorder.php?prods='+unique(sessionStorage.getItem('prods').split(','))+'&amount='+amount;
            document.cookie = 'prods='+sessionStorage.getItem('prods');
            document.cookie = "amount="+sessionStorage.getItem('amount');
        }
    </script>
<?php
include 'footer.php';
?>