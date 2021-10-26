<?php
   require_once 'connect.php';
   session_start();
   
   if($_SESSION['user']['role'] == 1){
	   header('Location: ../personal_area.php');
   }
   if($_SESSION['user']['role'] > 1){
	   header('Location: ../admin.php');
   }  
?>