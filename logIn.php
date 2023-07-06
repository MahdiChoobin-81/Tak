<?php require 'login_server.php' ?>
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
    <link rel="stylesheet" href="./css/authentication_errors.css" />

    <style>
        .captcha {
            width: 200px;
            height: 80px;
            background-color: yellowgreen;
            font-size: 3rem;
        }

        .register-button {
            width: 280px;
            height: 60px;
            background-color: #FFD700;
            font-weight: bold;
            color: #008000;
        }
    </style>
</head>

<body>

    <?php
    include './inc/header.php';

        
    
    ?>



    <div class="container-fluid mt-3 " dir="rtl">

    

    <?php if (count($errors) > 0) : ?>
            <div class="error">
                <?php foreach ($errors as $error) : ?>
                    <p><?php echo $error ?></p>
                <?php endforeach ?>

            </div>
        <?php endif ?>

        <div class="column d-flex flex-column flex-wrap align-items-center" style="height: 80px;">

            <h2>ورود</h2>
            <hr class="w-50" style="background-color: #F5F5F5;">

        </div>

        <div class="column d-flex flex-column align-items-center" style="height: 80px;">

            <h3>نام کاربری :</h3>
        <form action="logIn.php" method="get" class="w-100">

            <div class="form-group mt-3 w-75 border border-secondary rounded mx-auto">
                <input name="username" type="text" class="form-control form-control-lg">
            </div>
            </div>
            <div class="column d-flex flex-column align-items-center mt-5" style="height: 80px;">

                <h3>رمز عبور :</h3>

                <div class="form-group mt-3 w-75 border border-secondary rounded mx-auto">
                    <input name="password" type="password" class="form-control form-control-lg">
                </div>


            </div>
            <div class="row mt-5 mx-5 d-flex align-items-center justify-content-center">
                <h3>کد کپچا :</h3>

                <div class="form-group mt-3 w-50 border border-secondary rounded mx-3">
                    <input id="captcha" name="captcha_challenge" pattern="[A-Z]{6}" type="text" class="form-control form-control-lg">
                </div>

                <img src="captcha.php" alt="CAPTCHA" class="captcha-image">

            </div>
            <div class="column  mt-5 d-flex w-100 justify-content-center ">
                <input name="login_btn" class="register-button border rounded" type="submit" value="ورود">
            </div>
        </form>

        <div class="container">
            <h5 class="text-right mt-5">اگر هنوز حسابی کاربری ندارید وارد صفحه <a href="register.php">ثبت نام</a> شوید.</h5>
        </div>
    </div>

    <?php
    require './inc/footer.php';
    ?>
    <script>
        var refreshButton = document.querySelector(".refresh-captcha");
        refreshButton.onclick = function() {
            document.querySelector(".captcha-image").src = 'captcha.php?' + Date.now();
        }
    </script>
</body>

</html>