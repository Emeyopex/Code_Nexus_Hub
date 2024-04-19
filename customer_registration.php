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
   
    <h2>Customer Registration Form</h2>
    <div class="container">
        <!-- Registration Form -->
        <form action="register_customer.php"  id="registrationForm" method="post">

            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="Cust_firstName" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="Cust_lastName" required>

            <label for="email">Email Address:</label>
            <input type="email" id="email" name="Email_Address" required>

            <label for="phone_number">Phone Number:</label>
            <input type="tel" id="phone_number" name="Phone_Number" required>

            <button type="submit">Register</button>
        
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

    <script src="scripts/script.js"></script>
</body>
</html>
