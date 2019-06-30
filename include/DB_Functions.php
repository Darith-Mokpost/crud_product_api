<?php
class DB_Functions {

    private $conn;

    // constructor
    function __construct() {
        require_once 'DB_Connect.php';
        // connecting to database
        $db = new Db_Connect();
        $this->conn = $db->connect();
    }

    // destructor
    function __destruct() {
        
    }

    /**
     * Create new Product
     * returns product details
     */
    public function createProduct($name, $price, $description) {

        $stmt = $this->conn->prepare("INSERT INTO products(name, price, description, created_at) VALUES(?, ?, ?, NOW())");
        $stmt->bind_param("sds", $name, $price, $description);
        $result = $stmt->execute();
        $stmt->close();

        // check for successful create
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM products WHERE name = ?");
            $stmt->bind_param("s", $name);
            $stmt->execute();
            $product = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $product;
        } else {
            return false;
        }
    }


    /**
     * Check product is existed or not
     */
    public function isProductExisted($name) {
        $stmt = $this->conn->prepare("SELECT name from products WHERE name = ?");

        $stmt->bind_param("s", $name);

        $stmt->execute();

        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // product existed 
            $stmt->close();
            return true;
        } else {
            // product not existed
            $stmt->close();
            return false;
        }
    }

    /**
     * Delete product using ID of product
     */
    public function deleteProduct($pid) {
        
        $stmt = $this->conn->prepare("DELETE FROM products WHERE pid = ?");
        $stmt->bind_param("i", $pid);
        if ($stmt->execute()) {
            $stmt->close();
            return true;

        }else {
            $stmt->close();
            return false;
        }
        
    }

    /**
     * Update product by ID of product
     */
    public function updateProduct($pid, $name, $price, $description) {

        $stmt = $this->conn->prepare("UPDATE products SET name = ?, price = ?, description = ?, updated_at = NOW() WHERE pid = ?");
        $stmt->bind_param("isds", $pid, $name, $price, $description);
        $result = $stmt->execute();

        // check for successful create
        if ($result) {
            $stmt = $this->conn->prepare("SELECT * FROM products WHERE pid = ?");
            $stmt->bind_param("i", $pid);
            $stmt->execute();
            $product = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $product;
        } else {
            return false;
        }

    }

    /**
     * Display one product by Name of product
     */
    public function displayProduct($name) {
        $stmt = $this->conn->prepare("SELECT * FROM products WHERE name = ?");
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            $product = $stmt->get_result()->fetch_assoc();
            $stmt->close();

            return $product;
        }else {
            return NULL;
        }
    }

    /**
     * Display all product
     */
    public function displayAllProducts() {
        $sql = "SELECT * FROM products";
        $stmt = mysqli_query($this->conn, $sql);
        
        return $stmt;

    }
}

?>
