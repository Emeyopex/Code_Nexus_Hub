-- CODE_NEXUS HUB: EME EKPENYONG - 8742505 

CREATE DATABASE code_nexus_hub;

USE code_nexus_hub;

-- Inserting data into the Customer table
INSERT INTOCustomer (Cust_ID, Cust_firstName, Cust_lastName, Email_Address, Phone_Number) VALUES
(1, 'John', 'Doe', 'john.doe@example.com', '123-456-789'),
(2, 'Alice', 'Smith', 'alice.smith@example.com', '987-654-321'),
(3, 'Bob', 'Johnson', 'bob.johnson@example.com', '555-555-555'),
(4, 'Emma', 'Brown', 'emma.brown@example.com', '111-222-333'),
(5, 'Michael', 'Williams', 'michael.williams@example.com', '444-444-444');

-- Inserting data into the Brand table
INSERT INTO Brand (Brand_ID, Brand_Name) VALUES
(1,'Brand A'),
(2, 'Brand B'),
(3, 'Brand C'),
(4, 'Brand D'),
(5, 'Brand E');

-- Inserting data into the Product table
INSERT INTO product (Product_ID, Brand_ID, Model, Storage, Price, Qty, Product_Name, Category) VALUES
(1, 1, 'Model X', '128GB', 999.99, 50, 'Phone X', 'Smartphone'),
(2, 2, 'Model Y', '256GB', 1299.99, 30, 'Phone Y', 'Smartphone'),
(3, 3, 'Model Z', '512GB', 1499.99, 20, 'Phone Z', 'Smartphone'),
(4, 4, 'Laptop A', '1TB', 1499.99, 10, 'Laptop A', 'Laptop'),
(5, 5, 'Laptop B', '512GB', 1299.99, 15, 'Laptop B', 'Laptop');

-- Inserting data into the Address table
INSERT INTO Address (Address_ID, Cust_ID, Customer_Name, Street_Name, Apt_Number, City, Province, Postal_Code, Country) VALUES
(1, 1, 'John Doe', '123 Main St', 101, 'Waterloo', 'ON', '12345', 'Canada'),
(2, 2, 'John Gold', '456 Elm St', 201, 'Kitchener', 'NB', '54321', 'USA'),
(3, 3, 'Alice Smith', '789 Oak St', 301, 'Cambridge', 'BC', '67890', 'Australia'),
(4, 4, 'Barbara Smith', '901 Pine St', 401, 'Guelph', 'NL', '09876', 'United Kingdom'),
(5, 5, 'Bob Johnson', '246 Maple St', 501, 'Elmira', 'AB', '13579', 'Germany');

-- Inserting data into the Orders table
INSERT INTO Orders (Order_ID, Cust_ID, Product_ID, Order_Qty, Order_Date, Total, Status, Shipping_Method, Delivery_Date) VALUES
(1, 1, 1, 2, '2024-04-15', 1999.98, 'Pending', 'Standard', '2024-04-20'),
(2, 2, 2, 2, '2024-04-15', 1299.99, 'Completed', 'Express', '2024-04-18'),
(3, 3, 3, 2, '2024-04-15', 1499.99, 'Pending', 'Standard', '2024-04-22'),
(4, 4, 4, 2, '2024-04-15', 1499.99, 'Processing', 'Standard', '2024-04-25'),
(5, 5, 5, 2, '2024-04-15', 2599.98, 'Completed', 'Express', '2024-04-19');

-- Inserting data into the Invoice table
INSERT INTO Invoice (Invoice_ID, Cust_ID, Order_ID, Address_ID, Qty, Total_Price, Invoice_Date, Due_Date, Shipping_Address, Sub_Total, Tax_Amount, Shipping_Fee, Total, Status) VALUES
(1, 1, 1, 1, 2, 1999.98, '2024-04-15', '2024-05-15', '123 Main St, Waterloo, ON, 12345, CANADA', 1999.98, 0.00, 0.00, 1999.98, 'Pending'),
(2, 2, 2, 2, 2, 1299.99, '2024-04-15', '2024-05-15', '456 Elm St, Kitchener, NB, 54321, USA', 1299.99, 0.00, 0.00, 1299.99, 'Completed'),
(3, 3, 3, 3, 2, 1499.99, '2024-04-15', '2024-05-15', '789 Oak St, Cambridge, BC, 67890, AUSTRALIA', 1499.99, 0.00, 0.00, 1499.99, 'Pending'),
(4, 4, 4, 4, 2, 1499.99, '2024-04-15', '2024-05-15', '246 Maple St, Guelph, NL, 13579, UNITED KINGDOM', 1499.99, 0.00, 0.00, 1499.99, 'Processing'),
(5, 5, 5, 5, 2, 2599.98, '2024-04-15', '2024-05-15', '901 Pine St, Elmira, AB, 09876, GERMANY', 2599.98, 0.00, 0.00, 2599.98, 'Completed');

-- Inserting data into the Payment table
INSERT INTO Payment (Payment_ID, Cust_ID, Order_ID, Payment_Method, Payment_Date, Amount, Payment_Status, Payment_Confirmation) VALUES
(1, 1, 1, 'Credit Card', '2024-04-15', 1999.98, 'Completed', 'XYZ123'),
(2, 2, 2, 'PayPal', '2024-04-15', 1299.99, 'Completed', 'ABC456'),
(3, 3, 3, 'Credit Card', '2024-04-15', 1499.99, 'Pending', ''),
(4, 4, 4, 'Credit Card', '2024-04-15', 1499.99, 'Completed', 'DEF789'),
(5, 5, 5, 'Credit Card', '2024-04-15', 2599.98, 'Completed', 'GHI101');

-- Inserting data into the Receipt table
INSERT INTO Receipt (Receipt_ID, Invoice_ID, Cust_ID, PaymentDate, Payment_method, Amount_Paid, Payment_Status, Payment_Confirmation, Seller_Info, Buyer_Info, Description_of_Goods) VALUES
(1, 1, 1, '2024-04-15', 'Credit Card', 1999.98, 'Completed', 'XYZ123', 'Code Nexus', 'John Doe, 123 Main St, Waterloo, ON, CANADA 12345', 'Phone X, 128GB, Quantity: 2'),
(2, 2, 2, '2024-04-15', 'PayPal', 1299.99, 'Completed', 'ABC456', 'Code Nexus', 'Alice Smith, 456 Elm St, Kitchener, NB, USA, 54321', 'Phone Y, 256GB, Quantity: 1'),
(3, 3, 3, '2024-04-15', 'Credit Card', 1499.99, 'Pending', '', 'Code Nexus', 'Bob Johnson, 789 Oak St, Cambridge, BC, AUSTRALIA, 67890', 'Phone Z, 512GB, Quantity: 1'),
(4, 4, 4, '2024-04-15', 'Credit Card', 1499.99, 'Completed', 'DEF789', 'Code Nexus', 'Michael Williams, 901 Pine St, Guelph, NL, UNITED KINGDOM, 09876', 'Laptop A, 1TB, Quantity: 1'),
(5, 5, 5, '2024-04-15', 'Credit Card', 2599.98, 'Completed', 'GHI101', 'Code Nexus', 'Emma Brown, 246 Maple St, Elmira, AB, GERMANY, 13579', 'Laptop B, 512GB, Quantity: 2');


