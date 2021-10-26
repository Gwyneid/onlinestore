<?php
     require_once 'vendor/connect.php';
	 require_once 'vendor/catalog.php';
	 require_once 'vendor/functions.php';
     session_start();
	 $good = get_good_by_id($_GET['id']);
	 $category_ = get_category_by_id($good['cat_id']);
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
							<div class="catalog__subcatalog">
							<?php
								foreach($categories as $subcategory){
								if($category['id'] == $subcategory['parent']){
						    ?>
								<a href="index.php?id=<?= $subcategory['id']?>" class="catalog__subcatalog-link"><?=$subcategory['title']?></a>
							<?php
									}
								}
							?>		
							</div>
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
<div class="vertical-menu">
  <a href="admin.php" class="border-top">Таблица товаров</a>
  <a href="userse_table.php">Таблица пользователей</a>
  <a href="#" class="active">Добавить новый товар</a>
</div>
<div class = "add_product">
        <form action = "vendor/update.php" method="post" enctype="multipart/form-data">
            <div class="add_product_container">
			
                <input type="hidden" name="id" value="<?= $good['id'] ?>">
				
                <label for="email"><b class="add_product_point">Название</b></label>
                <input type="text" name="title" value="<?= $good['name'] ?>"  placeholder="Название товара" required class="add_product_text">

                <label for="psw"><b class="add_product_point">Цена</b></label>
                <input type="number" placeholder="Цена товара" name="price" value="<?= $good['price'] ?>" required class="add_product_text">
				
				<label for="psw"><b class="add_product_point">Категория</b></label>
				<select  name="category"   required class="add_product_text">
				<option value="<?= $good['cat_id'] ?>" selected disabled hidden><?= $category_['title'] ?></option>
				<?php 
				    $catigories = get_categories();
					foreach($catigories as $category){
				?>
                    <option value="<?php echo $category['id'] ?>"><?php echo $category['title'] ?></option>
					 <?php
					}
			   ?>
               </select>
			   
			   <label for="psw"><b class="add_product_point">Изображение</b></label>
	           <input type="file" name="image" src="<?= $good['image'] ?>" class="add_product_text" >
				
                <hr class="registration__line">
               <button type="submit" class="registerbtn" >Изменить</button>
	</div>
	</form>
	</div>
</div>
<div class="grey__background">
<div id="footer">
    <p >Ponyshop&trade; <?php echo date('Y') ?></p>
</div>
</div>




	
	



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="scripts/menu_catalog.js"></script>
<script src="scripts/main.js"></script>
<script src="scripts/personal_area.js"></script>
</body>
</html>