<?php 

	require_once 'include/DB_Functions.php';
	$db = new DB_Functions();

	// json response array
	$response = array("success" => 0);

	/**
	 *	test to create product
	 */
	$_POST['name'] = "test1";
	$_POST['price'] = 150;
	$_POST['description'] = "test1";

	if (isset($_POST['name']) && isset($_POST['price']) && isset($_POST['description'])) {

		$name = $_POST['name'];
	    $price = $_POST['price'];
	    $description = $_POST['description'];

	    if ($db->isProductExisted($name)) {
	    	$response["success"] = 1;
	        $response["message"] = "Product already existed with " . $name;
	        echo json_encode($response);
	    }else {
	    	$product = $db->createProduct($name, $price, $description);

	    	if ($product) {
	            // product created successfully
	            $response["success"] = 1;
	            $response["product"]["name"] = $product["name"];
	            $response["product"]["price"] = $product["price"];
	            $response["product"]["created_at"] = $product["created_at"];
	            $response["product"]["updated_at"] = $product["updated_at"];
	            echo json_encode($response);
	        } else {
	            // product failed to create
	            $response["success"] = 0;
	            $response["message"] = "Unknown error occurred in create!";
	            echo json_encode($response);
	        }
	    }
	}else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";

    // echoing JSON response
    echo json_encode($response);
}

?>