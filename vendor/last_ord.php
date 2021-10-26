<?php
	require_once 'connect.php';
    session_start();
	
	if ( isset($_SESSION['user']['id'])){
        if($_SESSION['user']['last_ord'] != NULL){
			$ord = get_last_ord_by_id($_SESSION['user']['last_ord']);
			$products = get_products_for_last_ord(implode($ord));
		}
    }
	else{
		header('Location: ../login.php');
	}
?>