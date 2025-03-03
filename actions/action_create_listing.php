<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/connection.php'); // Make sure you have a script to establish a database connection
require_once(__DIR__ . '/../utils/session.php');

try {

    // Establish a database connection
    $db = getDatabaseConnection();

    // Get and sanitize form data
    $userId = intval(Session::getId());
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

    $vehicleId = $db->lastInsertId();

    $imagesDir = __DIR__ . '/../productImages';
    if (!is_dir($imagesDir)) {
        if (!mkdir($imagesDir, 0777, true)) {
            throw new Exception('Failed to create directory: ' . $imagesDir);
        }
    }

    // Check for file upload errors
    foreach ($_FILES['images']['error'] as $key => $error) {
        if ($error != UPLOAD_ERR_OK) {
            throw new Exception('File upload error for file ' . $_FILES['images']['name'][$key] . ': ' . $error);
        }
    }

    $imageNumber = 1;
    foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
        if (is_uploaded_file($tmpName)) {
            // Convert the image to JPEG format
            $image = imagecreatefromstring(file_get_contents($tmpName));
            if ($image === false) {
                throw new Exception('Failed to create image from file: ' . $_FILES['images']['name'][$key]);
            }

            $fileName = $vehicleId . '-' . $imageNumber . '.jpg';
            $destination = $imagesDir . '/' . $fileName;

            // Save the JPEG image
            if (!imagejpeg($image, $destination)) {
                throw new Exception('Failed to save image: ' . $fileName);
            }

            // Free up memory
            imagedestroy($image);

            // Insert the image path into the database
            $stmt = $db->prepare('INSERT INTO Images (VehicleId, imageFilePath) VALUES (:vehicleId, :filePath)');
            $stmt->bindParam(':vehicleId', $vehicleId, PDO::PARAM_INT);
            $stmt->bindParam(':filePath', $fileName, PDO::PARAM_STR);
            $stmt->execute();

            $imageNumber++;
        } else {
            throw new Exception('Potential file upload attack for file: ' . $_FILES['images']['name'][$key]);
        }
    }

    // Redirect or notify the user after successful insertion
    header('Location: ../pages/index.php');
    exit();

} catch (Exception $e) {
    // Handle any errors
    echo 'Error: ' . $e->getMessage();
}
?>
