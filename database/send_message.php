<?php
// Include the database connection file
require_once(__DIR__ . '/../database/connection.php');
// Check if the request method is POST and required parameters are provided
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['currentUser']) && isset($_POST['UserId'])&&isset($_POST['message'])) {
    // Get the logged-in user ID, the given user ID, the chat ID, and the message content from the POST data
    
    $currentUser = $_POST['currentUser'];
    $UserId = $_POST['UserId'];
    $message = $_POST['message'];
    // Attempt to establish a database connection
    $db = getDatabaseConnection();

    // Check if the database connection is successful
    if (!$db) {
        echo json_encode(array('success' => false, 'message' => 'Unable to connect to the database.'));
        return;
    }
    // Prepare the SQL query to retrieve the chat ID
    $stmt = $db->prepare("SELECT ChatId FROM Chat WHERE (BuyerId = :currentUser AND SellerId = :UserId) OR (BuyerId = :UserId AND SellerId = :currentUser)");
    $stmt->bindParam(':currentUser', $currentUser, PDO::PARAM_INT);
    $stmt->bindParam(':UserId', $UserId, PDO::PARAM_INT);
    $stmt->execute();
    $chat = $stmt->fetch(PDO::FETCH_ASSOC);
    $ChatId = $chat['ChatId'];
    // Insert the message into the Msg table
    try {

        $stmt = $db->prepare("INSERT INTO Msg (ChatId, UserId, text_message) VALUES (:ChatId, :UserId, :message)");
        $stmt->bindParam(':ChatId', $ChatId, PDO::PARAM_INT);
        $stmt->bindParam(':UserId', $currentUser, PDO::PARAM_INT);
        $stmt->bindParam(':message', $message, PDO::PARAM_STR);
        $stmt->execute();

        // Return success response
        echo json_encode(array('success' => true));
    } catch (PDOException $e) {
        // Return error response
        echo json_encode(array('success' => false, 'message' => 'Failed to send message: ' . $e->getMessage()));
    }
} else {
    // Return error response if the required parameters are missing
    echo json_encode(array('success' => false, 'message' => 'Invalid request.'));
}
?>
