<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.php'); // Make sure you have a script to establish a database connection

try {
    // Establish a database connection
    $db = new PDO('sqlite:../database/store.db');
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Get and sanitize form data
    $userId = 1; // Example user ID, replace with actual user ID from session or authentication system
    $typeId = intval($_POST['types']);
    $brandId = intval($_POST['brand']);
    $modelId = intval($_POST['model']);
    $colorId = intval($_POST['color']);
    $price = floatval($_POST['price']);
    $condition = intval($_POST['condition']);
    $kilometers = intval($_POST['kilometers']);
    $fuelType = intval($_POST['fuelType']);

    // Prepare and execute the SQL statement
    $stmt = $db->prepare('
        INSERT INTO Vehicle (UserId, typeId, BrandId, modelId, colorId, price, condition, kilometers, fuelType)
        VALUES (:userId, :typeId, :brandId, :modelId, :colorId, :price, :condition, :kilometers, :fuelType)
    ');

    $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
    $stmt->bindParam(':typeId', $typeId, PDO::PARAM_INT);
    $stmt->bindParam(':brandId', $brandId, PDO::PARAM_INT);
    $stmt->bindParam(':modelId', $modelId, PDO::PARAM_INT);
    $stmt->bindParam(':colorId', $colorId, PDO::PARAM_INT);
    $stmt->bindParam(':price', $price, PDO::PARAM_STR);
    $stmt->bindParam(':condition', $condition, PDO::PARAM_INT);
    $stmt->bindParam(':kilometers', $kilometers, PDO::PARAM_INT);
    $stmt->bindParam(':fuelType', $fuelType, PDO::PARAM_INT);

    $stmt->execute();

    // Redirect or notify the user after successful insertion
    header('Location: ../pages/index.php');
    exit();

} catch (PDOException $e) {
    // Handle any errors
    echo 'Error: ' . $e->getMessage();
}
?>
