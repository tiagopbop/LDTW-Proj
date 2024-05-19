<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');

require_once(__DIR__ . '/../templates/common.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userNameOrEmail = $_POST["userNameOrEmail"] ?? '';
    $pass = $_POST["pass"] ?? '';

    $db = getDatabaseConnection();

    // Prepare and execute a query to find the user by username or email
    $stmt = $db->prepare("SELECT * FROM User WHERE userName = :userNameOrEmail OR email = :userNameOrEmail");
    $stmt->bindValue(':userNameOrEmail', $userNameOrEmail, PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($pass, $user['pass'])) {
        // Set session variables
        $session->setId((int)$user['UserId']);
        $session->setUsername($user['userName']);
        $message = "Login successful.";
        $success = true;
    } else {
        $message = "Invalid username/email or password.";
        $success = false;
    }

    $db = null;

    echo json_encode(['message' => $message, 'success' => $success]);
    exit;
}
?>

<?php function drawCreateAdmin() { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/login.css" rel="stylesheet">
    <title>BlazeDrive</title>
    <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <section>
        <img class="logoinv" src="../docs/LogoInv.png" alt="Logo">
        <div id="message" style="font-weight: bold;" class="error-message"></div>
        <form id="loginForm" class="loginForm" method="POST">
            <div class="input-wrapper">
                <input type="text" id="userNameOrEmail" name="userNameOrEmail" class="information" required>
                <span>Email or Username</span>
                <button type="submit">&#10162;</button>
            </div>
        </form>
    </section>
    <script>
        $(document).ready(function() {
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'login.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        const data = JSON.parse(response);
                        $('#message').text(data.message);
                        if (data.success) {
                            $('#message').css('color', 'green');
                            $('#loginForm')[0].reset();
                            // Redirect to another page on successful login
                            setTimeout(() => {  window.location.href = 'index.php'; }, 500);
                        } else {
                            $('#message').css('color', 'red');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
<?php } ?>
