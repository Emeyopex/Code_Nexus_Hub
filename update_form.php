<?php
// Start session
session_start();

// Check if customer and address data exist in session
if (isset($_SESSION['customer']) && isset($_SESSION['address'])) {
    $address = $_SESSION['address'];
    $customer = $_SESSION['customer'];

    // Extract customer data
    $id = $customer['Cust_ID'];
    $firstName = $customer['Cust_firstName'];
    $lastName = $customer['Cust_lastName'];
    $phoneNumber = $customer['Phone_Number'];
    $streetName = $address['Street_Name'];
    $aptNumber = $address['Apt_Number'];
    $city = $address['City'];
    $province = $address['Province'];
    $postalCode = $address['Postal_Code'];
    $country = $address['Country'];

} else {
    // Redirect or handle the case where customer data is not found
    echo "Customer data not found";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Update Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
    <h3>Update Customer Details</h3>
    
    <div class="container">
    <form action="update_customer.php" method="post">
        
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="Cust_firstName" value="<?php echo $firstName; ?>" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="Cust_lastName" value="<?php echo $lastName; ?>" required>

        <label for="phone_number">Phone Number:</label>
        <input type="tel" id="phone_number" name="Phone_Number" value="<?php echo $phoneNumber; ?>" required>

        <label for="street_name">Street Name:</label>
        <input type="text" id="street" name="Street_Name" value="<?php echo $streetName; ?>" required>

        <label for="apt_number">Apt Number:</label>
        <input type="text" id="apt_number" name="Apt_Number" value="<?php echo $aptNumber; ?>" required>

        <label for="city">City:</label>
        <input type="text" id="city" name="City" value="<?php echo $city; ?>" required>

        <label for="province">Province:</label>
        <input type="text" id="province" name="Province" value="<?php echo $province; ?>" required>

        <label for="postal_code">Postal Code:</label>
        <input type="text" id="postal_code" name="Postal_Code" value="<?php echo $postalCode; ?>" required>

        <label for="country">Country:</label>
        <input type="text" id="country" name="Country" value="<?php echo $country; ?>" required>

        <button type="submit">Update</button>
    </form>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        function changeFontSize() {
            var body = document.querySelector('body');
            var currentFontSize = parseInt(window.getComputedStyle(body).fontSize);
            body.style.fontSize = (currentFontSize + 1) + 'px';
        }

        function changeFontSize2() {
            var body = document.querySelector('body');
            var currentFontSize = parseInt(window.getComputedStyle(body).fontSize);
            body.style.fontSize = (currentFontSize - 1) + 'px';
        }
    </script>
</body>
</html>
