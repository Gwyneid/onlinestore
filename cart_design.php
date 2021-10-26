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
        <form action = "vendor/ordering.php" method="post">
            <div class="registration__container ">
                 <h1>Уточнение заказа</h1>
                 <hr class="registration__line">

                <label for="tel"><b class="registration__point">Телефон</b></label>
                <input type="tel" placeholder="Введите телефон" name="phone"  required class="registration__text">

                <label><b class="registration__point">Город</b></label>
                <input placeholder="Укажите город" name="city" required class="registration__text">
				
                <hr class="registration__line">
               <button type="submit" class="registerbtn" >Оформить</button>
			   <div class="registration__container signin">
                     <p>Если данные введены коректно, с вами свяжутся</p>
               </div>
	</div>
	</form>
	</div>
</div>

</body>
</html>



