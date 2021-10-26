<?php
    require_once 'connect.php';
	session_start();
	
	
	if (isset($_SESSION['user']['role'])){
	if($_SESSION['user']['role'] > 1){
		$id = $_POST['id'];
		$title = $_POST['title'];
		$price = $_POST['price'];
	
		if ($_FILES['image']['name']){
			$path = 'uploads/' . $_FILES['image']['name'];
			move_uploaded_file($_FILES['image']['tmp_name'],'../' . $path);
			mysqli_query($connect,"UPDATE `goods` SET `image` = '$path' WHERE `goods`.`id` = '$id'");
		}
	
		if ($_POST['category']){
			$cat_id = $_POST['category'];
			mysqli_query($connect,"UPDATE `goods` SET `cat_id` = '$cat_id' WHERE `goods`.`id` = '$id'");
		}
	
		mysqli_query($connect,"UPDATE `goods` SET `name` = '$title', `price` = '$price' WHERE `goods`.`id` = '$id'");
		
		header('Location: ../admin.php');
		}
		else{
			header('Location: ../index.php');
		}
	}
	else{
		header('Location: ../login.php');
	}
?>