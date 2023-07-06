<?php

// if($_GET['q'] == 'shoe'){
// 	echo "This is Response Test For Shoes";
// }elseif($_GET['q'] == 'shirt'){
// 	echo "This is Response Test For shirts";
// }

require "./inc/connect.php";

$sql = "SELECT product_id, category FROM categories";
$query = mysqli_query($connect, $sql)or die(mysqli_error($connect));

$myArray  = array();
$response = array();

while($result = mysqli_fetch_assoc($query)){

	$myArray[] = $result;


}
$count = count($myArray);

//if($_GET['checked']){
//    echo "Wooooooooooooooowooo";
//}
//else{
$selectedInputs_Array = json_decode($_GET['checked'], true);
$selectedInputs_Json = json_encode($selectedInputs_Array);
//var_dump($selectedInputs_Array);
$selectedInputsCount = count($selectedInputs_Array);

for($i = 0; $i<$count; $i++)
	{
        for($j = 0; $j<$selectedInputsCount; $j++){
            if($myArray[$i]['category'] == $selectedInputs_Array[$j]){
                array_push($response, $myArray[$i]['product_id']);
            }
        }

	}
$response_json = json_encode($response);
	echo $response_json;
//var_dump($response);
//}



