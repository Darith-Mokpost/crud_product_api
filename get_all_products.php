<?php

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();

	// json response array
	$response = array("success" => 0);

	$product = $db->displayAllProducts();
    $response["products"] = array();
    while ($pro = mysqli_fetch_array($product)) {
        
        $prod = array();
        $prod["pid"] = $pro["pid"];
        $prod["name"] = $pro["name"];
        $prod["price"] = $pro["price"];
        $prod["description"] = $pro["description"];
        $prod["created_at"] = $pro["created_at"];
        $prod["updated_at"] = $pro["updated_at"];
            
        array_push($response["products"], $prod);
        
        
    }
    // success
    $response["success"] = 1;
    // echoing JSON response
    echo json_encode($response);

?>