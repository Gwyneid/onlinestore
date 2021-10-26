<?php

    $connect = mysqli_connect('localhost', 'root', '', 'onlinestore');

    if (!$connect) {
        die('Error connect to DataBase');
    }
?>