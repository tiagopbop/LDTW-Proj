<?php
  // Include the User class definition
  require_once(__DIR__ . '/../database/user.class.php');

  // Fetch all users from the database
  function getUsers() {
    $db = getDatabaseConnection();
    $stmt = $db->query('SELECT userId FROM User');
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Get users
  $users = getUsers();
?>
<!DOCTYPE html>
<html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/style.css" rel="stylesheet">
        <title>BlazeDrive</title>
        <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
    </head>
    <body>
        <header class="website_logo">
            <div class="top_page">
                <img src="../docs/Logo.jpg" width="180" alt="Logo">
                <a id="home" href="main_page.html">Home</a>
                <img id="cart" src="../docs/shopping_cart_icon.png" width="40" alt="Cart">
                <img id="cart_hover" src="../docs/shopping_cart_icon_hover.png" width="40" alt="Cart_hover">
                <a id="login" href="login.html">Login</a>
                <a id="register" href="register.html">Register</a>
            </div>
        </header>
        <section id="user">
            <?php foreach ($users as $user): ?>
                <p>User ID: <?php echo $user['userId']; ?></p>
            <?php endforeach; ?>
        </section>
    </body>
</html>
