<?php
    require_once 'connect.php';
    session_start();

function get_cat(){
	global $connect;
	$query = "SELECT * FROM `category`";
	$res = mysqli_query($connect, $query);
	$arr_cat = array();
	while($row = mysqli_fetch_assoc($res)){
		$arr_cat[] = $row;
	}
	return $arr_cat;
}

function cats_id($array, $id){
	if(!$id) return false;
	$data .= $id . ",";
	foreach($array as $item){
		if($item['parent'] == $id){
			$data .= $item['id'] . ",";
			$data .= cats_id($array, $item['id']);
		}
	}
	return $data;
}

function get_products($ids){
	global $connect;
	if($ids){
		$query = "SELECT * FROM goods WHERE cat_id IN($ids) ORDER BY name";
	}
	else{
	    $query = "SELECT * FROM goods ORDER BY name";
	}
	$res = mysqli_query($connect, $query);
	$products = array();
	while($row = mysqli_fetch_assoc($res)){
		$products[] = $row;
	}
	return $products;
}

function get_products_for_last_ord($ord){
	global $connect;
	$query = "SELECT * FROM goods WHERE id IN($ord) ORDER BY name";
	$res = mysqli_query($connect, $query);
	$products = array();
	while($row = mysqli_fetch_assoc($res)){
		$products[] = $row;
	}
	return $products;
}

function get_good_by_id( $id ){
	global $connect;

	$query = "SELECT * FROM goods WHERE id=" . $id;
	$req = mysqli_query($connect, $query);
	$resp = mysqli_fetch_assoc($req);

	return $resp;
}

function get_category_by_id( $id ){
	global $connect;

	$query = "SELECT * FROM category WHERE id=" . $id;
	$req = mysqli_query($connect, $query);
	$resp = mysqli_fetch_assoc($req);

	return $resp;
}

function get_banned_by_id( $id ){
	global $connect;

	$query = "SELECT banned FROM users WHERE  id =" . $id;
	$req = mysqli_query($connect, $query);
	$resp = mysqli_fetch_assoc($req);

	return $resp;
}

function banned_text($id){
	$banned = get_banned_by_id( $id );
	if($banned['banned'] == 0){
		return "забанить";
	}
	else{
		return "разбанить";
	}
}

function get_last_ord_by_id( $id ){
	global $connect;

	$query = "SELECT ord FROM cart WHERE id=" . $id;
	$req = mysqli_query($connect, $query);
	$resp = mysqli_fetch_assoc($req);

	return $resp;
}





function get_cart_count(){
	$cart_count = 0;
	if ( isset($_SESSION['cart_list']) ){
		$cart_count = count($_SESSION['cart_list']);
	}
	return $cart_count;
}

function get_cart_cost(){
	$cost = 0;
	if ( isset($_SESSION['cart_list']) ){
		foreach($_SESSION['cart_list'] as $good){
			$cost += $good['price'];
		}
	}
	$cart_cost .= $cost . " ₽";
	if($cost != 0){
	    return $cart_cost;
	}
}

function in_cart($id){
	$in = "В корзину";
	if ( isset($_SESSION['cart_list']) ){
		foreach($_SESSION['cart_list'] as $good){
			if($good['id'] == $id){
				$in = "Удалить из корзины";
			}
		}
	}
	return $in;
}

function get_categories(){
	global $connect;
	
	$query = "SELECT * FROM category ORDER BY title";
	 
	$res = mysqli_query($connect, $query);
	$categories = array();
	while($row = mysqli_fetch_assoc($res)){
		$categories[] = $row;
	}
	return $categories;
}

function get_users_no_mod_adm(){
	global $connect;
	$query = "SELECT * FROM `users`";
	$res = mysqli_query($connect, $query);
	$arr = array();
	while($row = mysqli_fetch_assoc($res)){
		if($row['role'] == 1){
			$arr[] = $row;
		}
	}
	return $arr;
}

function get_users_no_adm(){
	global $connect;
	$query = "SELECT * FROM `users`";
	$res = mysqli_query($connect, $query);
	$arr = array();
	while($row = mysqli_fetch_assoc($res)){
		if($row['role'] == 1 || $row['role'] == 2){
			$arr[] = $row;
		}
	}
	return $arr;
}


function get_id_category($category_name){
	global $connect;
	
	$query = "SELECT * FROM category";
	 
	$res = mysqli_query($connect, $query);
	
	foreach($res as $category){
		if($category_name == $category['title']){
			$category_id = $category['title'];
		}
	}
	return $category['id'];
}

function get_users(){
	global $connect;
	$query = "SELECT * FROM `users`";
	$res = mysqli_query($connect, $query);
	$arr = array();
	while($row = mysqli_fetch_assoc($res)){
		$arr[] = $row;
	}
	return $arr;
}

function get_role($id){
	
	$role = "пользователь";
	
	if($id == 2){
		$role = "модератор";
	}
	
	return $role;
}

function action_with_user($id){
	$action = "наз. модератором";
	
	if($id == 2){
		$action = "снять модератора";
	}
	
	return $action;
}

function have_rights($id){
	if (isset($_SESSION['user']['role'])){
	    if($_SESSION['user']['role'] > $id){
		    return true;
	    }
	}
	return false;
}

function autorized(){
	if (isset($_SESSION['user']['role'])){
		    return true;
	}
	return false;
}

function delate_user(){
	global $connect;
	$id = $_POST['delate_id'];
	$sql_delete = "DELETE FROM users WHERE id = $id "; 
	$res = mysqli_query($connect, $sql_delete);
	return "successfully";
}

function rights($right){
	$au = autorized();
	$mod = have_rights($right);
	
	if(!$au){
	    return "no_login";
    }
	else if($mod){
		return "have_rights";
	}
	else{
	    return "no_rights";	
    }
}

function user_rights( $id ){
	global $connect;
	
	$query = "SELECT * FROM users WHERE id=" . $id;
	$req = mysqli_query($connect, $query);
	$resp = mysqli_fetch_assoc($req);
	$query = "UPDATE `users` SET `role` = '$user_rights' WHERE `users`.`id` = '$id'";
	
	if($resp['role'] == 1){
		$user_rights = 2;
		$query = "UPDATE `users` SET `role` = '$user_rights' WHERE `users`.`id` = '$id'";
        $res = mysqli_query($connect, $query);
		return "модератор";
	}
    
	if($resp['role'] == 2){
		$user_rights = 1;
		$query = "UPDATE `users` SET `role` = '$user_rights' WHERE `users`.`id` = '$id'";
        $res = mysqli_query($connect, $query);
		return "пользователь";
	}
}

function number_of_pages($arr){
	$number = count($arr) / 9;
	return $number;
}

function finish_goods($start_goods, $numbers){
	$finish_goods = $start_goods + 9;
	if($finish_goods > $numbers){
		$finish_goods = $numbers;
	}
	return $finish_goods;
}







?>