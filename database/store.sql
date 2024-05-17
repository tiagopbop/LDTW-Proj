PRAGMA foreign_keys = ON;

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Brand;
DROP TABLE IF EXISTS Category;
DROP TABLE IF EXISTS Types;
DROP TABLE IF EXISTS Model;
DROP TABLE IF EXISTS Color;
DROP TABLE IF EXISTS Vehicle;
DROP TABLE IF EXISTS Wishlist;
DROP TABLE IF EXISTS Shopcar;
DROP TABLE IF EXISTS Trans;
DROP TABLE IF EXISTS Chat;
DROP TABLE IF EXISTS Msg;
DROP TABLE IF EXISTS Review;
DROP TABLE IF EXISTS Images;

CREATE TABLE User(
    UserId INTEGER PRIMARY KEY NOT NULL,
    userName NVARCHAR(100) NOT NULL,
    pass NVARCHAR(100) NOT NULL,
    email NVARCHAR(100) NOT NULL,
    is_admin BOOLEAN NOT NULL
);

CREATE TABLE Brand(
    BrandId INTEGER PRIMARY KEY NOT NULL,
    BrandName NVARCHAR(25) NOT NULL,
    logoFilePath NVARCHAR(500) NOT NULL
);

CREATE TABLE Category(
    categoryId INTEGER PRIMARY KEY NOT NULL,
    categoryName NVARCHAR(30) NOT NULL,
    categoryFilePath TEXT NOT NULL
);

CREATE TABLE Types(
    typeId INTEGER PRIMARY KEY NOT NULL,
    typeName TEXT NOT NULL,
    categoryId INTEGER NOT NULL,
    FOREIGN KEY (categoryId) REFERENCES Category(categoryId)
);

CREATE TABLE Model(
    BrandId INTEGER NOT NULL,
    modelId INTEGER NOT NULL,
    modelName NVARCHAR(100) NOT NULL,
    PRIMARY KEY(BrandId, modelId),
    FOREIGN KEY (BrandId) REFERENCES Brand(BrandId)
);

CREATE TABLE Color(
    colorId INTEGER PRIMARY KEY NOT NULL,
    colorName TEXT NOT NULL
);

CREATE TABLE Vehicle(
    VehicleId INTEGER PRIMARY KEY NOT NULL,
    UserId INTEGER,
    typeId INTEGER,
    BrandId INTEGER,
    modelId INTEGER,
    colorId INTEGER,
    price INTEGER NOT NULL CHECK(price > 0),
    condition INTEGER NOT NULL CHECK(condition > 0 AND condition < 6),
    kilometers INTEGER,
    fuelType INTEGER NOT NULL CHECK(fuelType > 0 AND fuelType < 5),
    FOREIGN KEY(UserId) REFERENCES User(UserId),
    FOREIGN KEY(typeId) REFERENCES Types(typeId), 
    FOREIGN KEY(BrandId, modelId) REFERENCES Model(BrandId, modelId),
    FOREIGN KEY(colorId) REFERENCES Color(colorId)
);

CREATE TABLE Images(
    VehicleId INTEGER,
    imageFilePath NVARCHAR(500) NOT NULL,
    FOREIGN KEY (VehicleId) REFERENCES Vehicle(VehicleId),
    PRIMARY KEY(VehicleId, imageFilePath)
);

CREATE TABLE Wishlist(
    UserId INTEGER,
    VehicleId INTEGER,
    FOREIGN KEY (UserId) REFERENCES User(UserId),
    FOREIGN KEY (VehicleId) REFERENCES Vehicle(VehicleId),
    PRIMARY KEY(UserId,VehicleId)
);

CREATE TABLE Shopcar(
    UserId INTEGER,
    VehicleId INTEGER,
    FOREIGN KEY (UserId) REFERENCES User(UserId),
    FOREIGN KEY (VehicleId) REFERENCES Vehicle(VehicleId),
    PRIMARY KEY(UserId,VehicleId)
);

CREATE TABLE Trans(
    transactionId INTEGER PRIMARY KEY NOT NULL,
    BuyerId INTEGER,
    SellerId INTEGER,
    VehicleId INTEGER,
    FOREIGN KEY (BuyerId) REFERENCES User(UserId),
    FOREIGN KEY (SellerId) REFERENCES User(UserId),
    FOREIGN KEY (VehicleId) REFERENCES Vehicle(VehicleId),
    CONSTRAINT different_buyer_seller CHECK (BuyerId <> SellerId)
);

CREATE TABLE Chat(
    ChatId INTEGER PRIMARY KEY NOT NULL,
    BuyerId INTEGER,
    SellerId INTEGER,
    FOREIGN KEY (BuyerId) REFERENCES User(UserId),
    FOREIGN KEY (SellerId) REFERENCES User(UserId),
    CONSTRAINT different_buyer_seller CHECK (BuyerId <> SellerId)
);

CREATE TABLE Msg(
    MessageId INTEGER PRIMARY KEY NOT NULL,
    ChatId INTEGER,
    UserId INTEGER,
    when_sent DATETIME NOT NULL,
    text_message NVARCHAR(500) NOT NULL,
    FOREIGN KEY (ChatId) REFERENCES Chat(ChatId),
    FOREIGN KEY (UserId) REFERENCES User(UserId)
);

CREATE TABLE Review(
    ReviewId INTEGER PRIMARY KEY NOT NULL,
    UserId INTEGER,
    VehicleId INTEGER,
    Rating INTEGER NOT NULL CHECK (Rating > 0 AND Rating < 6),
    Comment NVARCHAR(300),
    FOREIGN KEY (UserId) REFERENCES User(UserId),
    FOREIGN KEY (VehicleId) REFERENCES Vehicle(VehicleId),
    CONSTRAINT unique_user_vehicle UNIQUE (UserId, VehicleId)
);

PRAGMA foreign_keys = ON;

-- Inserções de exemplo usando a função datetime

INSERT INTO User (UserId, userName, pass, email, is_admin) 
VALUES 
    (1,'john_doe', 'password123', 'john@example.com', 1),
    (2,'jane_smith', 'pass123', 'jane@example.com', 0),
    (3,'alex_brown', 'securepass', 'alex@example.com', 0),
    (4,'emma_davis', 'password', 'emma@example.com', 0),
    (5,'michael_wilson', 'p@$$w0rd', 'michael@example.com', 0);

INSERT INTO Brand (BrandId, BrandName, logoFilePath) 
VALUES 
    (1, 'Toyota', '/path/to/toyota_logo.png'),
    (2, 'Honda', '/path/to/honda_logo.png'),
    (3, 'Ford', '/path/to/ford_logo.png'),
    (4, 'Chevrolet', '/path/to/chevrolet_logo.png'),
    (5, 'BMW', '/path/to/bmw_logo.png');

INSERT INTO Category (categoryId, categoryName, categoryFilePath) 
VALUES 
    (1, 'Land', '/path/to/suv_category.png'),
    (2, 'Water', '/path/to/sedan_category.png'),
    (3, 'Air', '/path/to/truck_category.png');


INSERT INTO Types (typeId, typeName, categoryId) 
VALUES 
    (1,'Car', 1),
    (2,'Bike', 1),
    (3,'Truck', 1),
    (4,'Boat', 2),
    (5,'Submarine', 2),
    (6,'Waterbike', 2),
    (7,'Plane', 3),
    (8,'Helicopter', 3),
    (9,'Rocket', 3);



INSERT INTO Model (modelId, BrandId, modelName) 
VALUES 
    (1, 1, 'Camry'),
    (2, 2, 'Corolla'),
    (3, 3, 'Accord'),
    (4, 4, 'Fusion'),
    (5, 5, 'Malibu');

INSERT INTO Color (colorId, colorName) 
VALUES 
    (1, 'Red'),
    (2, 'Blue'),
    (3, 'Black'),
    (4, 'White'),
    (5, 'Silver');

INSERT INTO Vehicle (VehicleId,UserId, typeId, BrandId, modelId, colorId, price, condition, kilometers, fuelType) 
VALUES 
    (1,1, 1, 1, 1, 1, 25000, 4, 50000, 2),
    (2,2, 2, 2, 2, 2, 30000, 3, 60000, 3),
    (3,3, 3, 3, 3, 3, 35000, 2, 70000, 4),
    (4,4, 4, 4, 4, 4, 40000, 1, 80000, 1),
    (5,5, 5, 5, 5, 5, 45000, 5, 90000, 2);

INSERT INTO Wishlist (UserId, VehicleId) 
VALUES 
    (1, 1),
    (1, 2),
    (1, 3),
    (1, 4),
    (1, 5);

INSERT INTO Shopcar (UserId, VehicleId) 
VALUES 
    (1, 1),
    (1, 2),
    (1, 3),
    (1, 4),
    (1, 5);

INSERT INTO Trans (transactionId, BuyerId, SellerId, VehicleId) 
VALUES 
    (1, 1, 2, 1),
    (2, 2, 3, 2),
    (3, 3, 4, 3),
    (4, 4, 5, 4),
    (5, 5, 1, 5);

INSERT INTO Chat (ChatId, BuyerId, SellerId) 
VALUES 
    (1, 1, 2),
    (2, 2, 3),
    (3, 3, 4),
    (4, 4, 5),
    (5, 5, 1);

INSERT INTO Msg (MessageId, ChatId, UserId, when_sent, text_message) 
VALUES 
    (1, 1, 1, datetime('now'), 'Hello, I am interested in your vehicle.'),
    (2, 2, 2, datetime('now'), 'Sure, let me know if you have any questions.'),
    (3, 3, 3, datetime('now'), 'I can offer you a discount if you buy today.'),
    (4, 4, 4, datetime('now'), 'I need more information about the maintenance history.'),
    (5, 5, 5, datetime('now'), 'Is the price negotiable?');

INSERT INTO Review (ReviewId, UserId, VehicleId, Rating, Comment) 
VALUES 
    (1, 1, 1, 4, 'Great car, very satisfied with the purchase.'),
    (2, 2, 2, 5, 'Excellent service and quality.'),
    (3, 3, 3, 3, 'Decent vehicle, had some issues.'),
    (4, 4, 4, 2, 'Not happy with the purchase, had to return.'),
    (5, 5, 5, 4, 'Good experience overall, would recommend.');
