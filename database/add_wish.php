<?php
// Include the database connection file
require_once(__DIR__ . '/../database/connection.php');

// Check if the request method is POST and required parameters are provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['UserId']) && isset($_POST['VehicleId'])) {
    $UserId = $_POST['UserId'];
    $VehicleId = $_POST['VehicleId'];

    // Attempt to establish a database connection
    $db = getDatabaseConnection();

    // Check if the database connection is successful
    if (!$db) {
        echo json_encode(array('success' => false, 'text_message' => 'Unable to connect to the database.'));
        return;
    }

    echo "<script>console.log('eu estou aqui' );</script>";

    try {
        $stmt = $db->prepare("INSERT INTO Wishlist (UserId, VehicleId) VALUES (:UserId, :VehicleId)");
        $stmt->bindParam(':UserId', $UserId, PDO::PARAM_INT);
        $stmt->bindParam(':VehicleId', $VehicleId, PDO::PARAM_INT);
        $stmt->execute();

        // Return success response
        echo json_encode(array('success' => true));
    } catch (PDOException $e) {
        // Return error response
        echo json_encode(array('success' => false, 'text_message' => 'Failed to send text_message: ' . $e->getMessage()));
    }
} else {
    // Return error response if the required parameters are missing
    echo json_encode(array('success' => false, 'text_message' => 'Invalid request.'));
}
?>
