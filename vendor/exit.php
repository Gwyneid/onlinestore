<?php
    session_start();
    unset($_SESSION['user']);
	unset($_SESSION['cart_list']);
	header('Location: ../index.php');
?>