<?php function drawItem() { ?>
<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/item.css" rel="stylesheet">
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
                <a class="nav login" href="../pages/login.php">Login</a>
                <a class="nav register" href="../pages/register.php">Register</a>
            </div>
        </header>
        <img class="item" src="../docs/placeholder.jpg" alt="Ad4">
        <section class="wall">
            <span class="product">Very cool car</span>
            <span class="owner">Mateus rodrigues</span>
            <span class="description">Description</span>
            <span class="price">16.000 €</span>
            <a class="message" href="../pages/messages.php">Message</a>
            <img class="wishlist" src="../docs/shopping_cart_icon.png" alt="Wishlist">
            <span class="popi">Add to wishlist?</span>
        </section>
        <span class="comments">Comments (0)</span>
        <div class="linha"></div>
    </body>
</html>
<?php } ?>
