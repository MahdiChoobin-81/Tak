<?php
session_start();

require './inc/connect.php';

$userAndPassErrors = array();
$usernameError = array();
$passwordError = array();
$captchaError = array();

if(isset($_GET['login_btn'])){
    $login_username = mysqli_real_escape_string($connect, $_GET['username']);
    $login_password = mysqli_real_escape_string($connect, $_GET['password']);

    if(empty($login_username)){
        array_push($usernameError, 'لطفا نام کاربری خود را وارد نمایید.');
    }
    if(empty($login_password)){
        array_push($passwordError, 'لطفا رمز عبور خود را وارد نمایید.');
    }
    if (!empty($_GET['captcha_challenge']) && !($_GET['captcha_challenge'] == $_SESSION['captcha_text'])) {
        array_push($captchaError, 'کد امنیتی اشتباه وارد شده است.');
    }
    if (empty($_GET['captcha_challenge'])) {
        array_push($captchaError, 'لطفا کد امنیتی را وارد نمایید.');
    }

    if(count($usernameError) == 0 && count($passwordError) == 0 && count($captchaError) == 0){

        //        to do this ↓ u need to change password lenght in users table. it`s not enough
        //        $Rpassword = md5($Rpassword);

        $query = "SELECT * FROM users WHERE username='$login_username' AND password='$login_password'";
        $result = mysqli_query($connect, $query);
        $num = mysqli_num_rows($result);
        if($num == 1){
            $_SESSION['username'] = $login_username;
            setcookie("username", $login_username, time() + (86400 * 30), "/"); // 86400 = 1 day
            $_SESSION['success'] = 'ورود شما با موفقیت صورت گرفت.';



            header('location:index.php?login=success');
        }else{
            array_push($userAndPassErrors, 'نام کاربری یا رمز عبور شما اشتباه می باشد.');
        }
    }

}


