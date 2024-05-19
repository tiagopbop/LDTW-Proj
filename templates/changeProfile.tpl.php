<?php
declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
$session = new Session();

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');

require_once(__DIR__ . '/../templates/common.php');

// Check if user is logged in
if (!$session->isLoggedIn()) {
    header('Location: login.php');
    exit();
}

$userId = $session->getId();
$db = getDatabaseConnection();

if (isset($_GET["checkUsername"])) {
    $usernameToCheck = $_GET["checkUsername"] ?? '';

    $stmt = $db->prepare("SELECT COUNT(*) AS count FROM User WHERE userName = :userName AND id != :userId");
    $stmt->bindValue(':userName', $usernameToCheck, PDO::PARAM_STR);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $userNameExists = ($result['count'] > 0);

    echo json_encode(['userNameExists' => $userNameExists]);
    exit;
}

if (isset($_GET["checkEmail"])) {
    $emailToCheck = $_GET["checkEmail"] ?? '';

    $stmt = $db->prepare("SELECT COUNT(*) AS count FROM User WHERE email = :email AND id != :userId");
    $stmt->bindValue(':email', $emailToCheck, PDO::PARAM_STR);
    $stmt->bindValue(':userId', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    $emailExists = ($result['count'] > 0);

    echo json_encode(['emailExists' => $emailExists]);
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["userName"] ?? '';
    $named = $_POST["named"] ?? '';
    $email = $_POST["email"] ?? '';
    $currentPass = $_POST["currentPass"] ?? '';
    $newPass = $_POST["newPass"] ?? '';
    $confirmNewPass = $_POST["confirmNewPass"] ?? '';

    $stmt = $db->prepare("SELECT * FROM User WHERE id = :id");
    $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($currentPass, $user['pass'])) {
        if ($newPass !== '' && $newPass === $confirmNewPass) {
            $hashedPassword = password_hash($newPass, PASSWORD_DEFAULT);
        } else {
            $hashedPassword = $user['pass'];
        }

        $stmt = $db->prepare("UPDATE User SET userName = :userName, named = :named, pass = :pass, email = :email WHERE id = :id");
        $stmt->bindValue(':userName', $userName, PDO::PARAM_STR);
        $stmt->bindValue(':named', $named, PDO::PARAM_STR);
        $stmt->bindValue(':pass', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':id', $userId, PDO::PARAM_INT);
        $result = $stmt->execute();

        if ($result) {
            $message = "Profile updated successfully.";
            $success = true;
        } else {
            $message = "Error updating profile.";
            $success = false;
        }
    } else {
        $message = "Current password is incorrect.";
        $success = false;
    }

    echo json_encode(['message' => $message, 'success' => $success]);
    exit;
}
?>

<?php function drawProfileUpdate() { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/changeProfile.css" rel="stylesheet">
    <title>BlazeDrive</title>
    <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>
    <section>
        <img class="pfp" src="../docs/pfp_placeholder.png" alt="pfp">
        <form id="profileUpdateForm" method="POST" class="profileForm">
            <div class="input-wrapper">
                <input type="text" id="named" name="named" class="information" required>
                <span class="change nm">Edit name</span>
            </div>
            <br>
            <div class="input-wrapper">
                <input type="text" id="userName" name="userName" class="information" required onkeyup="checkUsernameAvailability()">
                <span class="change usr">Edit username</span>
            </div>
            <span id="userNameMessage" style="color: red; font-weight: bold;"></span><br>
            <br>
            <div class="input-wrapper">
                <input type="email" id="email" name="email" class="information" required onkeyup="checkEmailAvailability()">
                <span class="change eml">Edit email</span>
            </div>
            <span id="emailMessage" style="color: red; font-weight: bold;"></span><br>
            <br>
            <div class="input-wrapper">
                <input type="password" id="currentPass" name="currentPass" class="information" required>
                <span class="change psswrd">Current password</span>
            </div>
            <br>
            <div class="input-wrapper">
                <input type="password" id="newPass" name="newPass" class="information">
                <span>New Password (optional)</span>
            </div>
            <br>
            <div class="input-wrapper">
                <input type="password" id="confirmNewPass" name="confirmNewPass" class="information">
                <span>Confirm New Password</span>
                <button type="submit" id="updateButton" value="Update">&#10162;</button>
            </div>
            <br>
            <div id="message" style="color: green; font-weight: bold;"></div>
        </form>
    </section>
    <script>
        function checkUsernameAvailability() {
            const username = $('#userName').val();
            if (username.length > 0) {
                $.ajax({
                    type: 'GET',
                    url: 'changeProfile.php',
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
                    url: 'changeProfile.php',
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
            $('#profileUpdateForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'changeProfile.php',
                    data: $(this).serialize(),
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
            });

            // Fetch and fill user data
            $.ajax({
                type: 'GET',
                url: 'changeProfile.php',
                dataType: 'json',
                success: function(response) {
                    $('#named').val(response.named);
                    $('#userName').val(response.userName);
                    $('#email').val(response.email);
                }
            });
        });
    </script>
</body>
</html>
<?php } ?>
