<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management Form</title>
    <link rel="stylesheet" href="css/product.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
   
    <h2>Production Management Form</h2>

    <div class="container">
    <form action="pdt_mgr.php" method="post">
    <input type="hidden" name="action" value="add">
    <!-- Input fields for product attributes -->
    <input type="text" name="Product_Name" placeholder="Product Name" required>
    <input type="text" name="Model" placeholder="Model">
    <!-- <input type="text" name="Brand_Name" placeholder="Brand Name"> -->
    <input type="number" name="Storage" placeholder="Storage" required>
    <input type="number" name="Price" placeholder="Price" step="0.01" required>
    <input type="number" name="Qty" placeholder="Quantity" required>
    <input type="text" name="Category" placeholder="Category">
    <!-- Add, Update, Delete buttons -->
    <button type="submit">Add Product</button>
    <button type="submit" name="action" value="update">Update Product</button>
    <button type="submit" name="action" value="delete">Delete Product</button>
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
