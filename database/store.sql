PRAGMA foreign_keys = ON;
DROP TABLE  IF EXISTS User;
DROP TABLE  IF EXISTS Brand;
DROP TABLE  IF EXISTS Category;
DROP TABLE  IF EXISTS Model;
DROP TABLE  IF EXISTS Color;
DROP TABLE  IF EXISTS Vehicle;
DROP TABLE  IF EXISTS Wishlist;
DROP TABLE  IF EXISTS Shopcar;
DROP TABLE  IF EXISTS Trans;
DROP TABLE  IF EXISTS Chat;
DROP TABLE  IF EXISTS Msg;
DROP TABLE  IF EXISTS Review;


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

CREATE TABLE Image(
    FOREIGN KEY (vehicleId) REFERENCES Vehicle(vehicleId),
    imageFilePath NVARCHAR(500) NOT NULL,
    PRIMARY KEY(vehicleId, imageFilePath)
);

CREATE TABLE Category(
    categoryId INTEGER PRIMARY KEY NOT NULL,
    categoryName NVARCHAR(30) NOT NULL,
    categoryFilePath TEXT NOT NULL
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
    CategoryId INTEGER,
    BrandId INTEGER,
    modelId INTEGER,
    colorId INTEGER,
    price INTEGER NOT NULL CHECK(price > 0),
    condition INTEGER NOT NULL CHECK(condition > 0 AND condition < 6),
    kilometers INTEGER,
    fuelType INTEGER NOT NULL CHECK(fuelType > 0 AND fuelType < 5),
    FOREIGN KEY(UserId) REFERENCES User(UserId),
    FOREIGN KEY(CategoryId) REFERENCES Category(categoryId),
    FOREIGN KEY(BrandId, modelId) REFERENCES Model(BrandId, modelId), -- Corrected foreign key reference
    FOREIGN KEY(colorId) REFERENCES Color(colorId)
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
