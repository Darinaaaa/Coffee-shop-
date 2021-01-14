<?php
session_start();
error_reporting(0);
if ($_COOKIE["hash"] && $_COOKIE["id"]) {
    include 'logedHeader.php';
}else{
    include 'header.php';
}
?>
<script>sessionStorage.clear();</script>
<div style = "display:flex; width:max-content; margin:auto; margin-top:10%;">
<img src="./img/ok-concept-illustration_114360-2060.jpg" alt="" width = "400">
<h1 style="height: max-content;margin-top: 20%; color: #88C6BE;">Thanks for order</h1>
</div>

<?php 
include 'footer.php';
?>
