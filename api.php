<?php

session_start();
require_once 'vendor/connect.php';
require_once 'vendor/functions.php';

if( isset($_POST['good_id']) ){
	
	$current_added_good = get_good_by_id($_POST['good_id']);
	
	$good_check = false;

	if ( isset($_SESSION['cart_list']) ) {
		foreach ($_SESSION['cart_list'] as $value) {
			if ( $value['id'] == $current_added_good['id'] ) {
				$good_check = true;
				$id = $value['id'];
				unset($_SESSION['cart_list'][$id]);
				$text_button_good = "В корзину";
			}
		}
	}

	if ( !$good_check ) {
		$_SESSION['cart_list'][$current_added_good['id']] = $current_added_good;
		$text_button_good = "Удалить из корзины";
	}
	$cart_cost = get_cart_cost();
	$current_cart_value = count($_SESSION['cart_list']);
		
	echo json_encode( array(
    "current_cart_value" => $current_cart_value,
    "text_button_good" => $text_button_good,
	"cart_cost" => $cart_cost,
    ) );
		
}

if( isset($_POST['cart_link']) ){
	if ( isset($_SESSION['user']['id']) ){
		echo 1;
	}
	else{
		echo 0;
	}
}


?>