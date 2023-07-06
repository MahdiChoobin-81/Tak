<?php

include './inc/header.php';
include './inc/connect.php';



if (empty($_GET['id'])) {
    header('Location: https://backbox.ir/');
    exit;
} else {
    $sql = "select * from products where id = " . $_GET['id'] . " ";
    /** @var $connect is in connect.php  */
    $query = mysqli_query($connect, $sql);
    $result = mysqli_fetch_assoc($query);

    $color_sql = "select * from colors where product_id = " . $_GET['id'] . " ";
    $getColors = mysqli_query($connect, $color_sql);


    $size_sql = "select * from sizes where product_id = " . $_GET['id'] . " ";
    $getSize = mysqli_query($connect, $size_sql);
}

function modifier_farsidigit($str)
{
    $fa_digits = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', ',');
    $en_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.');
    $str = str_replace($en_digits, $fa_digits, $str);
    return $str;
}

function sendToCart()
{
    include './inc/connect.php';

    $color_id = $_COOKIE['colorId'];
    setcookie("colorId", "", time() - 3600);
    //    echo "id of Selected Color is : " . $color_id . "<br>";


    $sqlCode1 = 'update products set quantity = quantity -1 where id =' . $_GET['id'];
    mysqli_query($connect, $sqlCode1);

    $sqlCode2 = 'select * from products where id = ' . $_GET['id'];
    $sqlCode2Query = mysqli_query($connect, $sqlCode2);
    $data = mysqli_fetch_assoc($sqlCode2Query);

    $sqlUserId = 'select id from users where username = "' . $_COOKIE['username'] . '"';
    $sqlUserId_Query = mysqli_query($connect, $sqlUserId);
    $user_id_array = mysqli_fetch_assoc($sqlUserId_Query);
    $user_id = $user_id_array['id'];

    $sqlCode3 = 'select color from colors where id = "' . $color_id . '" ';
    $sqlCode3Query = mysqli_query($connect, $sqlCode3);
    $color_array = mysqli_fetch_assoc($sqlCode3Query);
    $color = $color_array['color'];


    $data['product_id'] = $data['id'];
    $data['order_price'] = $data['product_price'];
    $data['user_id'] = $user_id;
    $data['product_condition'] = 'inCart';
    $data['product_size'] = $_POST['size'];
    $data['product_color'] = $color;
    unset($data['created_at'], $data['updated_at'], $data['id']);


    $insert_sql = "INSERT INTO orders (user_id, product_id, order_price, quantity, product_condition, product_name, product_brand, product_price, product_image, description, product_size, product_color) VALUES ('" . $data['user_id'] . "', '" . $data['product_id'] . "', '" . $data['order_price'] . "', 1, '" . $data['product_condition'] . "', '" . $data['product_name'] . "', '" . $data['product_brand'] . "', '" . $data['product_price'] . "', '" . $data['product_image'] . "', '" . $data['description'] . "', '" . $data['product_size'] . "', '" . $data['product_color'] . "');";

    mysqli_query($connect, $insert_sql) or die(mysqli_error($connect));


    header('Location: https://backbox.ir/index.php?sendToCart=success');
    exit;



    //    var_dump($data);


}

if (isset($_POST['btn_send'])) {


    if (empty($_COOKIE['username'])) {
        // echo 'Please Log in.';

?>
        <div class="error text-center mt-4" dir="rtl">
            <p>برای افزودن محصول به سبد خرید باید وارد پروفایل خود شوید.</p>
            <a href="logIn.php" class="text-success text-bold">برای ورود بر روی این متن کلیک کنید.</a>
        </div>

        <?php
    }
    elseif(empty($_COOKIE['colorId'])){
        ?>
        <div class="error text-center mt-4" dir="rtl">
            <p>لطفا یک رنگ را برای محصول خود مشخص کنید.</p>
        </div>
    <?php
    }
     else {
        $username = $_COOKIE['username'];

        $query = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($connect, $query);
        $num = mysqli_num_rows($result);
        if ($num == 1) {
            sendToCart();
        } else {
            ?>
            <div class="error text-center mt-4" dir="rtl">
                <p>خواهشا دوباره وارد پروفایل خود شوید.</p>
            </div>

<?php
        }
    }
}
