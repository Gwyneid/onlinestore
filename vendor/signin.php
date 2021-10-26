<?php
	require_once 'connect.php';
	session_start();
	
	if(isset($_POST['submit'])){
	
	$email = mysqli_escape_string($connect, trim($_POST['email']));
	$query = "SELECT * FROM users WHERE email = '$email'";
	
	$req = mysqli_query($connect, $query);
	$user = mysqli_fetch_assoc($req);
	
	if($user['banned'] == true){
		$_SESSION['message'] = 'Вы забанены';
		header('Location: ../login.php');
	}
	else if($user['psw'] === md5($_POST['psw'])){
	
    $_SESSION['user'] = array(
        'id' => $user['id'],
        'lname' => $user['lname'],
		'fname' => $user['fname'],
        'role' => $user['role'],
		'last_ord' => $user['last_ord']
    );
	
	header('Location: ../index.php');
	}else{
		$_SESSION['message'] = 'Не верный логин или пароль';
		header('Location: ../login.php');
	}
	
	}
?>
