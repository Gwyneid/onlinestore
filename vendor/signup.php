<?php
    session_start();
	require_once 'connect.php';
	
	if(isset($_POST['submit'])){
		$email = $_POST['email'];
		$fname= $_POST['fname'];
		$lname= $_POST['lname'];
		$psw= $_POST['psw'];
		$pswrepeat= $_POST['psw-repeat'];
		$role = 1;
		$banned = 0;
	
		if($psw != $pswrepeat){
			$_SESSION['message'] = 'Пароли не совпадают';
			header('Location: ../registration.php');
		}
		else if(mb_strlen($psw) < 5){
			$_SESSION['message'] = 'Пароль должен быть больше 5 символов';
			header('Location: ../registration.php');
		}
		else if(mb_strlen($psw) > 80){
			$_SESSION['message'] = 'Пароль должен быть меньше 80 символов';
			header('Location: ../registration.php');
		}
		else if(mb_strlen($fname) > 80 || mb_strlen($lname) > 80 || mb_strlen($fname) == 1 || mb_strlen($lname) == 1){
			$_SESSION['message'] = 'Недопустимая длинна имени или фамилии';
			header('Location: ../registration.php');
		}
		else{
			$psw= md5($psw);
			mysqli_query($connect, "INSERT INTO `users` (`id`, `email`, `fname`, `lname`, `psw`, `role`, `banned`) VALUES (NULL, '$email', '$fname', '$lname', '$psw', '$role', '$banned')");
			$_SESSION['message'] = 'Регистрация прошла успешно!';
			header('Location: ../login.php');
		}
	}
	
?>