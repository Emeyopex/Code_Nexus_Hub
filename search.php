<?php
// Start session
session_start();

// Establish database connection
$host = "localhost";
$username = "root";
$password = "";
$database = "code_nexus_hub";

$conn = mysqli_connect($host, $username, $password, $database);

// Check connection
if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['fullName'])) {
    // Retrieve full name from the form
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);

    // Split full name into first name and last name
    list($firstName, $lastName) = explode(" ", $fullName);

    // Search for customer by full name in the database
    $sql = "SELECT * FROM customer WHERE Cust_firstName = '$firstName' AND Cust_lastName = '$lastName'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        // If customer is found, fetch address details and store them in session variables
        $customerData = mysqli_fetch_assoc($result);
        
        // Retrieve address data
        $customerId = $customerData['Cust_ID'];
        $addressSql = "SELECT * FROM address WHERE Cust_ID = '$customerId'";
        $addressResult = mysqli_query($conn, $addressSql);
        
        if ($addressResult && mysqli_num_rows($addressResult) > 0) {
            $addressData = mysqli_fetch_assoc($addressResult);
            $_SESSION['customer'] = $customerData;
            $_SESSION['address'] = $addressData;
            
            // Redirect to the update form
            header("Location: update_form.php");
            exit;
        } else {
            echo "Address not found for the customer";
        }
    } else {
        echo "Customer not found";
    }
}

// Close database connection
mysqli_close($conn);
?>
