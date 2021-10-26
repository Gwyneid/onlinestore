<?php
   $start_goods = 0;
   if($_GET['page'] != NULL){
		$start_goods = $_GET['page'];
   }
   $start_goods = $start_goods * 9;

?>