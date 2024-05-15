PRAGMA foreign_keys = ON;


-- Inserting 5 cases for User 'john_doe'
INSERT INTO User (UserId, userName, pass, email, is_admin) 
VALUES 
    (1,'john_doe', 'password123', 'john@example.com', 1),
    (2,'jane_smith', 'pass123', 'jane@example.com', 0),
    (3,'alex_brown', 'securepass', 'alex@example.com', 0),
    (4,'emma_davis', 'password', 'emma@example.com', 0),
    (5,'michael_wilson', 'p@$$w0rd', 'michael@example.com', 0);

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
INSERT INTO Model (modelId, BrandId, modelName) 
VALUES 
    (1, 1, 'Camry'),
    (2, 2, 'Corolla'),
    (3, 3, 'Accord'),
    (4, 4, 'Fusion'),
    (5, 5, 'Malibu');

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
INSERT INTO Review (ReviewId, UserId, VehicleId, Rating, Comment) 
VALUES 
    (1, 1, 1, 4, 'Great car, very satisfied with the purchase.'),
    (2, 2, 2, 5, 'Excellent service and quality.'),
    (3, 3, 3, 3, 'Decent vehicle, had some issues.'),
    (4, 4, 4, 2, 'Not happy with the purchase, had to return.'),
    (5, 5, 5, 4, 'Good experience overall, would recommend.');