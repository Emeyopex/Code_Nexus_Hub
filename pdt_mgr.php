
<?php
// Database connection
$host = "localhost:3306";
$username = "root";
$password = "";
$database = "code_nexus_hub";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}

// Handle form submissions
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $action = $_POST['action'];
    
    if ($action == "add") {
        // Process add product form submission
        // Retrieve form data
        $productName = mysqli_real_escape_string($conn, $_POST['Product_Name']);
        $model = mysqli_real_escape_string($conn, $_POST['Model']);
        $storage = mysqli_real_escape_string($conn, $_POST['Storage']);
        $price = mysqli_real_escape_string($conn, $_POST['Price']);
        $quantity = mysqli_real_escape_string($conn, $_POST['Qty']);
        $category = mysqli_real_escape_string($conn, $_POST['Category']);
    
        
        // Get the Brand_ID corresponding to the selected brand
        $brandQuery = "SELECT Brand_ID FROM Brand WHERE Brand_Name = '$brandName'";
        $brandResult = mysqli_query($conn, $brandQuery);
        
        if ($brandResult && mysqli_num_rows($brandResult) > 0) {
            $row = mysqli_fetch_assoc($brandResult);
            $brandID = $row['Brand_ID'];
            
            // Insert new product into database with the retrieved Brand_ID
            $sql = "INSERT INTO product (Brand_ID, Model, Storage, Price, Qty, Product_Name, Category) 
                    VALUES ($brandID, '$model', '$storage', $price, $quantity, '$productName', '$category')";
            
            if (mysqli_query($conn, $sql)) {
                echo "Product added successfully";
            } else {
                echo "Error adding product: " . mysqli_error($conn);
            }
        } else {
            echo "Brand not found";
        }
    } elseif ($action == "update") {
        // Process update product form submission
        // Retrieve form data
        $productId = mysqli_real_escape_string($conn, $_POST['Product_ID']);
        $productName = mysqli_real_escape_string($conn, $_POST['Product_Name']);
        $model = mysqli_real_escape_string($conn, $_POST['Model']);
        $storage = mysqli_real_escape_string($conn, $_POST['Storage']);
        $price = mysqli_real_escape_string($conn, $_POST['Price']);
        $quantity = mysqli_real_escape_string($conn, $_POST['Qty']);
        $category = mysqli_real_escape_string($conn, $_POST['Category']);
        
        // Update the corresponding product in the database
        $sql = "UPDATE product 
                SET Product_Name='$productName', Model='$model', Storage='$storage', Price=$price, Qty=$quantity, Category='$category' 
                WHERE Product_ID=$productId";
        
        if (mysqli_query($conn, $sql)) {
            echo "Product updated successfully";
        } else {
            echo "Error updating product: " . mysqli_error($conn);
        }
    } elseif ($action == "delete") {
        // Process delete product form submission
        // Retrieve form data
        $productId = mysqli_real_escape_string($conn, $_POST['product_id']);
        
        // Delete the corresponding product from the database
        $sql = "DELETE FROM product WHERE Product_ID=$productId";
        
        if (mysqli_query($conn, $sql)) {
            echo "Product deleted successfully";
        } else {
            echo "Error deleting product: " . mysqli_error($conn);
        }
    }
    
}

// Close database connection
mysqli_close($conn);
?>
