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
        $session->set('user_id', $user['id']);
        $session->set('user_name', $user['userName']);
        $messagey = "Login successful.";
        $success = true;
    } else {
        $messagey = "Invalid username/email or password.";
        $success = false;
    }

    $db = null;

    echo json_encode(['messagey' => $messagey, 'success' => $success]);
    exit;
}
?>

<?php function drawLogIn() { ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/login.css" rel="stylesheet">
        <title>BlazeDrive</title>
        <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <section>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/login.css" rel="stylesheet">
            <img class="logoinv" src="../docs/LogoInv.png" alt="Logo">
            <div id="messagey" class="error-message"></div>
            <form id="loginForm" class="loginForm" method="POST">
                <div class="input-wrapper">
                    <input type="text" id="userNameOrEmail" name="userNameOrEmail" class="information" required>
                    <span>Email or Username</span>
                </div>
                <br>
                <div class="input-wrapper">
                    <input type="password" id="pass" name="pass" class="information" required>
                    <span>Password</span>
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
                        $('#messagey').text(data.messagey);
                        if (data.success) {
                            $('#loginForm')[0].reset();
                            // Optionally redirect to another page
                            window.location.href = 'index.php';
                            !$session;
                        }
                    }
                });
            });
        });
    </script>
</html>
<?php } ?>