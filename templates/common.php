
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
                <a class="nav home" href="../pages/index.php">Home</a>
                <form id="f1">
                <input id="myInput" type="text" placeholder="Search">
                <button id="myBtn">&#10162;</button>
                </form>
                <div class="searchResults"></div>
                <a class="nav messages" href="../pages/messages.php">Messages</a>
                <a class="cart trans" href="../pages/cart.php"></a>
                <img class="cart unhovered" src="../docs/shopping_cart_icon.png" alt="Cart">
                <?php
                    if (!$session->isLoggedIn()) logInFalse();
                    else logInTrue();
                ?>
                <script>
                var input = document.getElementById("myInput");
                input.addEventListener("keyup", function(event) {
                if (event.keyCode === 13) {
                    event.preventDefault();
                    document.getElementById("myBtn").click();
                    console.log(inputText)
                }
                });
                </script>
            </div>
        </header>
<?php } ?>

<?php function drawResto() { ?>
    <div class="line"></div>
    <section>
            <div class="decoration terra"></div>
            <div class="vehicles terrain white"></div>
            <a class="vehicles terrain trans" href="../pages/browse.php"></a>
            <img class="vehicles terrain car" src="../docs/Terrain.jpg" alt="Terrain">
        </section>
        <section>
            <div class="decoration aqua"></div>
            <div class="vehicles aquatic white"></div>
            <a class="vehicles aquatic trans" href="../pages/browse.php"></a>
            <img class="vehicles aquatic boat" src="../docs/Aquatic.jpg" alt="Aquatic">
        </section>
        <section>
            <div class="decoration air"></div>
            <div class="vehicles aerial white"></div>
            <a class="vehicles aerial trans" href="../pages/browse.php"></a>
            <img class="vehicles aerial plane" src="../docs/Aerial.jpg" alt="Aerial">
        </section>
        <div class="popup">TRENDING</div>
        <section class="wall">
            <div class="trending">
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad1"></a>
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad2"></a>
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad3"></a>
            </div>
            <p class="pop first ad1">Vintage car</p>
            <p class="pop first ad2">Modern bike</p>
            <p class="pop first ad3">Popcorn</p>
            <div class="trending">
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad4"></a>
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad5"></a>
                <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Ad6"></a>
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

<?php function logInTrue() { ?>
    <a class="nav login" href="../pages/additem.php">Add item</a>
    <a class="nav register" href="../pages/profile.php">Profile</a>
<?php } ?>

<?php function drawLogIn() { ?>
    <section>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/login.css" rel="stylesheet">
            <img class="logoinv" src="../docs/LogoInv.png" alt="Logo">
            <form>
                <div class="input-wrapper">
                    <input type="text" required>
                    <span>Email or Username</span>
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
