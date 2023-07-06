<?php

require './inc/connect.php';

if(isset($_COOKIE['order_id'])){
    $order_id_delete = $_COOKIE['order_id'];

    $sql_get_product_id = "select product_id from orders where id = '".$order_id_delete."' ";
    $query_get_product_id = mysqli_query($connect, $sql_get_product_id)or die("query_get_product_id :".mysqli_error($connect));
    $result_get_product_id = mysqli_fetch_assoc($query_get_product_id);


    $sql_returnQuantity = "update products set quantity = quantity + 1 where id = '".$result_get_product_id['product_id']."'";
    mysqli_query($connect, $sql_returnQuantity)or die("returnQuantity : ".mysqli_error($connect));

    $sql_deleteItem = "delete from orders where id = '".$order_id_delete."'";
    mysqli_query($connect, $sql_deleteItem)or die(mysqli_error($connect));





    unset($order_id_delete);
    setcookie("order_id", "", time() - 3600);
//    setcookie('order_id', '', time() - 3600, '/');



}
