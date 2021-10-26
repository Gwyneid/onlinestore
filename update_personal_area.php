<?php
     require_once 'vendor/connect.php';
	 require_once 'vendor/catalog.php';
	 require_once 'vendor/functions.php';
     session_start();
?>
<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>Store</title>
    <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<meta name="viewport" content="width=device-width">
</head>
<body>	
	<header class="header">
		<div class="container align-items_center">
			<a href="index.php" class="logo" title="logo">
				<img src="img/logo.png" class = "img_logo" alt="Logo">
			</a>
			<div class="header-right">
				<form class="search-form">
					<input type="text" name="id" value="" placeholder="Поиск" class="search search-input">
					<button><i class="fa fa-search search-i"></i></button>
				</form>
				<div class = "block">
				<div class = "subblock">
				<div class="cart-informer" >
					<button class="cart-informer__button" >
						<span class="cart-informer__count" id="cart_count"><?php echo get_cart_count()?></span>
						<span class="cart-informer__icon"><i class="fa fa-shopping-cart cart-informer__icon-i"></i></span>
						<span class="cart-informer__value" id="cart_cost"><?php echo get_cart_cost() ?></span>
					</button>
				</div>
				<?php 
				    if($_SESSION['user']['id'] == ''):
				?>
				<div class="login">
				    <button class="button-login" onclick="window.location.href='login.php'">
					    Вход
					</button>
				</div>
				<?php else:?>
                 <div class="dropdown">
                <button class="dropbtn" onclick="myFunction()"> личный кабинет
                     <i class="fa fa-caret-down"></i>
                </button>
                <div class="dropdown-content" id="myDropdown">
                    <a href="vendor/addres.php">Перейти</a>
                    <a href="vendor/exit.php">Выход</a>
                    </div>
                </div> 	
                <?php endif;?>					
		</div>
		</div>
	</header>
	 
	<div class="menu">
		<div class="container">
			<div class="catalog">
				<div class="catalog__wrapper" id = "catalog">
					<div class="catalog__header "><span>Категории</span><i class="fa fa-bars catalog__header-icon"></i></div>
					<ul class="catalog__list">
					<?php
				    foreach($categories as $category){
					?>
						<li class="catalog__item">
						<?php
						    if($category['parent'] == 0){
						?>
							<a href="index.php?id=<?= $category['id']?>" class="catalog__link">
								<?=$category['title']?>
							</a>
							<?php
						    foreach($categories as $subcategory){
						    if($category['id'] == $subcategory['parent']){
						    ?>
							<div class="catalog__subcatalog">
								<a href="index.php?id=<?= $subcategory['id']?>" class="catalog__subcatalog-link"><?=$subcategory['title']?></a>
							</div>
							<?php
							    }
							}
                        ?>		
							<?php
							}
						?>					
						</li>
                   <?php
				   }
                   ?>				   
					</ul>
				</div>
			</div>	
            <a class="menu__border"></a>				
		</div>
	</div>
	<div class = "container">
	<div class="vertical-menu verticlal-menu_personal_area">
	    <div class="personal_area_name"><?= $_SESSION['user']['lname'] . " " . $_SESSION['user']['fname'] ?></div>
		<a href="personal_area.php" class="border-top" >Последний заказ</a>
		<a href="news.php" class="border-bottom  active">Изменить данные</a>
	</div>
	<div class = "add_product">
        <form action = "vendor/update_personal_data.php" method="post" enctype="multipart/form-data">
            <div class="add_product_container">
			
                <input type="hidden" name="id" value="<?= $_SESSION['user']['id'] ?>">
				
                <label for="fname"><b class="registration__point">Имя</b></label>
				<input type="text" placeholder="Введите имя" value="<?= $_SESSION['user']['fname']?>" name="fname" required class="registration__text">
	
				<label for="lname"><b class="registration__point">Фамилия</b></label>
				<input type="text" placeholder="Введите фамилию" name="lname" value="<?= $_SESSION['user']['lname']?>" required class="registration__text">
				
				<label for="psw"><b class="registration__point">Пароль</b></label>
				<input type="password" placeholder="Введите пароль" name="psw" class="registration__text">

				<label for="psw-repeat"><b class="registration__point">Повторите пароль</b></label>
				<input type="password" placeholder="Повторите пароль" name="psw-repeat" class="registration__text">
				
				<input type="checkbox"  name="change-psw"><label >Изменить пароль</label>
				
                <hr class="registration__line">
				<button type="submit" class = "registerbtn" name = "submit">Изменить</button>
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
	

</div>
<div class="grey__background">
<div id="footer">
    <p >Store&trade; <?php echo date('Y') ?></p>
</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="scripts/menu_catalog.js"></script>
<script src="scripts/main.js"></script>
<script src="scripts/personal_area.js"></script>
</body>
</html>