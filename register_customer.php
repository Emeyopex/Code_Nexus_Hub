<?php

// Start the session
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

// Function to validate email address using regex
function validateEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Function to validate phone number using regex
function validatePhoneNumber($phoneNumber) {
    // Allow +, - and . in phone number
    return preg_match("/^[0-9+-.]+$/", $phoneNumber);
}

// Function to validate postal code using regex
function validatePostalCode($postalCode) {
    // Allow alphanumeric characters and space
    return preg_match("/^[a-zA-Z0-9 ]+$/", $postalCode);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form data
    $firstName = mysqli_real_escape_string($conn, $_POST['Cust_firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['Cust_lastName']);
    $email = mysqli_real_escape_string($conn, $_POST['Email_Address']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['Phone_Number']);

    // Validate email
    if (!validateEmail($email)) {
        echo "Invalid email address";
        exit;
    }

    // Validate phone number
    if (!validatePhoneNumber($phoneNumber)) {
        echo "Invalid phone number";
        exit;
    }

    // Your SQL insert query
    $customerSql = "INSERT INTO customer (Cust_firstName, Cust_lastName, Email_Address, Phone_Number) 
                    VALUES ('$firstName', '$lastName', '$email', '$phoneNumber')";

    // Perform the query
    if (mysqli_query($conn, $customerSql)) {
    // Retrieve the auto-generated Cust_ID
    $customerId = mysqli_insert_id($conn);
    
    // Set Cust_ID in session
    $_SESSION['Cust_ID'] = $customerId;

        // Redirect to address.php with Cust_ID as a parameter
        header("Location: address.php?Cust_ID=$customerId");
        exit;
    } else {
        echo "Error: " . $customerSql . "<br>" . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>
