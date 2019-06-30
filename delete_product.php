<?php

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();

	/**
	 *	test to delete product
	 */
	$_POST['pid'] = 2;

	// json response array
	$response = array("success" => 0);
	if (isset($_POST['pid'])) {
		$pid = $_POST['pid'];
		$delProduct = $db->deleteProduct($pid);

		if ($delProduct) {
			// successfully deleted
			$response["success"] = 1;
			$response["message"] = "Product successfully deleted";
			// echoing JSON response
        	echo json_encode($response);
		}else {
	        // no product found
	        $response["success"] = 0;
	        $response["message"] = "No product found";
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