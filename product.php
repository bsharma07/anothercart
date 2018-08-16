<?php
// 'product' object

<?php
// start session
session_start();
 // connect to database
include 'config/database.php';
 
// include objects
include_once "objects/product.php";
include_once "objects/product_image.php";
// set page title
$page_title="Products";
 
// page header html
include 'layout_header.php';
 
// contents will be here 
 
// layout footer code
include 'layout_footer.php';
?>
class Product{
 
    // database connection and table name
    private $conn;
    private $table_name="products";
 
    // object properties
    public $id;
    public $name;
    public $price;
    public $description;
    public $category_id;
    public $category_name;
    public $timestamp;
 
    // constructor
    public function __construct($db){
        $this->conn = $db;
		// get database connection
$database = new Database();
$db = $database->getConnection();
 
// initialize objects
$product = new Product($db);
$product_image = new ProductImage($db);
    }
}
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

public function readByIds($ids){
 
    $ids_arr = str_repeat('?,', count($ids) - 1) . '?';
 
    // query to select products
    $query = "SELECT id, name, price FROM " . $this->table_name . " WHERE id IN ({$ids_arr}) ORDER BY name";
 
    // prepare query statement
    $stmt = $this->conn->prepare($query);
 
    // execute query
    $stmt->execute($ids);
 
    // return values from database
    return $stmt;
}