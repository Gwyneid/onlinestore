<?php
     require_once 'connect.php';
	 session_start();
	 
    if ( isset($_SESSION['cart_list']) ){
		if ( isset($_SESSION['user']['id']) ){
		$tel = $_POST['phone'];
	    $city = $_POST['city'];
		
        foreach($_SESSION['cart_list'] as $good){
			$ord .= $good['id'] . ",";
		}
		
		$ord = rtrim($ord, ",");
		
		$user_id = $_SESSION['user']['id'];
		
		mysqli_query($connect,"INSERT INTO `cart` (`id`,`user_id`,`phone`,`city`,`ord`) VALUES (NULL, '$user_id', '$tel', '$city', '$ord')");
		
		$last_ord = mysqli_insert_id($connect);
		$_SESSION['user']['last_ord'] = $last_ord;
		
		mysqli_query($connect,"UPDATE `users` SET `last_ord` = '$last_ord' WHERE `users`.`id` = '$user_id'");
		
		unset($_SESSION['cart_list']);
		header('Location: ../index.php');
		}
		else{
			header('Location: ../login.php');
		}
    }
	else{
		header('Location: ../index.php');
	}
?>