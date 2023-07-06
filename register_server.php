<!-- receive information submitted from the form and store (register)
the information in the database.  -->
<?php
session_start();

require './inc/connect.php';

$errors = array();

if (isset($_POST['reg-user'])) {

    $Rusername = mysqli_real_escape_string($connect, $_POST['username']);
    $Remail = mysqli_real_escape_string($connect, $_POST['email']);
    $Rpassword = mysqli_real_escape_string($connect, $_POST['password']);

    if (empty($Rusername)) {
        array_push($errors, 'لطفا نام کاربری را وارد نمایید.');
    }
    if (empty($Remail)) {
        array_push($errors, 'لطفا ایمیل خود را وارد نمایید.');
    }
    if (empty($Rpassword)) {
        array_push($errors, 'لطفا رمز خود را وارد نمایید.');
    }

    if (!empty($_POST['captcha_challenge']) && !($_POST['captcha_challenge'] == $_SESSION['captcha_text'])) {
        array_push($errors, 'کد امنیتی اشتباه وارد شده است.');
    }
    if (empty($_POST['captcha_challenge'])) {
        array_push($errors, 'لطفا کد امنیتی را وارد نمایید.');
    }
    $Ruser_check_query = "select * from users where username='$Rusername' or email='$Remail' limit 1";
    $Rresult = mysqli_query($connect, $Ruser_check_query);
    $Ruser = mysqli_fetch_assoc($Rresult);

    if ($Ruser) {
        if ($Ruser['username'] === $Rusername) {
            array_push($errors, 'نام کاربری قبلا گرفته شده است.');
        }
        if ($Ruser['email'] === $Remail) {
            array_push($errors, 'ایمیل شما در سایت ثبت شده است.');
        }
    }


    if (count($errors) == 0) {

        //        to do this ↓ u need to change password lenght in users table. it`s not enough
        //        $Rpassword = md5($Rpassword);

        $Rquery = "INSERT INTO users (username, password, email)
    VALUES('$Rusername', '$Rpassword', '$Remail')";

        mysqli_query($connect, $Rquery);


        $_SESSION['username'] = $Rusername;
        setcookie("username", $Rusername, time() + (86400 * 30), "/"); // 86400 = 1 day
        $_SESSION['success'] = 'ثبت نام شما با موفقیت انجام گرفت.';


        header('location:index.php?registeration=success');
    }
}
