<?php

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();

	// json response array
	$response = array("success" => 0);

	$product = $db->displayAllProducts();
    
    while ($pro = mysqli_fetch_array($product)) {

        $response["products"] = array();
        $response = array();
        // success
        $response["success"] = 1;
        
        
        $response["pid"] = $pro["pid"];
        $response["name"] = $pro["name"];
        $response["price"] = $pro["price"];
        $response["description"] = $pro["description"];
        $response["created_at"] = $pro["created_at"];
        $response["updated_at"] = $pro["updated_at"];
        
        echo json_encode($response);
    }
    
    

?>