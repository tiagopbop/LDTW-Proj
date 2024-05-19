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

<?php function drawProfile() { ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/profile.css" rel="stylesheet">
    <title>BlazeDrive</title>
    <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
</head>
<body>
    <section class="wall">
    <img class="pfp" src="../docs/pfp_placeholder.png" alt="pfp">
            <span class="data name">Julius César</span>
            <span class="data username">GatinhoNeon123</span>
            <span class="data email">email_exemplo@arroba.com</span>
            <span class="data password">Wuant123</span>
            <a href="../pages/changeProfile.php"><span class="change">Change user info </span></a>
            

        <form method="POST" action="../pages/logout.php" style="display:inline;">
            <button class="logout" type="submit" class="logout">Logout</button>
        </form>
    </section>
    <script>
        $(document).ready(function() {
            $('#profileForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'profile.php',
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
                url: 'profile.php',
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
