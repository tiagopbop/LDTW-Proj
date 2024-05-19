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
    <header class="website_logo">
        <div class="top_page">
            <img class="logo" src="../docs/Logo.jpg" alt="Logo">
            <a class="nav home" href="../pages/index.php">Home</a>
            <input type="text" placeholder="Search">
            <a class="nav messages" href="../pages/messages.php">Messages</a>
            <a class="cart trans" href="../pages/cart.php"></a>
            <img class="cart unhovered" src="../docs/shopping_cart_icon.png" alt="Cart">
            <a class="nav additem" href="../pages/additem.php">Add item</a>
        </div>
    </header>
    <section class="wall">
        <img class="pfp" src="../docs/pfp_placeholder.png" alt="Profile Picture">
        <span class="username">Julius César</span>
        <span class="username_change">Edit username</span>
        <form method="POST" action="../pages/logout.php" style="display:inline;">
            <button type="submit" class="logout">Logout</button>
        </form>
    </section>
</body>
</html>
<?php } ?>
