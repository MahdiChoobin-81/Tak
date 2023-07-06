
function hideNoResult(){
    document.getElementById("noResult").style.display= "none";
}
window.addEventListener('resize', function (event) {
    var newWidth = window.innerWidth
    var rowHeight = document.getElementById("myRow")
    var sideBarHeight = document.getElementById("changeSideBarHeight")

    if (newWidth < 575) {
        rowHeight.classList.remove("changeRowHeight")
        sideBarHeight.classList.add("changeSideBarHeight")
    }
    else if (newWidth > 575) {
        rowHeight.classList.add("changeRowHeight")
        try {
            sideBarHeight.classList.remove("changeSideBarHeight")
        } catch (e) {
            console.log("there is no class with this name : changeSideBarHeight")
        }
    }
});

function numberToPersian(number) {
    const persian = {
        "۰": "0", "۱": "1", "۲": "2", "۳": "3", "۴": "4", "۵": "5", "۶": "6", "۷": "7",
        "۸": "8", "۹": "9", ",": ""
    };
    number = number.toString().split("");
    let persianNumber = ""
    for (let i = 0; i < number.length; i++) {
        number[i] = persian[number[i]];
    }
    for (let i = 0; i < number.length; i++) {
        persianNumber += number[i];
    }
    return persianNumber;
}

let selectedInputs = [];
let displayByCategoryResponse = "";

function displayByCategory(category) {
    let checkbox = document.getElementById(category);

    document.getElementById("from").value = "";
    document.getElementById("to").value = "";

    if (checkbox.checked) {
        selectedInputs.push(category);
        // console.log(selectedInputs);
        // alert(category + " is Added.")

        let selectedInputsJson = JSON.stringify(selectedInputs)
        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {

            // let response = JSON.parse(this.responseText);
            displayByCategoryResponse = JSON.parse(this.responseText);
            let responseCount = Object.keys(displayByCategoryResponse).length;
            let divCount = document.querySelectorAll('.filter').length;
            let display = [];


            for (let i = 0; i < responseCount; i++) {
                for (let j = 0; j < divCount; j++) {
                    if (document.getElementsByClassName('filter')[j].id === displayByCategoryResponse[i]) {
                        // document.getElementById(document.getElementsByClassName('filter')[j].id).style.display = "inline";
                        display.push(document.getElementsByClassName('filter')[j].id);

                        // alert("Barabare");
                    }
                    document.getElementById(document.getElementsByClassName('filter')[j].id).style.display = "none";
                }
            }
            for (let i = 0; i < display.length; i++) {
                // console.log(display[i]);
                document.getElementById(display[i]).style.display = 'flex';
                // document.getElementById(display[i]).style.height = 'fit-content';
            }
            // document.getElementById("para").innerHTML = response;
        }
        xhttp.open("GET", "ajaxResponder_category_filter.php?checked=" + selectedInputsJson);
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


            // let response = JSON.parse(this.responseText);
            displayByCategoryResponse = JSON.parse(this.responseText);
            let responseCount = Object.keys(displayByCategoryResponse).length;
            let divCount = document.querySelectorAll('.filter').length;
            let display = [];

            if (selectedInputsJson === "[]") {
                for (let i = 0; i < divCount; i++) {
                    document.getElementsByClassName('filter')[i].style.display = "flex";
                }
                // alert("Meara")
            } else {
                for (let i = 0; i < responseCount; i++) {
                    for (let j = 0; j < divCount; j++) {
                        if (document.getElementsByClassName('filter')[j].id === displayByCategoryResponse[i]) {
                            // document.getElementById(document.getElementsByClassName('filter')[j].id).style.display = "inline";
                            display.push(document.getElementsByClassName('filter')[j].id);

                            // alert("Barabare");
                        }
                        document.getElementById(document.getElementsByClassName('filter')[j].id).style.display = "none";
                    }
                }
                for (let i = 0; i < display.length; i++) {
                    // console.log(display[i]);
                    document.getElementById(display[i]).style.display = 'flex';
                }
            }
            // document.getElementById("para").innerHTML = response;
            // alert(typeof selectedInputsJson + " => " + selectedInputsJson)

            // if(Object.keys(response).length === 0){
            //     alert("response");
            // }


        }
        xhttp.open("GET", "ajaxResponder_category_filter.php?checked=" + selectedInputsJson);
        xhttp.send();


    }

}

function filterPrice() {
    let from = document.getElementById("from").value;
    let to = document.getElementById("to").value;

    from = from.replace(',', '');
    to = to.replace(',', '');

    if (from == "") {
        document.getElementById("fromError").style.display = "flex";
    }
    if (to == "") {
        document.getElementById("toError").style.display = "flex";
    }
    if (from !== "" && to !== "") {



        const xhttp = new XMLHttpRequest();
        xhttp.onload = function () {

            let response = JSON.parse(this.responseText);
            let responseCount = Object.keys(response).length;

            let divs = document.getElementsByClassName("filter");
            let divCount = document.querySelectorAll('.filter').length;
            let display = [];


            for (let j = 0; j < responseCount; j++) {
                // console.log(response[j])
                for (let i = 0; i < divCount; i++) {

                    // console.log(divs[i].id + "product_price_filter");
                    let product_price = document.getElementById(divs[i].id + "product_price_filter").textContent;
                    product_price = numberToPersian(product_price);
                    // console.log(product_price)

                    // if display of divs was flex
                    if (document.getElementById(divs[i].id).style.display == "flex") {
                        // console.log("flex : " + divs[i].id + " product_price : " + product_price);

                        if (product_price === response[j]) {
                            // console.log("flex : \t" + "product_price : " + product_price + "\t | \t response[j] : " + response[j] + "show it");

                            display.push(document.getElementById(divs[i].id));

                        }
                        else {
                            // console.log("flex : \t" + "product_price : " + product_price + "\t | \t response[j] : " + response[j]);
                        }
                    }
                    else if (document.getElementById(divs[i].id).style.display == "none") {
                        // console.log("none : " + divs[i].id);

                        let displayByCategoryResponseCount = Object.keys(displayByCategoryResponse).length;
                        if (displayByCategoryResponseCount > 0) {
                            for (let k = 0; k < displayByCategoryResponseCount; k++) {

                                let newProductPrice = document.getElementById(displayByCategoryResponse[k] + "product_price_filter").textContent;
                                newProductPrice = numberToPersian(newProductPrice);
                                if (newProductPrice === response[j]) {
                                    // console.log(newProductPrice);
                                    display.push(document.getElementById(displayByCategoryResponse[k]));
                                }

                            }
                        } else if (displayByCategoryResponseCount == 0) {
                            if (product_price === response[j]) {
                                // console.log("flex : \t" + "product_price : " + product_price + "\t | \t response[j] : " + response[j] + "show it");

                                display.push(document.getElementById(divs[i].id));

                            }
                        }


                    }
                    else if (document.getElementById(divs[i].id).style.display == "") {
                        // console.log("empty : " + divs[i].id);
                        if (product_price === response[j]) {
                            // console.log("none : \t" + "product_price : " + product_price + "\t | \t response[j] : " + response[j] + "show it");
                            // for (let l = 0; l < divCount; l++) {
                            // document.getElementById(divs[l].id).style.display = "none"
                            // }
                            // document.getElementById(divs[i].id).style.display = "flex"
                            display.push(document.getElementById(divs[i].id));
                        } else {
                            // console.log("none : \t" + "product_price : " + product_price + " \t | \t response[j] : " + response[j]);
                        }
                    }

                }
            }



            // hide all divs
            for (let j = 0; j < divCount; j++) {
                document.getElementById(divs[j].id).style.display = "none";
            }

            if (display.length == 0) {
                document.getElementById("noResult").style.display= "inline";
            }
            else if (display.length !== 0) {
                document.getElementById("noResult").style.display= "none";

                for (let i = 0; i < display.length; i++) {
                    // console.log(display.length)
                    // for(let j=0; j<displayByCategoryResponseCount; j++){
                    // if(displayByCategoryResponse[j] == display[i])
                    document.getElementById(display[i].id).style.display = 'flex';
                    // }
                }
            }

        }
        try {
            xhttp.open("GET", "ajaxResponder_filter_price.php?from=" + from + "&to=" + to);

        } catch (e) {
            alert("Error in Sending AJAX Request :(")
        }
        xhttp.send();
    }
}

function addCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}

function checkCharacter(value) {
    // document.getElementById("from").value = addCommas(value)
}

function updateTextView(_obj) {
    var num = getNumber(_obj.val());
    if (num == 0) {
        _obj.val('');
    } else {
        _obj.val(num.toLocaleString());
    }
}
function getNumber(_str) {
    var arr = _str.split('');
    var out = new Array();
    for (var cnt = 0; cnt < arr.length; cnt++) {
        if (isNaN(arr[cnt]) == false) {
            out.push(arr[cnt]);
        }
    }
    return Number(out.join(''));
}
$(document).ready(function () {
    $('#from').on('keyup', function () {
        updateTextView($(this));
    });
});

$(document).ready(function () {
    $('#to').on('keyup', function () {
        updateTextView($(this));
    });
});


