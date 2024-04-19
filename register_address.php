<?php
// Start the session
session_start();

// Your database connection code here
$host = "localhost";
$username = "root";
$password = "";
$database = "code_nexus_hub";

$conn = mysqli_connect($host, $username, $password, $database);

if (!$conn) {
    die("Database connection error: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $streetName = mysqli_real_escape_string($conn, $_POST['Street_Name']);
    $aptNumber = mysqli_real_escape_string($conn, $_POST['Apt_Number']);
    $city = mysqli_real_escape_string($conn, $_POST['City']);
    $province = mysqli_real_escape_string($conn, $_POST['Province']);
    $postalCode = mysqli_real_escape_string($conn, $_POST['Postal_Code']);
    $country = mysqli_real_escape_string($conn, $_POST['Country']);

    // Check if the Cust_ID exists in the session
    if (isset($_SESSION['Cust_ID'])) {
        $customerId = $_SESSION['Cust_ID'];

        // Retrieve customer's full name from the database
        $customerQuery = "SELECT CONCAT(Cust_firstName, ' ', Cust_lastName) AS Customer_Name FROM customer WHERE Cust_ID = '$customerId'";
        $customerResult = mysqli_query($conn, $customerQuery);

        if ($customerResult && mysqli_num_rows($customerResult) > 0) {
            $row = mysqli_fetch_assoc($customerResult);
            $customerName = $row['Customer_Name'];

            // Insert data into the address table
            $addressSql = "INSERT INTO address (Cust_ID, Customer_Name, Street_Name, Apt_Number, City, Province, Postal_Code, Country) 
                            VALUES ('$customerId', '$customerName', '$streetName', '$aptNumber', '$city', '$province', '$postalCode', '$country')";
            if (mysqli_query($conn, $addressSql)) {
                echo "Address registered successfully";

                // // Destroy the session
                // session_destroy();
                
                // Redirect the user to the registration page or another appropriate page
                header("Location: search_form.php");
                exit;
            } else {
                echo "Error inserting address: " . mysqli_error($conn);
            }
        } else {
            echo "Customer not found";
        }
    } else {
        echo "Cust_ID not found in session";
    }
}

?>
