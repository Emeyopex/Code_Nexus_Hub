-- CREATE DATABASE code_nexus_hub;
-- CODE_NEXUS HUB: EME EKPENYONG - 8742505 

USE code_nexus_hub;

-- Brand table insertion
INSERT INTO `brand` (`Brand_ID`, `Brand`)
VALUES
(1, 'Apple'),
(2, 'Samsung'),
(3, 'Google'),
(4, 'Microsoft'),
(5, 'Nokia');

-- Manufacturer table insertion
INSERT INTO `manufacturer` (`Manufacturer_ID`, `Manufacturer`)
VALUES
(1, 'Foxconn'),
(2, 'Samsung'),
(3, 'HTC'),
(4, 'Sony'),
(5, 'Lenovo');



-- Product table insertion
INSERT INTO `product` (`Product_ID`, `Model`, `Storage`, `Price`, `Qty`, `Brand_ID`, `Manufacturer_ID`)
VALUES
(1, 'iPhone 12', '128GB', 800, 2, 1, 1),
(2, 'Galaxy S20', '256GB', 1200, 1, 2, 2),
(3, 'Pixel 7', '64GB', 700, 2, 3, 3),
(4, 'iPhone 14', '256GB', 1300, 3, 1, 1),
(5, 'Galaxy S22', '128GB', 1300, 2, 2, 2),
(6, 'Pixel 5', '256GB', 1100, 1, 3, 3),
(7, 'iPhone 15', '256GB', 1560, 1, 1, 1);


-- Customer table insertion
INSERT INTO `customer` (`Cust_ID`, `cust_firstName`, `cust_lastName`, `Email_Address`, `Address`, `Phone_Number`)
VALUES
(1, 'John', 'Smith', 'j.smith@gmail.com', '123 Columbia Street', '123456789'),
(2, 'Alice', 'Jackson', 'a.jackson@gmail.com', '123 Sunview Street', '213456789'),
(3, 'Alice', 'Brown', 'a.brown@gmail.com', '123 Cedabrae Street', '321456789'),
(4, 'Sally', 'White', 's.white@gmail.com', '123 HighWay 7', '432156789'),
(5, 'Emily', 'Clarke', 'e.clarke@gmail.com', '123 Lester Street', '543216789'),
(6, 'Michael', 'Jordan', 'm.jordan@gmail.com', '123 King Street', '654321789'),
(7, 'Eme', 'Ekpenyong', 'e.ekpenyong@gmail.com', '123 Weber Street', '765432189');

select * from customer;

-- Invoice table insertion
INSERT INTO `invoice` (`Invoice_ID`, `Cust_ID`, `Product_ID`, `Qty`, `Total_Price`, `Date`)
VALUES
(1, 1, 1, 2, 1600, '2024-04-01'),
(2, 2, 2, 1, 1200, '2024-04-02'),
(3, 3, 3, 2, 1400, '2024-04-03'),
(4, 4, 4, 3, 3900, '2024-04-04'),
(5, 5, 5, 2, 2200, '2024-04-05'),
(6, 6, 6, 1, 1100, '2024-04-24'),
(7, 7, 7, 1, 1560, '2024-04-07');


select * from customer;