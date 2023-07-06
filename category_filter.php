<html>

<head>
    <title>MAHDI</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="./js/jquery-ui.js"></script>


</head>

<body class="p-5 float-right">

<?php
// require '../inc/header.php';
require './inc/connect.php';
?>

<input type="checkbox" onclick="displayByCategory(this.value)" name="shoes" id="shoes" value="shoes">
<label for="shoe">shoe</label><br>
<input type="checkbox" onclick="displayByCategory(this.value)" name="shirt" id="shirt" value="shirt">
<label for="shirt">shirt</label>
<script>
    const selectedInputs = [];
    function displayByCategory(category) {
        let checkbox = document.getElementById(category);


        if (checkbox.checked) {
            selectedInputs.push(category);
            console.log(selectedInputs);
            // alert(category + " is Added.")

            let selectedInputsJson = JSON.stringify(selectedInputs)
            const xhttp = new XMLHttpRequest();
            xhttp.onload = function () {

                let response = JSON.parse(this.responseText);
                let responseCount = Object.keys(response).length;
                let divCount = document.querySelectorAll('.filter').length;
                let display = [];


                for (let i = 0; i < responseCount; i++) {
                    for (let j = 0; j < divCount; j++) {
                        if (document.getElementsByClassName('filter')[j].id === response[i]) {
                            // document.getElementById(document.getElementsByClassName('filter')[j].id).style.display = "inline";
                            display.push(document.getElementsByClassName('filter')[j].id);

                            // alert("Barabare");
                        }
                        document.getElementById(document.getElementsByClassName('filter')[j].id).style.display = "none";
                    }
                }
                for (let i = 0; i < display.length; i++) {
                    // console.log(display[i]);
                    document.getElementById(display[i]).style.display = 'inline';
                }
                document.getElementById("para").innerHTML = response;
            }
            xhttp.open("GET", "ajaxResponder.php?checked=" + selectedInputsJson);
            xhttp.send();

        } else if (!checkbox.checked) {
            let selectedInputsJson;
            for (let i = 0; i < selectedInputs.length; i++) {
                if (selectedInputs[i] === category) {
                    selectedInputs.splice(i, 1);
                    selectedInputsJson = JSON.stringify(selectedInputs);
                    console.log(selectedInputs);
                    // alert(selectedInputsJson)
                }
            }

            const xhttp = new XMLHttpRequest();
            xhttp.onload = function () {


                let response = JSON.parse(this.responseText);
                let responseCount = Object.keys(response).length;
                let divCount = document.querySelectorAll('.filter').length;
                let display = [];

                if (selectedInputsJson === "[]") {
                    for(let i=0; i<divCount; i++){
                        document.getElementsByClassName('filter')[i].style.display = "inline";
                    }
                    // alert("Meara")
                } else {
                    for (let i = 0; i < responseCount; i++) {
                        for (let j = 0; j < divCount; j++) {
                            if (document.getElementsByClassName('filter')[j].id === response[i]) {
                                // document.getElementById(document.getElementsByClassName('filter')[j].id).style.display = "inline";
                                display.push(document.getElementsByClassName('filter')[j].id);

                                // alert("Barabare");
                            }
                            document.getElementById(document.getElementsByClassName('filter')[j].id).style.display = "none";
                        }
                    }
                    for (let i = 0; i < display.length; i++) {
                        // console.log(display[i]);
                        document.getElementById(display[i]).style.display = 'inline';
                    }
                }
                document.getElementById("para").innerHTML = response;
                // alert(typeof selectedInputsJson + " => " + selectedInputsJson)

                // if(Object.keys(response).length === 0){
                //     alert("response");
                // }


            }
            xhttp.open("GET", "ajaxResponder.php?checked=" + selectedInputsJson);
            xhttp.send();


        }

    }

</script>

<div id="para"></div>


<div class="row ">
    <div id="1" class="filter p-5 m-2 bg-secondary text-white border">1</div>
    <div id="2" class="filter p-5 m-2 bg-secondary text-white border">2</div>
    <div id="3" class="filter p-5 m-2 bg-secondary text-white border">3</div>
    <div id="4" class="filter p-5 m-2 bg-secondary text-white border">4</div>
    <div id="5" class="filter p-5 m-2 bg-secondary text-white border">5</div>
    <div id="6" class="filter p-5 m-2 bg-secondary text-white border">6</div>
    <div id="7" class="filter p-5 m-2 bg-secondary text-white border">7</div>
    <div id="8" class="filter p-5 m-2 bg-secondary text-white border">8</div>
</div>


<?php
// require '../inc/footer.php';
?>
</body>

</html>