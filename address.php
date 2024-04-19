<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration Form</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
   
    <h2>Address Form</h2>
    <div class="container">
        <!-- Registration Form -->
        <form action="register_address.php" method="post">

            <h3>Address:</h3>
            <label for="street_name">Street Name:</label>
            <input type="text" id="street_name" name="Street_Name" required>

            <label for="apt_number">Apartment Number:</label>
            <input type="text" id="apt_number" name="Apt_Number">

            <label for="city">City:</label>
            <input type="text" id="city" name="City" required>

            <label for="province">Province:</label>
            <input type="text" id="province" name="Province" required>

            <label for="postal_code">Postal Code:</label>
            <input type="text" id="postal_code" name="Postal_Code" required>

            <label for="country">Country:</label>
            <input type="text" id="country" name="Country" required>

            <button type="submit">Submit</button>
            
        </form>
    </div>

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

    <?php include 'footer.php'; ?>
</body>
</html>
