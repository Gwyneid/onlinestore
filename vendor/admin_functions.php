<?php
    require_once 'connect.php';
	require_once 'functions.php';
	session_start();
	
	
	// сделать модератором или отнять модерку
	
	if( isset($_POST['user_id']) ){
		$id = $_POST['user_id'];
		$resp = rights(2);
		
		if($resp == "have_rights"){
			$res = user_rights($id);
			echo $res;
		}
		else{
			echo $resp;
		}
	}
	
	//удалить пользователя
	
	if( isset($_POST['delate_id']) ){
		$resp = rights(1);
		
		if($resp == "have_rights"){
			$id = $_POST['delate_id'];
			$sql_delete = "DELETE FROM users WHERE id = $id "; 
			$res = mysqli_query($connect, $sql_delete);
			echo $resp;
		}
		else{
			echo $resp;
		}
	}
	
	
	//забанить пользователя
	if( isset($_POST['ban_id']) ){
		$resp = rights(2);
		
		if($resp == "have_rights"){
			$id = $_POST['ban_id'];
			$banned = get_banned_by_id($id);
			if($banned['banned'] == 0){
				$res = mysqli_query($connect,"UPDATE `users` SET `banned` = '1' WHERE `users`.`id` = '$id'");
			}
			else{
				$res = mysqli_query($connect,"UPDATE `users` SET `banned` = '0' WHERE `users`.`id` = '$id'");
			}
			echo $resp;
		}
		else{
			echo $resp;
		}
	}
	
	
	
	
?>