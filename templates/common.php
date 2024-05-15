
<?php function drawHeader($session) { ?>
    <!DOCTYPE html>
    <html lang="en-US">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/index.css" rel="stylesheet">
        <title>BlazeDrive</title>
        <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
    </head>
    <body>
        <header class="website_logo">
            <div class="top_page">
            <img class="logo" src="../docs/Logo.jpg" alt="Logo">
                <a class="nav home" href="../pages/index.html">Home</a>
                <input type="text" placeholder="Search">
                <a class="nav messages" href="../pages/messages.html">Messages</a>
                <a class="cart trans" href="../pages/cart.html"></a>
                <img class="cart unhovered" src="../docs/shopping_cart_icon.png" alt="Cart">
                <?php
                    if (!$session->isLoggedIn()) logInFalse();
                ?>
            </div>
        </header>
        <div class="line"></div>
<?php } ?>

<?php function drawResto() { ?>
    <section>
            <div class="decoration terra"></div>
            <div class="vehicles terrain white"></div>
            <a class="vehicles terrain trans" href="../pages/browse.html"></a>
            <img class="vehicles terrain car" src="../docs/Terrain.jpg" alt="Terrain">
        </section>
        <section>
            <div class="decoration aqua"></div>
            <div class="vehicles aquatic white"></div>
            <a class="vehicles aquatic trans" href="../pages/browse.html"></a>
            <img class="vehicles aquatic boat" src="../docs/Aquatic.jpg" alt="Aquatic">
        </section>
        <section>
            <div class="decoration air"></div>
            <div class="vehicles aerial white"></div>
            <a class="vehicles aerial trans" href="../pages/browse.html"></a>
            <img class="vehicles aerial plane" src="../docs/Aerial.jpg" alt="Aerial">
        </section>
        <div class="popup">TRENDING</div>
        <section class="wall">
            <div class="trending">
                <a href="item.html"><img class="items" src="../docs/placeholder.jpg" alt="Ad1"></a>
                <a href="item.html"><img class="items" src="../docs/placeholder.jpg" alt="Ad2"></a>
                <a href="item.html"><img class="items" src="../docs/placeholder.jpg" alt="Ad3"></a>
            </div>
            <p class="pop first ad1">Vintage car</p>
            <p class="pop first ad2">Modern bike</p>
            <p class="pop first ad3">Popcorn</p>
            <div class="trending">
                <a href="item.html"><img class="items" src="../docs/placeholder.jpg" alt="Ad4"></a>
                <a href="item.html"><img class="items" src="../docs/placeholder.jpg" alt="Ad5"></a>
                <a href="item.html"><img class="items" src="../docs/placeholder.jpg" alt="Ad6"></a>
            </div>
            <p class="pop second ad4">Pocket watch with wheels</p>
            <p class="pop second ad5">Duck 1</p>
            <p class="pop second ad6">Duck 2</p>
        </section>
    </body>
    </html>
<?php } ?>


<?php function drawFooter() { ?>
    </main>

    <footer>
    <p class="foot">© 2024 BlazeDrive All rights reserved.</p>
    </footer>
  </body>
</html>
<?php } ?>

<?php function logInFalse() { ?>
    <a class="nav login" href="../pages/login.php">Login</a>
    <a class="nav register" href="../pages/register.php">Register</a>
<?php } ?>

<?php function drawLogIn() { ?>
    <section>
            <img class="logo" src="../docs/LogoInv.png" alt="Logo">
            <form>
                <div class="input-wrapper">
                    <input type="text" required>
                    <span>Email or Phone Number</span>
                </div>
                <br>
                <div class="input-wrapper">
                    <input type="text" required>
                    <span>Password</span>
                    <button type="submit">&#10162;</button>
                </div>
            </form>
        </section>
</html>
<?php } ?>
