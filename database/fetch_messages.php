<?php
// Include the database connection file
require_once(__DIR__ . '/../database/connection.php');

// Check if the logged-in user ID and the given user ID are provided in the POST data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['currentUser']) && isset($_POST['UserId'])) {
    // Get the logged-in user ID and the given user ID from the POST data
    $currentUser = $_POST['currentUser'];
    $UserId = $_POST['UserId'];

    // Attempt to establish a database connection
    $db = getDatabaseConnection();

    // Check if the database connection is successful
    if (!$db) {
        echo "Error: Unable to connect to the database.";
        return;
    }

    // Fetch the chat ID based on the logged-in user ID and the given user ID
    try {
        // Prepare the SQL query to retrieve the chat ID
        $stmt = $db->prepare("SELECT ChatId FROM Chat WHERE (BuyerId = :currentUser AND SellerId = :UserId) OR (BuyerId = :UserId AND SellerId = :currentUser)");
        $stmt->bindParam(':currentUser', $currentUser, PDO::PARAM_INT);
        $stmt->bindParam(':UserId', $UserId, PDO::PARAM_INT);
        $stmt->execute();
        $chat = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($chat) {
            $ChatId = $chat['ChatId'];
            
 // Fetch all messages for the retrieved chat ID
            try {
                // Prepare the SQL query to retrieve messages
                $stmt = $db->prepare("SELECT Msg.*, User.named, User.UserId AS SenderId FROM Msg INNER JOIN User ON Msg.UserId = User.UserId WHERE ChatId = :ChatId");
                $stmt->bindParam(':ChatId', $ChatId, PDO::PARAM_INT);
                $stmt->execute();
                $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);

                // Output the messages in HTML format
                foreach ($messages as $message) {
                    $alignClass = ($message['SenderId'] == $currentUser) ? 'left' : 'right';
                    if(($message['SenderId'] == $currentUser))
                    {
                        echo '<div class="message ' . $alignClass . '">' . htmlspecialchars($message['named']) . ' - ' . htmlspecialchars($message['text_message']) . '</div>';

                    }
                   else{
                    echo '<div class="message ' . $alignClass . '">' . htmlspecialchars($message['text_message']) . ' - ' . htmlspecialchars($message['named']) . '</div>';

                   }
                }
            } catch (PDOException $e) {
                // Handle database errors
                echo "Error: " . $e->getMessage();
            }

        } else {
            echo "Error: Chat not found.";
        }
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
    }
} else {
    // Invalid request
    echo "Error: Invalid request.";
}
?>
