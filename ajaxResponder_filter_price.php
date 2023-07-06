<?php
require "./inc/connect.php";

$from = $_GET['from'];
$to   = $_GET['to'];

$sql = "SELECT product_price FROM products WHERE product_price BETWEEN $from AND $to";
$query = mysqli_query($connect, $sql)or die(mysqli_error($connect));
$prices = array();
while($result = mysqli_fetch_assoc($query)){
    $prices[] = $result['product_price'];
}
$numberOfProducts = count($prices);

$response = json_encode($prices);
echo $response;

// for($i = 0; $i<$numberOfProducts; $i++){

//     echo $prices[$i]['product_price'] . "<br>";

// }




