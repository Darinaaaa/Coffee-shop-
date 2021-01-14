<?php
include 'header.php'; ?>
<h1 class = "reg">Registration</h1>
<div style = "width:max-content; margin:auto;">
    <form class = "regForm"method = "POST" action = "reg.php">
        <input type="text" name = "login" minlength="5" pattern = "[A-Za-zА-Яа-яЁё]{1-60}" placeholder = "Login" required>
        <span class="form__error">Это поле должно содержать Ваше полное имя не меньше 5 символов</span>
        <input type="email" name = "email" placeholder = "E-mail" required>
        <span class="form__error">Это поле должно содержать E-Mail в формате example@site.com</span>
        <input type="pass" name = "password" placeholder = "Password" required>
        <button type="submit" name = "submit">Send</button>
    </form>
    <span>You have your own page? Please, <a href="login.php">Click here</a> to log in now</span>
</div>
<?php 

include 'footer.php';
?>