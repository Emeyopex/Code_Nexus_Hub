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
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $firstName = mysqli_real_escape_string($conn, $_POST['Cust_firstName']);
    $lastName = mysqli_real_escape_string($conn, $_POST['Cust_lastName']);
    $phoneNumber = mysqli_real_escape_string($conn, $_POST['Phone_Number']);
    $streetName = mysqli_real_escape_string($conn, $_POST['Street_Name']);
    $aptNumber = mysqli_real_escape_string($conn, $_POST['Apt_Number']);
    $city = mysqli_real_escape_string($conn, $_POST['City']);
    $province = mysqli_real_escape_string($conn, $_POST['Province']);
    $postalCode = mysqli_real_escape_string($conn, $_POST['Postal_Code']);
    $country = mysqli_real_escape_string($conn, $_POST['Country']);

    // Update customer data
    $customerUpdateSql = "UPDATE customer SET Cust_firstName = '$firstName', Cust_lastName = '$lastName', Phone_Number = '$phoneNumber' WHERE Cust_ID = '$id'";
    if (mysqli_query($conn, $customerUpdateSql)) {
        // Update address data
        $addressUpdateSql = "UPDATE address SET Street_Name = '$streetName', Apt_Number = '$aptNumber', City = '$city', Province = '$province', Postal_Code = '$postalCode', Country = '$country' WHERE Cust_ID = '$id'";
        if (mysqli_query($conn, $addressUpdateSql)) {
            echo "Customer details updated successfully";
            // Redirect to a success page or another appropriate page
            header("Location: customer_registration.php");
            exit;
        } else {
            echo "Error updating address: " . mysqli_error($conn);
        }
    } else {
        echo "Error updating customer details: " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>
