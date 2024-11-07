CREATE TABLE Customer(
    CustomerID INT PRIMARY KEY AUTO_INCREMENT,
    CustomerName VARCHAR(50),
    ContactNumber VARCHAR(50),
    Email VARCHAR(100),
    Address VARCHAR(15),
    City VARCHAR(100),
    RegistrationDate DATE DEFAULT CURRENT_DATE
);

CREATE TABLE ClothingShop (
    ProductID INT PRIMARY KEY AUTO_INCREMENT,
    CustomerID INT,
    ProductName VARCHAR(100) NOT NULL,
    Size VARCHAR(10),
    Color VARCHAR(30),
    Price DECIMAL(10, 2) NOT NULL,
    StockQuantity INT NOT NULL,
    dateRegistered DATE DEFAULT CURRENT_DATE
);