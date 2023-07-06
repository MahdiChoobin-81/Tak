<html>

<head>
    <title>MAHDI</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./js/jquery-ui.js"></script>

    <style>
        .register-button {
            width: 280px;
            height: 60px;
            background-color: #FFD700;
            font-weight: bold;
            color: #008000;
        }
    </style>


</head>



<body class="container">

<?php
// require '../inc/header.php';
require './inc/connect.php';
?>
    <div class="mt-3 w-75 border border-secondary rounded mx-auto">
        <input name="username" id="from" type="text" class="form-control form-control-lg">
    </div>

        <div class="mt-3 w-75 border border-secondary rounded mx-auto">
            <input name="password" id="to" type="text" class="form-control form-control-lg">
        </div>


    <div class="column  mt-5 d-flex w-100 justify-content-center ">
        <input name="filter_price" onclick="filterPrice()" id="filter_price" class="register-button border rounded" type="button" value="ورود">
    </div>
<div id="result">asd</div>

<script>
    function filterPrice(){
        let from = document.getElementById("from").value;
        let to = document.getElementById("to").value;


        const xhttp = new XMLHttpRequest();
        xhttp.onload = function(){

            document.getElementById("result").innerHTML = this.responseText;
        }
        try{
            xhttp.open("GET", "ajaxResponder_filter_price.php?from=" + from + "&to=" + to);
        }catch (e) {
            alert("Error")
        }
        xhttp.send();

    }
</script>

<?php
// require '../inc/footer.php';
?>
</body>

</html>