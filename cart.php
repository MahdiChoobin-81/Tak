<?php

session_start();

require 'cart_delete_item.php';
require 'cart_sell.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Tak</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <link rel="stylesheet" href="css/cartStyles.css">
    <script src="js/cart.js"></script>

    <style>
          .error {
                      margin-top: 8px;
                      padding: 10px;
                      border: 1px solid #a94442;
                      color: #a94442;
                      background: #f2dede;
                      border-radius: 5px;
                      text-align: center;
                  }
    </style>



</head>

<body onload="">
    <?php
    require './inc/header.php';
    require './inc/connect.php';

    if (isset($_GET['ref'])) {
        header('Location: https://backbox.ir/cart.php');
    }

    function modifier_farsidigit($str)
    {
        $fa_digits = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', ',');
        $en_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.');
        $str = str_replace($en_digits, $fa_digits, $str);
        return $str;
    }

    $sql_get_product_id = "select product_id from orders where id = 40 ";
    $query_get_product_id = mysqli_query($connect, $sql_get_product_id) or die("query_get_product_id :" . mysqli_error($connect));
    $result_get_product_id = mysqli_fetch_assoc($query_get_product_id);

    //  echo $result_get_product_id['product_id'];



    if (isset($_COOKIE['username'])) {
        $sql_getUserId = "select id from users where username = '" . $_COOKIE['username'] . "' ";
        $query_getUserId = mysqli_query($connect, $sql_getUserId);
        $user_id = mysqli_fetch_assoc($query_getUserId);
        //  print_r($user_id);
        //  echo $user_id['id'];



        $sql_getOrdersTableDataForInCartProducts = "select * from orders where user_id = '" . $user_id['id'] . "' and product_condition = 'inCart' ";
        $query_getOrdersTableDataForInCartProducts = mysqli_query($connect, $sql_getOrdersTableDataForInCartProducts);

        $sql_getOrdersTableDataForSoldProducts = "select * from orders where user_id = '" . $user_id['id'] . "' and product_condition = 'sold' ";
        $query_getOrdersTableDataForSoldProducts = mysqli_query($connect, $sql_getOrdersTableDataForSoldProducts);
    }


    ?>

    <!-- hieght -->
    <div class="text-right mt-5" dir="rtl">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#unBought">کالا های خریداری نشده</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#bought">کالا های خریداری شده</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">

            <div class="tab-pane container-fluid active px-0" id="unBought">

                <div class="row d-flex justify-content-between mx-0 w-100 " dir="ltr" style="background-color:#F5F5F5">

                    <div id="MEARA" class="col-md-3">
                       <?php
                    if (isset($_COOKIE['noProduct'])) {
                        ?>
                            <!-- <div class=" text-center mt-4" dir="rtl">
                                <p>خواهشا یک کالا را برای خرید انتخاب کنید.</p>
                            </div> -->
                        <?php
                        ?>
                            <div dir="rtl" class="error">خواهشا یک کالا را برای خرید انتخاب کنید.</div>
                        <?php
                        setcookie("noProduct", "", time() - 3600);
                        }
                ?>
                        <div class="container shadow rounded bg-white pb-3 px-0 mt-4">


                            <div class="row d-flex justify-content-between px-0 mx-0" dir="rtl">

                                <div class="col-7 d-flex align-items-center justify-content-center px-0">

                                    <!-- qheymat -->
                                    <h6 class="mt-3">قیمت(ریال) :</h6>
                                </div>
                                <div class="col-5 d-flex align-items-center justify-content-start px-0">
                                    <!-- qheymat -->
                                    <h5 class="mt-3"><small id="priceOfSelectedProducts">0</small></h5>
                                </div>
                            </div>

                            <div class="text-right mt-4 d-flex justify-content-center">
                                <form action="cart.php" method="get">
                                    <input name="sell" onclick="sendDataForSell()" type="submit" style="
                  width:150px;
                  height:50px;
                  border-radius:5px;
                  border:0;
                  background-color:#FF00FF;
                  color:white;
                  font-weight:bold;

                  " value="ادامه فرایند خرید">
                                </form>
                            </div>

                        </div>
                    </div>


                    <?php

                    if (isset($_COOKIE['username'])) {
                        $numberOfProduct = 0;
                        while ($orders = mysqli_fetch_assoc($query_getOrdersTableDataForInCartProducts)) {
                            $sql_getQuantityOfProduct = "select quantity from products where id = '" . $orders['product_id'] . "' ";
                            $query_getQuantityOfProduct = mysqli_query($connect, $sql_getQuantityOfProduct);
                            $quantity = mysqli_fetch_assoc($query_getQuantityOfProduct);



                            $numberOfProduct++;


                    ?>
                            <div dir="rtl" class="d-flex cartResponsive bg-white m-2 col-md-8 float-right mt-4 shadow mb-5 rounded">
                                <!-- Product Image -->
                                <div class="p-2 col-sm-4 d-flex justify-content-center align-items-center" style="">
                                    <img src="../images/products/<?= $orders['product_image'] ?>" class="mw-100 mh-100 product-image" alt="">
                                </div>
                                <!-- Product Details -->
                                <div class="p-2 mx-0 col-sm-8 row text-right">
                                    <!-- Row-1 -->
                                    <div class="row mx-0 w-100  h-25">
                                        <!-- Card Title -->
                                        <div class="w-75 d-flex align-items-center justify-content-start">
                                            <h3 class="h3Responsive mr-2"><?= $orders['product_name'] ?></h3>
                                        </div>
                                        <!-- END Card Title -->

                                        <div class="w-25 d-flex align-items-center justify-content-end">
                                            <!-- Checkbox -->
                                            <div class="ml-2 p-0 form-check">
                                                <input id="checkBox_<?= $orders['id'] ?>" type="checkbox" onclick="selectProduct(this);" class="m-0 productsCheckbox p-0 form-check-input position-static" value="">
                                            </div>
                                            <!-- END Checkbox -->
                                        </div>

                                    </div>
                                    <!-- Row-2 -->
                                    <div class="row w-100 mx-0 h-75">
                                        <div class="col-12  px-0">
                                            <div class="row ml-0 myMargin">
                                                <!-- code cut from here -->

                                                <div class="w-100 d-flex">
                                                    <h5 class="h5Responsive" style="">
                                                        رنگ :
                                                    </h5>
                                                    <div class="d-flex myMarginRight align-items-end px-0">
                                                        <div class="color " style="
                                                        background-color: <?= $orders['product_color'] ?>;
                                                        border-color: <?= $orders['product_color'] ?>;
                                                        "></div>

                                                    </div>


                                                </div>
                                                <div class="w-100 d-flex">
                                                    <h5 class="h-100 h5Responsive d-flex align-items-center" style="">
                                                        اندازه :
                                                    </h5>
                                                    <!-- andaze -->
                                                    <p class="d-flex myMarginRight align-items-center h-100 pResponsive px-0">
                                                        <?= modifier_farsidigit($orders['product_size']); ?>
                                                    </p>


                                                </div>

                                                <div class="w-100 d-flex">
                                                    <h5 class=" h-100 h5Responsive d-flex align-items-center" style="">
                                                        قیمت(ریال) :
                                                    </h5>
                                                    <!-- qheymat -->
                                                    <p class="d-flex myMarginRight align-items-center pResponsive h-100 px-0" id="product_price_tag_<?= $orders['id'] ?>">
                                                        <?= modifier_farsidigit(number_format($orders['product_price'])); ?>
                                                    </p>


                                                </div>


                                            </div>

                                            <!-- afzodan va kam kardan -->
                                            <div class=" cartFooterMargin mx-0 row">
                                                <div class="mw-75" id="changeNumber<?= $orders['id'] ?>">
                                                    <div class="plusAndMinusProducts" id="plusAndMinusProducts" dir="rtl">

                                                        <span id="plus_<?= $orders['id'] ?>" class="plus spanWithoutSelection d-flex align-items-center pb-1" unselectable="on" onselectstart="return false;" onmousedown="return false;" onclick="plus(this);">+</span>
                                                        <div class="numberOfProducts">
                                                            <input id="numberOfProducts<?= $orders['id'] ?>" min="1" max="<?= $quantity['quantity'] ?>" style="color: #0fabc6;" value="1" type="number" class="w-100 bg-white border-0" disabled>
                                                        </div>
                                                        <span id="minus_<?= $orders['id'] ?>" class="minus spanWithoutSelection d-flex align-items-center pb-1" unselectable="on" onselectstart="return false;" onmousedown="return false;" onclick="minus(this);">-</span>
                                                    </div>
                                                </div>

                                                <div class="w-25 d-flex justify-content-center">
                                                    <span class="row pointer">
                                                        <!--                          <form action="cart.php" method="get">-->
                                                        <button name="delete_item" onclick="delete_item(this);" value="" class="my_delete_item" id="<?= $orders['id'] ?>"></button>
                                                        <!--                          </form>-->
                                                    </span>
                                                </div>


                                            </div>
                                        </div>
                                    </div>




                                </div>
                                <!-- END Product Details -->
                            </div>

                            <div class="col-md-3 "></div>
                    <?php
                            echo '<script type="text/javascript">',
                            "priceWithComa(" . $orders['id'] . ");",
                            '</script>';
                        }
                    }


                    ?>


                </div>
            </div>

            <!-- another Tab       ?-->
            <div class="tab-pane px-0 container-fluid fade" id="bought">

                <div class="row d-flex justify-content-between mx-0 w-100 " dir="ltr" style="background-color:#F5F5F5">

                    <div id="MEARA" class="col-md-3 d-flex align-items-start justify-content-center">
                      <?php
                    if (isset($_COOKIE['noProduct'])) {
                        ?>
                            <!-- <div class=" text-center mt-4" dir="rtl">
                                <p>خواهشا یک کالا را برای خرید انتخاب کنید.</p>
                            </div> -->
                        <?php
                        ?>
                            <div dir="rtl" class="error">خواهشا یک کالا را برای خرید انتخاب کنید.</div>
                        <?php
                        setcookie("noProduct", "", time() - 3600);
                        }
                ?>
                        <div dir="rtl" class="mx-0 py-3 d-flex justify-content-center row shadow rounded bg-white mt-4" style="280px">
                            <!-- <div class="row shadow rounded bg-white"> -->
                                <div class=" px-2 d-flex align-items-center justify-content-start px-0">

                                    <!-- qheymat -->
                                    <h6 class="m-0 myTotalPriceFontSize">قیمت کل کالا ها(ریال) :</h6>
                                </div>
                                <div class="d-flex px-2 align-items-center justify-content-start px-0">
                                    <!-- qheymat -->
                                    <h5 class="m-0"><small class="myTotalPriceFontSize" id="priceOfAllSelectedProducts">
                                            <?php
                                            //                                        }
                                            if (isset($_SESSION['total_price'])) {
                                                $totalPrice_value = $_SESSION['total_price'];
                                                unset($_SESSION['total_price']);
                                                echo $totalPrice_value;
                                            } else {
                                                echo 0;
                                            }
                                            ?>
                                        </small></h5>

                                    <script>
                                        document.getElementById('priceOfAllSelectedProducts').textContent = numberWithCommas(document.getElementById('priceOfAllSelectedProducts').textContent)
                                    </script>

                                </div>
                            <!-- </div> -->
                        </div>
                    </div>


                    <?php
                    if (isset($_COOKIE['username'])) {
                        $totalPrice = 0;

                        while ($orders = mysqli_fetch_assoc($query_getOrdersTableDataForSoldProducts)) {
                            $sql_getQuantityOfProduct = "select quantity from products where id = '" . $orders['product_id'] . "' ";
                            $query_getQuantityOfProduct = mysqli_query($connect, $sql_getQuantityOfProduct);
                            $quantity = mysqli_fetch_assoc($query_getQuantityOfProduct);

                            $totalPrice = $totalPrice + $orders['order_price'];
                            $numberOfProduct++;




                    ?>
                            <div dir="rtl" class="d-flex cartResponsive bg-white m-2 col-md-8 float-right mt-4 shadow mb-5 rounded">
                                <!-- Product Image -->
                                <div class="p-2 col-sm-4 d-flex justify-content-center align-items-center" style="">
                                    <img src="../images/products/<?= $orders['product_image'] ?>" class="mw-100 mh-100 product-image" alt="">
                                </div>
                                <!-- Product Details -->
                                <div class=" p-2 mx-0 col-sm-8 row text-right">
                                    <!-- Row-1 -->
                                    <div class="row w-100 h-25">
                                        <!-- Card Title -->
                                        <div class="w-75 d-flex align-items-center justify-content-start">
                                            <h3 class="h3Responsive mr-2"><?= $orders['product_name'] ?></h3>
                                        </div>
                                        <!-- END Card Title -->


                                    </div>
                                    <!-- Row-2 -->
                                    <div class="row w-100 h-75">
                                        <div class="col-12  px-0"">
                                            <div class=" row ml-0 myMargin">

                                            <!-- rang -->
                                            <div class="w-100 d-flex">
                                                <h5 class="h5Responsive" style="">
                                                    رنگ :
                                                </h5>
                                                <div class="d-flex myMarginRight align-items-end px-0">
                                                    <div class="color " style="
                                                        background-color: <?= $orders['product_color'] ?>;
                                                        border-color: <?= $orders['product_color'] ?>;
                                                        "></div>

                                                </div>


                                            </div>
                                            <div class="w-100 d-flex">
                                                <h5 class="h-100 h5Responsive d-flex align-items-center" style="">
                                                    اندازه :
                                                </h5>
                                                <!-- andaze -->
                                                <p class="d-flex myMarginRight align-items-center h-100 pResponsive px-0">
                                                    <?= modifier_farsidigit($orders['product_size']); ?>
                                                </p>


                                            </div>

                                            <div class="w-100 d-flex">
                                                <h5 class=" h-100 h5Responsive d-flex align-items-center" style="">
                                                    قیمت(ریال) :
                                                </h5>
                                                <!-- qheymat -->
                                                <p class="d-flex myMarginRight align-items-center pResponsive h-100 px-0" id="product_price_tag_<?= $orders['id'] ?>">
                                                    <?= modifier_farsidigit(number_format($orders['product_price'])); ?>
                                                </p>
                                            </div>
                                            <div class="w-100 d-flex">
                                                <h5 class="h-100 h5Responsive d-flex align-items-center" style="">
                                                    تعداد :
                                                </h5>
                                                <!-- andaze -->
                                                <p class="d-flex myMarginRight align-items-center h-100 pResponsive px-0">
                                                    <?= modifier_farsidigit($orders['quantity']); ?>
                                                </p>


                                            </div>




                                        </div>

                                    </div>
                                </div>




                            </div>
                            <!-- END Product Details -->
                </div>

                <div class="col-3 "></div>
            <?php

                            echo '<script type="text/javascript">',
                            "priceWithComa(" . $orders['id'] . ");",
                            '</script>';
                        }

                        $_SESSION['total_price'] = $totalPrice;
                        //                header("Location : http://localhost/Project_001/test/pages/cart.php");
                        //              unset($_SESSION['total_price']);
                    } else { ?>
            <div style="height: 150px">

            </div>

        <?php
                    }
        ?>


            </div>

        </div>
    </div>

    </div>

    <?php
    require './inc/footer.php';
    ?>

</body>

</html>