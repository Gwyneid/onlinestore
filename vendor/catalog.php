<?php
     require_once 'functions.php';
	 $categories = get_cat();
	 $id = $_GET['id'];
	 $ids = cats_id($categories, $id);
	 $ids = !$ids ? $id : rtrim($ids, ",");
	 $goods = get_products($ids);
?>