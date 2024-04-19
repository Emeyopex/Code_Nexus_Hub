<?php
include('db_connect.php');
include_once('fpdf/fpdf.php');

// Enable output buffering
ob_start();

class code_nexus_hub2 extends FPDF
{
    private $products;

    // Header
    function Header()
    {
        // Logo
        $this->Image('imgs/logo.png', 170, 12, 34);

        // Company Name
        $this->SetTextColor(38, 55, 74);
        $this->SetFont('Arial', 'B', 18);
        $this->Cell(0, 10, 'Code_Nexus Hub', 0, 1, 'L');

        // Address
        $this->SetFont('Arial', '', 10);
        $this->Cell(0, 10, '123 King Street, Waterloo, Ontario, N2L 0H7', 0, 1, 'L');
        $this->Ln(-4);

        // Website and Email Address
        $this->Cell(0, 10, 'Website: wwww.codenexushub.com  Email: info@codenexushub.com', 0, 1, 'L');
        $this->Ln(-4);

        // Phone Number
        $this->Cell(0, 10, 'Phone Number: +1234567890', 0, 1, 'L');

        // Line break
        $this->Ln(10);

        $this->SetXY($this->GetPageWidth() - 15, 6);

        // Invoice
        $this->SetFont('Arial', 'B', 12);
        // Set text color to blue
        $this->SetTextColor(38, 55, 74);
        $this->Cell(1, 10, 'INVOICE', 0, 1, 'R');

        // Line break
        $this->Ln(10);
    }

    // Fetch product data based on customer first name and last name
    function fetchProductData($conn, $firstName, $lastName)
    {
        $query = "SELECT p.Model, o.Order_Qty AS Qty, p.Price, CONCAT(b.Brand_Name, ' ', p.Model) AS Description
                  FROM Product p
                  JOIN Orders o ON p.Product_ID = o.Product_ID
                  JOIN Invoice i ON o.Order_ID = i.Order_ID
                  JOIN Customer c ON i.Cust_ID = c.Cust_ID
                  JOIN Brand b ON p.Brand_ID = b.Brand_ID
                  WHERE c.Cust_firstName = '$firstName' AND c.Cust_lastName = '$lastName'";
        
        $result = $conn->query($query);
        
        if ($result && $result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $this->products[] = $row;
            }
        }
    }
    
    

    // Body of PDF
    function Client_Info($conn, $customerFullName)
    {
        // Initialize products array
        $this->products = [];

        // Add a page
        $this->AddPage();

        // Fetch customer information based on full name
        $customerQuery = "SELECT * FROM customer WHERE CONCAT(Cust_firstName, ' ', Cust_lastName) = '$customerFullName'";
        $customerResult = $conn->query($customerQuery);
        $customerData = [];

        if ($customerResult && $customerResult->num_rows > 0) {
            $customerData = $customerResult->fetch_assoc();
        }

        // Fetch address data from the Address table based on customer ID
        $addressQuery = "SELECT * FROM Address WHERE Cust_ID = '{$customerData['Cust_ID']}'";
        $addressResult = $conn->query($addressQuery);
        $addressData = [];

        if ($addressResult && $addressResult->num_rows > 0) {
            $addressData = $addressResult->fetch_assoc();
        }

        // Display customer information if available
        if (!empty($customerData) && !empty($addressData)) {
            $firstName = isset($customerData['Cust_firstName']) ? $customerData['Cust_firstName'] : 'Unknown';
            $lastName = isset($customerData['Cust_lastName']) ? $customerData['Cust_lastName'] : '';
            $email = isset($customerData['Email_Address']) ? $customerData['Email_Address'] : '';
            $phone = isset($customerData['Phone_Number']) ? $customerData['Phone_Number'] : '';
            $streetName = isset($addressData['Street_Name']) ? $addressData['Street_Name'] : '';
            $aptNumber = isset($addressData['Apt_Number']) ? $addressData['Apt_Number'] : '';
            $city = isset($addressData['City']) ? $addressData['City'] : '';
            $province = isset($addressData['Province']) ? $addressData['Province'] : '';
            $postalCode = isset($addressData['Postal_Code']) ? $addressData['Postal_Code'] : '';
            $country = isset($addressData['Country']) ? $addressData['Country'] : '';

            $this->SetFont('Arial', '', 10);
            $this->Cell(0, 60, 'Name: ' . $firstName . ' ' . $lastName, 0, 1, 'L');
            $this->Ln(-25);
            $this->Cell(0, 10, 'Address: ' . $streetName . ' ' . $aptNumber . ', ' . $city . ', ' . $province . ', ' . $postalCode . ', ' . $country, 0, 1, 'L');
            $this->Cell(0, 10, 'Email: ' . $email, 0, 1, 'L');
            $this->Cell(0, 10, 'Phone: ' . $phone, 0, 1, 'L');
        } else {
            // Handle the case where customer data or address data is not found
            $this->Cell(0, 10, 'Customer information or address data not found', 0, 1, 'L');
        }

        // Table header
        $this->SetFillColor(38, 55, 74); // Background color
        $this->SetTextColor(255, 255, 255);
        $this->SetTextColor(0, 0, 0);
        $this->Ln(10);
        $this->Cell(80, 10, 'Description', 1, 0, 'C', true);
        $this->Cell(30, 10, 'Qty', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Unit Price', 1, 0, 'C', true);
        $this->Cell(40, 10, 'Total', 1, 1, 'C', true);

        // Fetch product data
        $this->fetchProductData($conn, $firstName, $lastName);

        // Product Table Display
        if (!empty($this->products)) {
            // Table header
            $this->SetFont('Arial', 'B', 10);
            $this->SetFillColor(38, 55, 74); // Background color
            $this->SetTextColor(255, 255, 255);
            $this->Cell(80, 10, 'Description', 1, 0, 'C', true);
            $this->Cell(30, 10, 'Qty', 1, 0, 'C', true);
            $this->Cell(40, 10, 'Unit Price', 1, 0, 'C', true);
            $this->Cell(40, 10, 'Total', 1, 1, 'C', true);
            $this->SetTextColor(0); // Reset text color

            // Loop through each product and display its details
            foreach ($this->products as $product) {
                $description = $product['Description'];
                $qty = $product['Qty'];
                $unit_price = $product['Price'];
                $total = $qty * $unit_price;

                // Display product details in cells
                $this->Cell(80, 10, $description, 1, 0, 'L');
                $this->Cell(30, 10, $qty, 1, 0, 'C');
                $this->Cell(40, 10, '$' . number_format($unit_price, 2), 1, 0, 'R');
                $this->Cell(40, 10, '$' . number_format($total, 2), 1, 1, 'R');
            }
        } else {
            // If no products are found, display a message
            $this->Cell(190, 10, 'No products found', 1, 1, 'C');
        }

        // Calculate subtotal, apply discount, calculate tax, and invoice total
        $subtotal = 0;
        foreach ($this->products as $product) {
            $subtotal += $product['Price'] * $product['Qty'];
        }
        $discount = $subtotal * 0.05;
        $tax = ($subtotal - $discount) * 0.13;
        $total = $subtotal - $discount + $tax;

        // Display subtotal, discount, tax, and invoice total
        $this->Ln(10);
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(150, 10, 'Subtotal', 1, 0, 'L', true);
        $this->Cell(40, 10, '$' . number_format($subtotal, 2), 1, 1, 'R', true);
        $this->Cell(150, 10, 'Discount (5%)', 1, 0, 'L', true);
        $this->Cell(40, 10, '$' . number_format($discount, 2), 1, 1, 'R', true);
        $this->Cell(150, 10, 'Tax (13%)', 1, 0, 'L', true);
        $this->Cell(40, 10, '$' . number_format($tax, 2), 1, 1, 'R', true);
        $this->Cell(150, 10, 'Invoice Total', 1, 0, 'L', true);
        $this->Cell(40, 10, '$' . number_format($total, 2), 1, 1, 'R', true);
    }

    // Footer of the PDF
    function Footer()
    {
        // Position at 2.5 cm from bottom
        $this->SetY(-25);
        // Set font
        $this->SetFont('Arial', 'I', 10);
        // Company's information
        $companyName = 'Eme Ekpenyong | 8742505';
        $address = '126 King Street, Waterloo, Ontario, Canada, N2L 0H7';
        $contact = 'Phone: +1 234-567-890 | Email: info@codenexushub.on.ca';
        // Footer content
        $this->Cell(0, 6, $companyName, 0, 1, 'C');
        $this->Cell(0, 6, $address, 0, 1, 'C');
        $this->Cell(0, 6, $contact, 0, 0, 'C');
        $this->Ln(6);
        $this->Cell(0, 6, 'Copyright © ' . date('Y') . ' Code_Nexus Hub', 0, 0, 'C');
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the full name from the form
    $fullName = $_POST['fullName'];

    // Create PDF
    $pdf = new code_nexus_hub2();

    // Split the full name into first name and last name
    $names = explode(' ', $fullName);
    $firstName = $names[0]; // First name
    $lastName = $names[count($names) - 1]; // Last name

    // Call the method and pass the database connection and customer full name
    $pdf->Client_Info($conn, $fullName);

    // Output PDF
    $pdf->Output();

    // Close the database connection
    $conn->close();

    // Flush and end buffering
    ob_end_flush();
}
?>
