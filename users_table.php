<?php
     require_once 'vendor/connect.php';
	 require_once 'vendor/catalog.php';
	 require_once 'vendor/functions.php';
	 require_once 'vendor/page.php';
     session_start();
	 $users = get_users();
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

<div class = "container-admin">

<div class="vertical-menu">
  <a href="admin.php" class="border-top">Таблица товаров</a>
  <a href="users_table.php" class="active">Таблица пользователей</a>
  <a href="admin_add_product.php">Добавить новый товар</a>
</div>

<div class="table">
<table>
        <tr>
		    <th class = "corneer__left">id</th>
		    <th>Почта</th>
		    <th>Имя</th>
			<th>Роль</th>
			<th class = "corneer__right"></th>
        </tr>
		<?php
		    if($_SESSION['user']['role'] == 2){
				$users = get_users_no_mod_adm();
			}
			if($_SESSION['user']['role'] == 3){
				$users = get_users_no_adm();
			}
		    $numbers = count($users);
			$finish_goods = finish_goods($start_goods, $numbers);
			for($i = $start_goods; $i < $finish_goods ; $i++){
				 ?>
				 <tr class="user_line" data-id = "<?= $users[$i]['id'] ?>">
				 <td><?= $users[$i]['id'] ?></td>
		         <td><?= $users[$i]['email'] ?></td>
			     <td><?= $users[$i]['fname'] ?></td>
			     <td class="role" data-id = "<?= $users[$i]['id'] ?>" ><?php echo get_role($users[$i]['role']) ?></td>
				 <td class = "admin_useres_table_function">
				   <?php
					if($_SESSION['user']['role'] == 3){
					?>
				    <p><a class="dodgerblue rights" data-id= "<?= $users[$i]['id'] ?>" ><?php echo action_with_user($users[$i]['role']) ?></a></p>
					<?php
					}
					?>
					<?php
					if($_SESSION['user']['role'] == 3){
					?>
					<p class = " margin_top_3"><a class="dodgerblue ban_user_button" data-id= "<?= $users[$i]['id'] ?>" ><?= banned_text($users[$i]['id']) ?></a></p>
					<?php
					}
					?>
					<p class = " margin_top_3"><a class="dodgerblue delate_user_button" data-id= "<?= $users[$i]['id'] ?>">удалить</a></p>
				 </td>
		         </tr>
				 <?php
			 }
		?>
    </table>
</div>
</div>

<div class = "pages">
    <div class = "page__left page-text">
	</div>
	<?php
	$numbers = number_of_pages($users);
	for($i =0; $i < $numbers; $i++){
	?>
    <a data-id = "<?= $i ?>" class="page page-text" href="users_table.php?id=<?= $id ?>&page=<?= $i ?>">
     <?= $i+1	?>
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
<script src="scripts/main.js"></script>
<script src="scripts/menu_catalog.js"></script>
<script src="scripts/personal_area.js"></script>
</body>
</html>