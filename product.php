<!-- TODO : we need responsive fonts for mobile screen's. -->
<?php
session_start();
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
    <script src="../js/selectColor.js" defer></script>
    <link rel="stylesheet" href="../css/productStyles.css">
    <link rel="stylesheet" href="../css/authentication_errors.css">

    <style>
        .color {
            border-color: #fff;
        }
        .color.active {
            border-color: darkslategrey;
            box-shadow: 0 0 10px .5px rgba(0. 0. 0. 0.2);
            transform: scale(1.2);
        }

        .sizeItem {
            cursor: pointer;
            background-color: #ECECEC;
        }
    </style>


</head>

<body>

    <?php
    require 'product_set_data.php';

   

    ?>

    <div class="container-fluid mt-3" dir="rtl">
        <div class="row mx-3">

            <div class="col-md-5 px-4 col-sm-6 mt-3 d-flex align-items-start justify-content-center px-0">
                <img src="../images/products/<?= $result['product_image']; ?>" class="mw-100 mh-100" alt="shoe">
            </div>
            <form method="post" action="product.php?id=<?= $_GET['id'] ?>" class="col-md-7 col-sm-6 " id="detail">
                <div class="text-right mt-5 mr-5">
                    <h3><?= $result['product_name']; ?></h3>
                    <div class="btn-group mt-5 d-flex align-items-center">
                        <h4>رنگ :</h4>

                        <div class="colors d-flex align-items-center">
                            <?php
                            while ($color = mysqli_fetch_assoc($getColors)) {
                            ?>
                                <span class="color" id="<?= $color['id']; ?>" color="<?= $color['color']; ?>" primary="blue" style="background-color: <?= $color['color']; ?>;"></span>
                                <!--
                                                            <span class="color active" id = "red@" color="red"  primary="red"></span>
                                                            <span class="color" id = "black@" color="black" primary="black"></span>
                                                            <span class="color" id = "green@"color="green" primary="green"></span>
                            -->

                            <?php
                            }
                            ?>
                        </div>


                    </div>

                    <div class="form-group mt-5 d-flex">
                        <span style="font-size: 1.5rem;margin-bottom:.5rem;font-weight:500;line-height:1.2;vertical-align: middle;">اندازه
                            :</span>

                        <select name="size" style="width: 100px;" class="form-control  mr-3" id="exampleFormControlSelect1">

                            <?php

                            while ($row = mysqli_fetch_assoc($getSize)) {

                            ?>
                                <option><?= modifier_farsidigit($row['size']); ?></option>
                                <span class="dropdown-item sizeItem"><?= $row['size'] ?></span>

                            <?php
                            }
                            ?>
                        </select>
                    </div>

                    <div class="mt-5">
                        <span style="font-size: 1.5rem;margin-bottom:.5rem;font-weight:500;line-height:1.2;vertical-align: middle;">برند
                            :</span>
                        <span class="mr-3" style="font-size: 1.2rem;margin-bottom:.5rem;font-weight:500;line-height:1.2;vertical-align: middle;"><?= $result['product_brand']; ?></span>
                    </div>
                    <div class="mt-5">
                        <span style="font-size: 1.5rem;margin-bottom:.5rem;font-weight:500;line-height:1.2;vertical-align: middle;">قیمت
                            :</span>
                        <span class="mr-3" style="font-size: 1.2rem;margin-bottom:.5rem;font-weight:500;line-height:1.2;vertical-align: middle;"><?= modifier_farsidigit(number_format($result['product_price'])); ?></span>
                    </div>
                    <!-- <button type="button" class="btn btn-default bg-warning text-white mt-3">افزودن به سبد خرید</button> -->
                    <input type="submit" name="btn_send" value="افزودن به سبد خرید" class="btn btn-default bg-warning text-white mt-3">

                </div>
            </form>
        </div>


    </div>
    <div class="container px-4 text-right mt-4" dir="rtl">
        <h3 class="pr-2">اطلاعات بیشتر :</h3>
        <p><?= $result['description'] ?></p>
    </div>
    <div class="my-4 text-center">
        <h2>↓سیستم کامنت گذاری↓</h2>
    </div>
    <?php
    include './inc/footer.php';
    ?>

    <script>
        // document.getElementById("shirt").style.height = 
        // document.getElementById("detail").style.height;
    </script>
</body>

</html>