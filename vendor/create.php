<?php
    require_once 'connect.php';
	require_once 'functions.php';
	
	$right = rights(1);
	if($right == "have_rights"){
		$title = $_POST['title'];
	    $price = $_POST['price'];
		$category_name = $_POST['category'];
	
		$path = 'uploads/' . $_FILES['image']['name'];
		move_uploaded_file($_FILES['image']['tmp_name'],'../' . $path);
	
		mysqli_query($connect,"INSERT INTO `goods` (`id`,`cat_id`,`name`,`price`,`image`) VALUES (NULL, '$category_name', '$title', '$price', '$path')");
		header('Location: ../admin_add_product.php');
	}
    if($right == "no_rights"){
		header('Location: ../index.php');
	}
	 if($right == "no_login"){
		header('Location: ../login.php');
	}
?>