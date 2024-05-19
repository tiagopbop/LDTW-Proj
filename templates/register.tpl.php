<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');

require_once(__DIR__ . '/../templates/common.php');

// Handle AJAX requests
if (isset($_GET["checkUsername"])) {
    $usernameToCheck = $_GET["checkUsername"] ?? '';

    $db = getDatabaseConnection();

    $stmt = $db->prepare("SELECT COUNT(*) AS count FROM User WHERE userName = :userName");
    $stmt->bindValue(':userName', $usernameToCheck, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $userNameExists = ($result['count'] > 0);

    echo json_encode(['userNameExists' => $userNameExists]);
    exit;
}

if (isset($_GET["checkEmail"])) {
    $emailToCheck = $_GET["checkEmail"] ?? '';

    $db = getDatabaseConnection();

    $stmt = $db->prepare("SELECT COUNT(*) AS count FROM User WHERE email = :email");
    $stmt->bindValue(':email', $emailToCheck, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $emailExists = ($result['count'] > 0);

    echo json_encode(['emailExists' => $emailExists]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["userName"] ?? '';
    $named = $_POST["named"] ?? '';
    $pass = $_POST["pass"] ?? '';
    $email = $_POST["email"] ?? '';

    $db = getDatabaseConnection();

    $stmt = $db->prepare("SELECT COUNT(*) AS count FROM User WHERE userName = :userName OR email = :email");
    $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
    $stmt->bindValue(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        $message = "Username or email is already in use.";
        $success = false;
    } else {
        $hashedPassword = password_hash($pass, PASSWORD_DEFAULT);
        $stmt = $db->prepare("INSERT INTO User (userName, named, pass, email, is_admin) VALUES (:userName, :named, :pass, :email, 0)");
        $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
        $stmt->bindValue(':named', $named, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $result = $stmt->execute();

        if ($result) {
            $message = "Registration successful.";
            $success = true;
        } else {
            $message = "Error registering user.";
            $success = false;
        }
    }

    $db = null;

    echo json_encode(['message' => $message, 'success' => $success]);
    exit;
}
?>

<?php function drawRegister() { ?>


<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/register.css" rel="stylesheet">
        <title>BlazeDrive</title>
        <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    </head>
    <body>
        <div id="message" style="color: yellow; z-index: 10; font-size: 10vw; height: 20vh;"></div>
        <section>
            <img class="logoinv" src="../docs/LogoInv.png" alt="Logo">
            <form id="registrationForm" method="POST" class="registerForm">
                <div class="input-wrapper">
                    <input type="text" id="named" name="named" class="information" required>
                    <span>Name</span>
                </div>
                <br><div class="input-wrapper">
                    <input type="text" id="userName" name="userName" class="information" required onkeyup="checkUsernameAvailability()">
                    <span>Username</span>
                </div>
                <span id="userNameMessage" style="color: red;"></span><br>
                <br>
                <div class="input-wrapper">
                    <input type="email" id="email" name="email" class="information" required onkeyup="checkEmailAvailability()">
                    <span>Email </span>
                </div>
                <span id="emailMessage" style="color: yellow; z-index: 10; font-size: 10vw; height: 20vh;"></span><br>
                <br>
                <div class="input-wrapper">
                    <input type="password" id="pass" name="pass" class="information" required>
                    <span>Password</span>
                </div>
                <br>
                <div class="input-wrapper">
                    <input type="password" id="pass" name="pass" class="information" required>
                    <span>Confirm Password</span>
                    <button type="submit" id="registerButton" value="Register">&#10162;</button>
                </div>
            </form>
        </section>
    </body>
    <script>
        function checkUsernameAvailability() {
            const username = $('#userName').val();
            if (username.length > 0) {
                $.ajax({
                    type: 'GET',
                    url: 'register.php',
                    data: { checkUsername: username },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.userNameExists) {
                            $('#userNameMessage').text('Username is already taken.');
                        } else {
                            $('#userNameMessage').text('');
                        }
                    }
                });
            }
        }

        function checkEmailAvailability() {
            const email = $('#email').val();
            if (email.length > 0) {
                $.ajax({
                    type: 'GET',
                    url: 'register.php',
                    data: { checkEmail: email },
                    success: function(response) {
                        const data = JSON.parse(response);
                        if (data.emailExists) {
                            $('#emailMessage').text('Email is already taken.');
                        } else {
                            $('#emailMessage').text('');
                        }
                    }
                });
            }
        }

        $(document).ready(function() {
            $('#registrationForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'register.php',
                    data: $(this).serialize(),
                    success: function(response) {
                        const data = JSON.parse(response);
                        $('#message').text(data.message);
                        if (data.success) {
                            $('#registrationForm')[0].reset();
                            $('#userNameMessage').text('');
                            $('#emailMessage').text('');
                        }
                    }
                });
            });
        });
    </script>
    
</html>
<?php } ?>


