PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Brand;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Model;
DROP TABLE IF EXISTS Color;
DROP TABLE IF EXISTS Vehicle;
DROP TABLE IF EXISTS Wishlist;
DROP TABLE IF EXISTS Shopcar;
DROP TABLE IF EXISTS Trans;
DROP TABLE IF EXISTS Chat;
DROP TABLE IF EXISTS Msg;
DROP TABLE IF EXISTS Review;





CREATE TABLE User(
    UserId INTEGER PRIMARY KEY NOT NULL,
    userName NVARCHAR(100) NOT NULL,
    pass NVARCHAR(100) NOT NULL,
    email NVARCHAR(100) NOT NULL,
    is_admin BOOLEAN NOT NULL,
    creattion_date DATE NOT NULL
);

CREATE TABLE Brand(
    BrandId INTEGER PRIMARY KEY NOT NULL,
    BrandName NVARCHAR(25) NOT NULL,
    logoFilePath NVARCHAR(500) NOT NULL
);

CREATE TABLE Category(
    categoryId INTEGER PRIMARY KEY NOT NULL,
    categoryName NVARCHAR(30) NOT NULL;
    categoryFilePath TEXT NOT NULL
);
CREATE TABLE Model(
    modelId INTEGER NOT NULL;
    FOREIGN KEY (BrandId) REFERENCES Brand(BrandId),
    modelName TEXT NOT NULL,
    PRIMARY KEY(BrandId, modelId)

);
CREATE TABLE Color(
    colorId INTEGER PRIMARY KEY NOT NULL,
    colorName TEXT NOT NULL
);

CREATE TABLE Vehicle(
    VehicleId INTEGER PRIMARY KEY NOT NULL,
    FOREIGN KEY(UserId) REFERENCES User(UserId),
    FOREIGN KEY (CategoryId) REFERENCES Category(CategoryId),
    FOREIGN KEY (BrandId) REFERENCES Brand(BrandId),
    FOREIGN KEY (modelId) REFERENCES Model(modelId),
    FOREIGN KEY (color) REFERENCES Color(colorId),
    price INTEGER NOT NULL CHECK(price > 0),
    condition INTEGER NOT NULL CHECK(condition > 0 AND condition < 6),
    kilometers INTEGER,
    fuelType INTEGER NOT NULL CHECK(fuelType > 0 AND fuelType <5)
);

CREATE TABLE Wishlist(
    FOREIGN KEY (UserId) REFERENCES User(UserId),
    FOREIGN KEY (VehicleId) REFERENCES Vehicle(VehicleId),
    PRIMARY KEY(UserId,VehicleId);
);

CREATE TABLE Shopcar(
    FOREIGN KEY (UserId) REFERENCES User(UserId),
    FOREIGN KEY (VehicleId) REFERENCES Vehicle(VehicleId),
    PRIMARY KEY(UserId,VehicleId)
);

CREATE TABLE Trans(
    transactionId INTEGER PRIMARY KEY NOT NULL,
    FOREIGN KEY (BuyerId) REFERENCES User(UserId),
    FOREIGN KEY (SellerId) REFERENCES User(UserId),
    FOREIGN KEY (VehicleId) REFERENCES Vehicle(VehicleId),
    CONSTRAINT different_buyer_seller CHECK BuyerId <> SellerId
);

CREATE TABLE Chat(
    ChatId INTEGER PRIMARY KEY NOT NULL,
    FOREIGN KEY (BuyerId) REFERENCES User(UserId),
    FOREIGN KEY (SellerId) REFERENCES User(UserId),
    CONSTRAINT different_buyer_seller CHECK BuyerId <> SellerId
);

CREATE TABLE Msg(
    MessageId INTEGER NOT NULL;
    FOREIGN KEY (ChatId) REFERENCES Chat(ChatId),
    FOREIGN KEY (UserId) REFERENCES User(UserId),
    when_sent DATETIME NOT NULL,
    text_message NVARCHAR(500) NOT NULL,
    PRIMARY KEY(MessageId,ChatId)
);

CREATE TABLE Review(
    IdReview INTEGER PRIMARY KEY NOT NULL,
    FOREIGN KEY (UserId) REFERENCES User(UserId),
    FOREIGN KEY (VehicleId) REFERENCES Vehicle(VehicleId),
    Rating INTEGER NOT NULL CHECK(Rating > 0 AND Rating < 6),
    Comment NVARCHAR(300),
    CONSTRAINT unique_user UNIQUE(UserId, VehicleId)
);
















-- Inserting 5 cases for User 'john_doe'
INSERT INTO User (userName, pass, email, is_admin, creattion_date) 
VALUES 
    ('john_doe', 'password123', 'john@example.com', 1, '2024-04-19'),
    ('jane_smith', 'pass123', 'jane@example.com', 0, '2024-04-20'),
    ('alex_brown', 'securepass', 'alex@example.com', 0, '2024-04-21'),
    ('emma_davis', 'password', 'emma@example.com', 0, '2024-04-22'),
    ('michael_wilson', 'p@$$w0rd', 'michael@example.com', 0, '2024-04-23');

-- Inserting 5 cases for Brand 'Toyota'
INSERT INTO Brand (BrandId, BrandName, logoFilePath) 
VALUES 
    (1, 'Toyota', '/path/to/toyota_logo.png'),
    (2, 'Honda', '/path/to/honda_logo.png'),
    (3, 'Ford', '/path/to/ford_logo.png'),
    (4, 'Chevrolet', '/path/to/chevrolet_logo.png'),
    (5, 'BMW', '/path/to/bmw_logo.png');

-- Inserting 5 cases for Category 'SUV'
INSERT INTO Category (categoryId, categoryName, categoryFilePath) 
VALUES 
    (1, 'SUV', '/path/to/suv_category.png'),
    (2, 'Sedan', '/path/to/sedan_category.png'),
    (3, 'Truck', '/path/to/truck_category.png'),
    (4, 'Hatchback', '/path/to/hatchback_category.png'),
    (5, 'Coupe', '/path/to/coupe_category.png');

-- Inserting 5 cases for Model 'Camry'
INSERT INTO Model (ModelId, BrandId, modelName) 
VALUES 
    (1, 1, 'Camry'),
    (2, 1, 'Corolla'),
    (3, 2, 'Accord'),
    (4, 3, 'Fusion'),
    (5, 4, 'Malibu');

-- Inserting 5 cases for Color 'Red'
INSERT INTO Color (colorId, colorName) 
VALUES 
    (1, 'Red'),
    (2, 'Blue'),
    (3, 'Black'),
    (4, 'White'),
    (5, 'Silver');

-- Inserting 5 cases for Vehicle with ID 1
INSERT INTO Vehicle (VehicleId,UserId, CategoryId, BrandId, modelId, colorId, price, condition, kilometers, fuelType) 
VALUES 
    (1,1, 1, 1, 1, 1, 25000, 4, 50000, 2),
    (2,2, 2, 2, 2, 2, 30000, 3, 60000, 3),
    (3,3, 3, 3, 3, 3, 35000, 2, 70000, 4),
    (4,4, 4, 4, 4, 4, 40000, 1, 80000, 1),
    (5,5, 5, 5, 5, 5, 45000, 5, 90000, 2);

-- Inserting 5 cases for Wishlist for User ID 1
INSERT INTO Wishlist (UserId, VehicleId) 
VALUES 
    (1, 1),
    (1, 2),
    (1, 3),
    (1, 4),
    (1, 5);

-- Inserting 5 cases for Shopcar for User ID 1
INSERT INTO Shopcar (UserId, VehicleId) 
VALUES 
    (1, 1),
    (1, 2),
    (1, 3),
    (1, 4),
    (1, 5);

-- Inserting 5 cases for Trans
INSERT INTO Trans (transactionId, BuyerId, SellerId, VehicleId) 
VALUES 
    (1, 1, 2, 1),
    (2, 2, 3, 2),
    (3, 3, 4, 3),
    (4, 4, 5, 4),
    (5, 5, 1, 5);

-- Inserting 5 cases for Chat
INSERT INTO Chat (ChatId, BuyerId, SellerId) 
VALUES 
    (1, 1, 2),
    (2, 2, 3),
    (3, 3, 4),
    (4, 4, 5),
    (5, 5, 1);

-- Inserting 5 cases for Msg
INSERT INTO Msg (MessageId, ChatId, UserId, when_sent, text_message) 
VALUES 
    (1, 1, 1, '2024-04-19 10:00:00', 'Hello, I am interested in your vehicle.'),
    (2, 2, 2, '2024-04-20 11:00:00', 'Sure, let me know if you have any questions.'),
    (3, 3, 3, '2024-04-21 12:00:00', 'I can offer you a discount if you buy today.'),
    (4, 4, 4, '2024-04-22 13:00:00', 'I need more information about the maintenance history.'),
    (5, 5, 5, '2024-04-23 14:00:00', 'Is the price negotiable?');

-- Inserting 5 cases for Review
INSERT INTO Review (IdReview, UserId, VehicleId, Rating, Comment) 
VALUES 
    (1, 1, 1, 4, 'Great car, very satisfied with the purchase.'),
    (2, 2, 2, 5, 'Excellent service and quality.'),
    (3, 3, 3, 3, 'Decent vehicle, had some issues.'),
    (4, 4, 4, 2, 'Not happy with the purchase, had to return.'),
    (5, 5, 5, 4, 'Good experience overall, would recommend.');