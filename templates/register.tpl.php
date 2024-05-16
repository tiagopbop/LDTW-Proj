<?php function drawRegister() { ?>

<head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/register.css" rel="stylesheet">
        <title>BlazeDrive</title>
        <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
    </head>
    <body>
        <header class="website_logo">
            <div class="top_page">
            <a class="nav home" href="../pages/index.php">Home</a>
            <input type="text" placeholder="Search">
            <a class="nav messages" href="../pages/messages.php">Messages</a>
            <a class="cart trans" href="../pages/cart.php"></a>
            <img class="cart unhovered" src="../docs/shopping_cart_icon.png" alt="Cart">
            <a class="nav login" href="../pages/login.php">Login</a>
            </div>
        </header>
        <section>
            <img class="logo" src="../docs/LogoInv.png" alt="Logo">
            <form class="registerForm">
                <div class="input-wrapper">
                    <input type="text" class="information" required>
                    <span>Email or Phone Number</span>
                </div>
                <br>
                <div class="input-wrapper">
                    <input type="text" class="information" required>
                    <span>Password</span>
                </div>
                <br>
                <div class="input-wrapper">
                    <input type="text" class="information" required>
                    <span>Confirm Password</span>
                    <button type="submit">&#10162;</button>
                </div>
            </form>
        </section>
        <div class="searchResults"></div>
        <script>
            document.querySelector('.registerForm').addEventListener('submit', function(event) {
                event.preventDefault();
                var searchQuery = document.querySelector('.information').value;
                document.querySelector('.searchResults').textContent = "Search query: " + searchQuery;
            });
        </script>
    </body>
</html>
<?php } ?>
