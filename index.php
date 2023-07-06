<?php
require "homepage_logIn.php";
?>
<!DOCTYPE html>
<html lang="fa-IR">

<head>
    <title>Tak</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="./js/jquery-3.6.0.min.js"> </script> 
    <link rel="stylesheet" type="text/css" href="./css/index.css">
    <script src="./js/index.js"></script>

    <style>
        @media screen and (min-width: 1009px) {
            .h5Responsive {
                font-size: 1.4vw;
                /*color: #1e7e34;*/
            }

            .rialResponsive {
                font-size: 1.1vw
            }

        }

        @media screen and (max-width: 1009px) {
            .h5Responsive {
                font-size: 1.2vw;
                font-weight: 600;
                /*color: purple;*/
            }

            .rialResponsive {
                font-size: 1.0vw
            }

        }

        @media screen and (max-width: 780px) {
            .h5Responsive {
                font-size: 1.2vw;
                font-weight: 500;
                /*color: red;*/
            }

            .rialResponsive {
                font-size: 1.0vw;
            }
        }

        @media screen and (max-width: 575px) {
            .h5Responsive {
                font-size: 2.5vw;
                /*color: blue;*/
            }

            .rialResponsive {
                font-size: 1.5vw;
            }
        }
    </style>


</head>

<body onload="hideNoResult()">
    <?php
    include './inc/header.php';

    if (isset($_GET['sendToCart'])) {

        if ($_GET['sendToCart'] == "success") { ?>

            <script>
                alert('محصول شما به سبد کالایتان اضافه شد.');
            </script>

        <?php
        }
    }
    if (isset($_GET['login'])) {


        if ($_GET['login'] == 'success') { ?>


            <script>
                alert('شما با موفقیت وارد حساب خود شدید.');
            </script>

    <?php
        }
    }
    if (isset($_GET['registeration'])) {


        if ($_GET['registeration'] == 'success') { ?>


            <script>
                alert('ثبت نام شما با موفقیت انجام گرفت.');
            </script>

    <?php
        }
    }

    function modifier_farsidigit($str)
    {
        $fa_digits = array('۰', '۱', '۲', '۳', '۴', '۵', '۶', '۷', '۸', '۹', ',');
        $en_digits = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '.',);
        $str = str_replace($en_digits, $fa_digits, $str);
        return $str;
    }

    ?>

    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner my_slider_height">
            <div class="carousel-item active ">
                <img class="d-block w-100 my_slider_height" src="../images/slider/slider_shoe_002.jpg" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 my_slider_height" src="../images/slider/slider_shoe_003.jpg" alt="Second slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100 my_slider_height" src="../images/slider/slider_shoe_001.jpg" alt="Third slide">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


    <div class="row d-flex justify-content-center text-right m-0">

        <div id="mainContent" class="d-flex changeMainContentWidth justify-content-center">

            <div id="myRow" class="row w-100 mt-2 d-flex changeRowHeight justify-content-center ">
                <?php

                include './inc/connect.php';

                $query = 'SELECT * FROM products WHERE quantity != 0';
                $result = mysqli_query($connect, $query);

                while ($row = mysqli_fetch_array($result)) {
                ?>


                    <div id="<?= $row['id'] ?>" class="card filter changeCardsHeight col-md-2 px-2 col-4 col-sm-2 mx-3 mb-3 shadow-lg " style="
                    border-radius: 2vh;
                    border-color: #E0E0E0;
                    border-style: solid;
                    border-width: 2px;
                    
                    ">

                        <div class="card-title px-1 d-flex justify-content-end mt-3 ">
                            <h5 class="card-title h5Responsive"><?= $row['product_name'] ?></h5>
                        </div>

                        <div class="card-body p-0">
                            <a href="product.php?id=<?= $row['id'] ?>">
                                <div class="d-flex h-100  align-items-center">

                                    <img class="card-img-top img-fluid" src="../images/products/<?= $row['product_image'] ?>" alt="Card image cap">

                                </div>
                            </a>
                        </div>
                        <div class="card-text d-flex align-items-center justify-content-center row mt-1 mb-3 mx-1 bg-white" dir="rtl">
                            <div class="w-25 mt-1 d-flex justify-content-center ">
                                <a href="product.php?id=<?= $row['id'] ?>" class="rialResponsive">بیشتر</a>
                            </div>
                            <div class="w-75  text-left d-flex mt-1 justify-content-end align-items-center">

                                <h5 id="<?= $row['id'] ?>product_price_filter" class="row h5Responsive ml-1  m-0"><?= modifier_farsidigit(number_format($row['product_price'])) ?></h5>
                                <p class="rialResponsive m-0">تومان</p>

                            </div>
                        </div>

                    </div>


                <?php
                }
                ?>
                <h1 id="noResult" class="w-100 mt-5 text-center">نتیجه ای یافت نشد</h1>
            </div>
        </div>
        <div id="sideBar" class=" my-0 changeSideBarWidth ml-0 d-flex justify-content-end row" style="margin-right:0.5%;height: fit-content">

            <div class="bg-white mt-2 pt-2 w-100 shadow-lg  changeSideBarPadding" style="
border-radius: 2vw;
border-color: #E0E0E0;
border-style: solid;
border-width: 1px;
">
                <div>
                    <div class="">
                        <h4 class="font-weight-bold MobileFontSizeH4 mb-3" style="">
                            انواع محصول
                        </h4>
                    </div>

                    <div class="mb-2">
                        <div class="checkbox row m-0 d-flex justify-content-end ">
                            <div class=" d-flex row m-0 align-items-center">
                                <label class=" sidebar-options  d-flex row m-0 align-items-center font-weight-normal">کفش</label>
                            </div>
                            <div class=" mx-2 d-flex row m-0 align-items-center">
                                <input type="checkbox" onclick="displayByCategory(this.value)" value="shoes" name="shoes" id="shoes">
                            </div>
                        </div>
                        <div class="checkbox row m-0 d-flex justify-content-end">
                            <div class=" d-flex row m-0 align-items-center">
                                <label class="d-flex row m-0 align-items-center sidebar-options font-weight-normal">پیرهن</label>
                            </div>
                            <div class="mx-2">
                                <input type="checkbox" onclick="displayByCategory(this.value)" value="shirt" name="shirt" id="shirt">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="">
                    <h4 class="font-weight-bold MobileFontSizeH4 mb-3">محدوده قیمت </h4>
                </div>

                <div dir="rtl" class=" row px-0 d-flex justify-content-center mx-0">


                    <div class="form-group mb-1 d-flex w-100 ">
                        <input name="from" pattern="^\$\d{1,3}(,\d{3})*(\.\d+)?$" type="text" id="from" placeholder="از :" class="form-control py-0 px-1" style="font-size: 1vw">
                        <p class="px-2 mb-0 d-flex align-items-center" style="font-size: 1.2vw">تومان</p>
                    </div>
                    <p class="mb-2 Rerror text-center" id="fromError" style="color: #F4A460;font-weight : bold;display:none">
                                خواهشا قیمتی را معیین کنید.
                            </p>
                    <div class="form-group mb-1 d-flex w-100 ">
                        <input name="to" id="to" type="text" placeholder="تا :" class="form-control py-0 px-1" style="font-size: 1vw">
                        <p class="px-2 mb-0 d-flex align-items-center" style="font-size: 1.2vw">تومان</p>
                    </div>
                    <p class="mb-2 Rerror text-center" id="toError" style="color: #F4A460;font-weight : bold;display:none">
                                خواهشا قیمتی را معیین کنید.
                            </p>
                    <div class="column d-flex w-100 justify-content-center align-items-center">
                        <input name="login_btn" onclick="filterPrice()" class="register-button mb-1 d-flex justify-content-center p-0 w-50 border rounded" type="submit" style="background-color: rebeccapurple;color:white" value="نمایش">
                    </div>
                    <!--                end price filter-->



                </div>

            </div>

            <!-- /////////////////////////////////////// -->


            <div class="bg-primary w-100 m-0 shadow-lg changeSideBarHeight row d-flex align-items-center justify-content-center mt-2 pb-2 shadow-lg px-1 pt-2" style="
color: #E5FFCC;
border-radius : 2vw;
border-style: solid;
border-width: 1px;
border-color: #3333FF;
">
                <h5 dir="rtl" class="font-weight-bold login-header text-center">برای
                    ورود، اطلاعات خود را وارد فرمایید.</h5>

                <form action="index.php" dir="rtl" method="get" class="w-100 row d-flex justify-content-center">
                    <!-- <h5 >نام کاربری :</h5> -->
                    <div class="form-group w-75 mb-2">
                        <input name="username" type="text" placeholder="نام کاربری..." class="form-control py-0 px-1" style="font-size: 1vw">
                    </div>
                    <?php
                    if (count($usernameError) > 0) {

                        foreach ($usernameError as $error) {
                    ?>
                            <p class="mb-2 Rerror text-center" style="color: #F4A460;font-weight : bold">
                                <?= $error; ?>
                            </p>
                    <?php
                        }
                    }
                    ?>
                    <!-- <h5 >رمز عبور :</h5> -->
                    <div class="form-group mb-2 w-75 ">
                        <input name="password" type="password" placeholder="رمز عبور..." class="form-control py-0 px-1" style="font-size: 1vw">
                    </div>
                    <?php
                    if (count($passwordError) > 0) {

                        foreach ($passwordError as $error) {
                    ?>
                            <p class="mb-2 Rerror text-center" style="color: #F4A460;font-weight : bold">
                                <?= $error; ?>
                            </p>
                    <?php
                        }
                    }
                    ?>

                    <div class="form-group p-2 d-flex justify-content-center row w-100 mx-0" style="
    color: #E5FFCC;
    border-radius: 1vh;
    border-style: solid;
    border-width: 2px;
    border-color: #3333FF;
    ">


                        <img src="captcha.php" alt="CAPTCHA" class="captcha-image w-100 mb-1">
                        <input type="text" name="captcha_challenge" pattern="[A-Z]{6}" placeholder="کد کپنچا... " style="font-size: 1vw" class="form-control mx-2 py-0 px-1">

                        <?php
                    if (count($captchaError) > 0) {

                        foreach ($captchaError as $error) {
                    ?>
                            <p class="mb-0 Rerror mt-1text-center  " style="color: #F4A460;font-weight : bold">
                                <?= $error; ?>
                            </p>
                    <?php
                        }
                    }
                    ?>

                    </div>

                    <?php
                    if (count($userAndPassErrors) > 0) {

                        foreach ($userAndPassErrors as $error) {
                    ?>
                            <p class="mb-0 mt-1 Rerror text-center" style="color: #F4A460;font-weight : bold">
                                <?= $error; ?>
                            </p>
                    <?php
                        }
                    }
                    ?>

                    <div class="column d-flex w-100 justify-content-center align-items-center">
                        <input name="login_btn" class="register-button mb-1 d-flex justify-content-center p-0 w-50 border rounded" type="submit" value="ورود">
                    </div>

                </form>

            </div>

        </div>
    </div>
    <?php
    include './inc/footer.php';
    ?>


</body>

</html>