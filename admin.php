<?php
     require_once 'vendor/connect.php';
	 require_once 'vendor/catalog.php';
	 require_once 'vendor/functions.php';
	 require_once 'vendor/page.php';
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
<div class="vertical-menu">
  <a href="#" class="active border-top" >Таблица товаров</a>
  <a href="users_table.php">Таблица пользователей</a>
  <a href="admin_add_product.php">Добавить новый товар</a>
</div>
<table class="table">
        <tr>
		    <th class = "corneer__left">Картинка</th>
		    <th>id</th>
		    <th>Категория</th>
			<th>Цена</th>
			<th>Название</th>
			<th class = "corneer__right"></th>
        </tr>
		<?php
		     $products = mysqli_query($connect,"SELECT * FROM `goods`");
		     $products = mysqli_fetch_all($products);
			 $numbers = count($products);
			 $finish_goods = finish_goods($start_goods, $numbers);
			for($i = $start_goods; $i < $finish_goods ; $i++){
				 $category = get_category_by_id($products[$i][1]);
				 ?>
				 <tr>
				 <td><img src="<?= $products[$i][4] ?>" class="img-table"></td>
				 <td><?= $products[$i][0] ?></td>
		         <td><?= $category['title']?></td>
			     <td><?= $products[$i][3] ?></td>
			     <td><?= $products[$i][2] ?></td>
				 <td><a class="dodgerblue" href="admin_update_product.php?id=<?= $products[$i][0]?>">изменить</a></td>
		         </tr>
				 <?php
			 }
		?>
    </table>
</div>
<div class = "pages">
    <div class = "page__left page-text">
	</div>
	<?php
	$numbers = number_of_pages($products);
	for($i =0; $i < $numbers; $i++){
	?>
    <a data-id = "<?= $i ?>" class="page page-text" href="admin.php?page=<?= $i ?>">
     <?= $i+1?>
	</a>
	<?php
	}
	?>
	<div class = "page__right page-text">
	</div>
</div>
<div class="grey__background">
<div id="footer">
    <p >Store&trade; <?php echo date('Y') ?></p>
</div>
</div>


	
	



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="scripts/menu_catalog.js"></script>
<script src="scripts/personal_area.js"></script>
</body>
</html>