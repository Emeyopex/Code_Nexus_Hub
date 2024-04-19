<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Registration Form</title>
    <link rel="stylesheet" href="css/search.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <?php include 'header.php'; ?>
   
    <h2>Search Form</h2>

        <!-- Additional field for searching customers by full name -->
        <form id="searchForm" action="search.php" method="post">
            <h3>Search Customer by Full Name</h3>
            <label for="search_full_name">Full Name:</label>
            <input type="text" id="fullName" name="fullName">
            <button type="submit" id="searchBtn">Search</button>
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
