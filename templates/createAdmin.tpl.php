<?php
declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');

require_once(__DIR__ . '/../templates/common.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userNameOrEmail = $_POST["userNameOrEmail"] ?? '';
    $pass = $_POST["pass"] ?? '';

    $db = getDatabaseConnection();

    // Function to check if a user exists by username or email
    function checkUserExists($userNameOrEmail, $db): bool {
        $stmt = $db->prepare("SELECT COUNT(*) FROM User WHERE is_admin != 1 AND userName = :userNameOrEmail OR email = :userNameOrEmail");
        $stmt->bindValue(':userNameOrEmail', $userNameOrEmail, PDO::PARAM_STR);
        $stmt->execute();
        $count = (int)$stmt->fetchColumn();
        return $count > 0;
    }

    // Check if user exists by username or email
    if (checkUserExists($userNameOrEmail, $db)) {
        // Update the is_admin value if the user exists
        $stmt = $db->prepare("UPDATE User SET is_admin = 1 WHERE userName = :userNameOrEmail OR email = :userNameOrEmail");
        $stmt->bindValue(':userNameOrEmail', $userNameOrEmail, PDO::PARAM_STR);
        $stmt->execute();

        $message = "User exists. Press Enter to create admin.";
        $success = true; // Corrected to true
    } else{
        $message = "User/email does not exist.";
        $success = false;
    }
    

    // Close database connection
    $db = null;

    echo json_encode(['message' => $message, 'success' => $success]);
    exit;
}
?>

<?php function drawCreateAdmin($id) { ?>
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
            let typingTimer;
            const doneTypingInterval = 500; // 0.5 second

            // On keyup, start the countdown
            $('#userNameOrEmail').on('keyup', function() {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(checkUserExists, doneTypingInterval);
            });

            // On keydown, clear the countdown
            $('#userNameOrEmail').on('keydown', function() {
                clearTimeout(typingTimer);
            });

            // Function to check user existence and display message
            function checkUserExists() {
                const userNameOrEmail = $('#userNameOrEmail').val().trim();
                if (userNameOrEmail !== '') {
                    $.ajax({
                        type: 'POST',
                        url: 'createAdmin.php',
                        data: { userNameOrEmail: userNameOrEmail },
                        success: function(response) {
                            const data = JSON.parse(response);
                            $('#message').text(data.message);
                            if (data.success) {
                                $('#message').css('color', 'green');
                            } else {
                                $('#message').css('color', 'red');
                            }
                        }
                    });
                }
            }

            // Form submission handler
            $('#loginForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'createAdmin.php',
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
