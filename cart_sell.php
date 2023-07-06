<?php

function sell(){

    require './inc/connect.php';

    if(isset($_COOKIE['idOfOrder'])){

        echo '<script type="text/javascript">',
            "alert('محصول شما با موفقیت خریداری شد.')",
        '</script>'
        ;

    $data = json_decode($_COOKIE['idOfOrder'], true);
//    $dataForProductTable = [];

//    print_r($data);
//    echo '<br>';

    for($i = 0; $i < count($data); $i++){
//        echo $data[$i]['order_id'] . "<br>";

        $sql_setProductCondition = "update orders set product_condition = 'sold' where id = '".$data[$i]['order_id'] ."'";
        mysqli_query($connect, $sql_setProductCondition)or die(mysqli_error($connect));

        $sql_setQuantity = "update orders set quantity  = '".$data[$i]['quantity']."' where id  = '".$data[$i]['order_id']."'";
        mysqli_query($connect, $sql_setQuantity)or die(mysqli_error($connect));



//        $sql_setOrderPrice = "update orders set order_price = "

        }

        $sql_object = "SELECT product_id,quantity,product_price FROM orders WHERE product_condition = 'sold' AND quantity != 1";
        $query_object = mysqli_query($connect, $sql_object)or die(mysqli_error($connect));
//        $result = mysqli_fetch_assoc($query_object);
//        print_r($result);

        while($result = mysqli_fetch_assoc($query_object)){
//            $result['quantity'] = $result['quantity'] -1;

            $sql_updateQuantity = "update products set quantity = quantity - '".$result['quantity']."' where id = '".$result['product_id']."' ";
            mysqli_query($connect, $sql_updateQuantity)or die(mysqli_error($connect));

            $sql_updateOrderPrice = "update orders set order_price = '".$result['quantity']."' * '".$result['product_price']."' where product_id = '".$result['product_id']."'";
            mysqli_query($connect, $sql_updateOrderPrice)or die(mysqli_error($connect));

//            array_push($dataForProductTable, $result);
        }
        setcookie("idOfOrder", "", time() - 3600);
        header('Location: https://backbox.ir/cart.php?ref=1212');
        exit;
//        print_r($dataForProductTable);

    }
}

if(isset($_GET['sell'])){

    sell();

}


