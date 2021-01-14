<?php
include 'header.php'; 
if (isset($_GET['err'])) {
    if ($_GET['err'] == "uncorrectuser") {
        echo '<script>
            alert("Oops... You made a mistake in yiur data. Please, repeate your entry");
        </script>';
    }
}
?>
<h1 class = "log">Log in</h1>
<div style = "width:max-content; margin:auto;">
    <form method = "POST" action = "log.php">
        <input type="text" name = "login" minlength="5" pattern = "[A-Za-zА-Яа-яЁё]{1-60}" placeholder = "Login" required>
        <span class="form__error">Это поле должно содержать Ваше полное имя не меньше 5 символов</span>
        <input type="pass" name = "password" placeholder = "Password" required>
        <button type="submit" name = "submit">Send</button>
    </form>
    <span>You have no your page? Please, <a href="registration.php">Click here</a> to registrate now</span>
</div>
<?php 

include 'footer.php';
?>