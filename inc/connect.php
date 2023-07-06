<?php

$servername = 'localhost';
$db_name = 'backboxi_tak';
$username = 'root';
$password = '';

$connect = mysqli_connect($servername, $username, $password, $db_name);
$connect->set_charset("utf8");
?>