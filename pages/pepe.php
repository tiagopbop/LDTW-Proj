<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');

require_once(__DIR__ . '/../templates/common.php');

$dbFile = 'store.db';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $userName = $_POST["userName"] ?? '';
    $pass = $_POST["pass"] ?? '';
    $email = $_POST["email"] ?? '';

    // Open connection to the SQLite database
    $db = getDatabaseConnection();

    // Hash the password for security
    $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);

    // Construct SQL query
    $sql = "INSERT INTO User (userName, pass, email, is_admin) VALUES ('$userName', '$hashedPassword', '$email', 0)";

    // Execute the statement
    $result = $db->exec($sql);

    // Check if insertion was successful
    if($result) {
        $message = "Registration successful.";
    } else {
        $message = "Error registering user.";
    }

    // Close the database connection
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
</head>
<body>
    <h2>User Registration</h2>
    <?php if(isset($message)) echo "<p>$message</p>"; ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <label for="userName">Username:</label><br>
        <input type="text" id="userName" name="userName" required><br><br>

        <label for="pass">Password:</label><br>
        <input type="password" id="pass" name="pass" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
