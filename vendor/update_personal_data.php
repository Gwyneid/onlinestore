<?php
    session_start();
	require_once 'connect.php';

    if(isset($_POST['submit'])){
		$lname = $_POST['lname'];
		$fname = $_POST['fname'];
		$id = $_SESSION['user']['id'];
	
		mysqli_query($connect,"UPDATE `users` SET `lname` = '$lname', `fname` = '$fname' WHERE `users`.`id` = '$id'");
		
		$_SESSION['user']['fname'] = $fname; 
		$_SESSION['user']['lname'] = $lname;
		
		if ( isset($_POST['change-psw']) == true ) {
		if($_POST['psw'] != $_POST['psw-repeat']){
			$_SESSION['message'] = 'Пароли не совпадают';
			header('Location: ../update_personal_data.php');
		}
		else if(mb_strlen($_POST['psw']) < 5){
			$_SESSION['message'] = 'Пароль должен быть больше 5 символов';
			header('Location: ../update_personal_data.php');
		}
		else if(mb_strlen($_POST['psw']) > 80){
			$_SESSION['message'] = 'Пароль должен быть меньше 80 символов';
			header('Location: ../update_personal_data.php');
		}
		else{
			$psw = $_POST['psw'];
			$psw= md5($psw);
			mysqli_query($connect,"UPDATE `users` SET `psw` = '$psw' WHERE `users`.`id` = '$id'");
		}
	}
		
		header('Location: ../personal_area.php');
	}
	else{
		header('Location: ../login.php');
	}


?>