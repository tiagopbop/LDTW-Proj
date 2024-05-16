<?php function drawMessages() { ?>

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/messages.css" rel="stylesheet">
        <title>BlazeDrive</title>
        <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
    </head>
    <body>
        <header class="website_logo">
            <div class="top_page">
            <img class="logo" src="../docs/Logo.jpg" alt="Logo">
            <a class="nav home" href="../pages/index.php">Home</a>
            <input type="text" placeholder="Search">
            <a class="cart trans" href="../pages/cart.php"></a>
            <img class="cart unhovered" src="../docs/shopping_cart_icon.png" alt="Cart">
            <a class="nav login" href="../pages/login.php">Login</a>
            <a class="nav register" href="../pages/register.php">Register</a>
            </div>
        </header>
        <section class="wall">
            <div class="line"></div>
            <section class="profiles">
                <img class="pfp" src="../docs/placeholder.jpg" alt="Pfp1">
                <span>Àlvaro Pinto</span>
                <br>
                <img class="pfp" src="../docs/placeholder.jpg" alt="Pfp2">
                <span>Jessica Priscilla</span>
            </section>
            <section class="chats">
            </section>
            <input type="text" class="write" placeholder="Message">
        </section>
    </body>
</html>
<?php } ?>
