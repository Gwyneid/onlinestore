<?php
    session_start();
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta name="viewport" content="width=device-width">
</head>
<body >
<div class="login-center">
    <div style = 'margin:auto;'> 
        <form action = "vendor/signin.php" method="post">
            <div class="registration__container ">
                 <h1>Авторизация</h1>
                 <hr class="registration__line">

                <label for="email"><b class="registration__point">Email</b></label>
                <input type="text" placeholder="Введите Email" name="email" required class="registration__text">

                <label for="psw"><b class="registration__point">Пароль</b></label>
                <input type="password" placeholder="Введите пароль" name="psw" required class="registration__text">
				
                <hr class="registration__line">
               <button type="submit" class="registerbtn" name="submit">Войти</button>
            <div class="registration__container signin">
                    <p>Нет аккаунта? <a href="registration.php" class= "dodgerblue">Зарегистрироваться</a></p>
            </div>
   <?php
        if ($_SESSION['message']) {
            echo '<p class="msg"> ' . $_SESSION['message'] . ' </p>';
        }
        unset($_SESSION['message']);
    ?>
	</div>
	</form>
	</div>
</div>

</body>
</html>



