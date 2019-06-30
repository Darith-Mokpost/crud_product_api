<?php

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();

	// json response array
	$response = array("success" => 0);
	$_POST['name'] = "test1";

	if (isset($_POST['name'])) {

		$name = $_POST['name'];
		$product = $db->displayProduct($name);

		if ($product) {
			$response = array();
			// success
            $response["success"] = 1;

            $response["pid"] = $product["pid"];
            $response["name"] = $product["name"];
            $response["price"] = $product["price"];
            $response["description"] = $product["description"];
            $response["created_at"] = $product["created_at"];
            $response["updated_at"] = $product["updated_at"];
            

            // echoing JSON response
            echo json_encode($response);
		}else {
            // no product found
            $response["success"] = 0;
            $response["message"] = "No product found";

            // echo no users JSON
            echo json_encode($response);
        }
    }else {
	    // required field is missing
	    $response["success"] = 0;
	    $response["message"] = "Required field(s) is missing";

	    // echoing JSON response
	    echo json_encode($response);
	}

?>