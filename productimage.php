<?php
// 'product image' object
class ProductImage{
 
    // database connection and table name
    private $conn;
    private $table_name = "product_images";
 
    // object properties
    public $id;
    public $product_id;
    public $name;
    public $timestamp;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
    }
}

echo "<div class='col-md-12'>";
    if($action=='added'){
        echo "<div class='alert alert-info'>";
            echo "Product was added to your cart!";
        echo "</div>";
    }
 
    if($action=='exists'){
        echo "<div class='alert alert-info'>";
            echo "Product already exists in your cart!";
        echo "</div>";
    }
echo "</div>";

// read all products in the database
$stmt=$product->read($from_record_num, $records_per_page);
 
// count number of retrieved products
$num = $stmt->rowCount();
 
// if products retrieved were more than zero
if($num>0){
    // needed for paging
    $page_url="products.php?";
    $total_rows=$product->count();
 
    // show products
    include_once "read_products_template.php";
}
 
// tell the user if there's no products in the database
else{
    echo "<div class='col-md-12'>";
        echo "<div class='alert alert-danger'>No products found.</div>";
    echo "</div>";
}

// read all products
function read($from_record_num, $records_per_page){
 
    // select all products query
    $query = "SELECT
                id, name, description, price 
            FROM
                " . $this->table_name . "
            ORDER BY
                created DESC
            LIMIT
                ?, ?";
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // bind limit clause variables
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);
 
    // execute query
    $stmt->execute();
 
    // return values
    return $stmt;
}
 
// used for paging products
public function count(){
 
    // query to count all product records
    $query = "SELECT count(*) FROM " . $this->table_name;
 
    // prepare query statement
    $stmt = $this->conn->prepare( $query );
 
    // execute query
    $stmt->execute();
 
    // get row value
    $rows = $stmt->fetch(PDO::FETCH_NUM);
 
    // return count
    return $rows[0];
}