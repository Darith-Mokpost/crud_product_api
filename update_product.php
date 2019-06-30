<?php


	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();

	$_POST['pid'] = 6;
	$_POST['name'] = "test3";
	$_POST['price'] = 380;
	$_POST['description'] = "test3";

	// json response array
	$response = array("success" => 0);
	if (isset($_POST['pid']) && isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {

		$pid = $_POST['pid'];
	    $name = $_POST['name'];
	    $price = $_POST['price'];
	    $description = $_POST['description'];


	    $update = $db->updateProduct($pid, $name, $price, $description);
	    if ($update) {
			$response = array();
			// success
            $response["success"] = 1;
            $response["message"] = "Product successfully updated.";
            $response["pid"] = $update["pid"];
            $response["name"] = $update["name"];
            $response["price"] = $update["price"];
            $response["description"] = $update["description"];
            $response["created_at"] = $update["created_at"];
            $response["updated_at"] = $update["updated_at"];
            

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