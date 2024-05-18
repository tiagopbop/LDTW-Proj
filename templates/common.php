<?php
function getBrandName($db, $BrandId) {
    $stmt = $db->prepare('SELECT brandName FROM Brand WHERE BrandId = ?');
    $stmt->execute([$BrandId]);
    return $stmt->fetchColumn();
}

function getModelName($db, $modelId) {
    $stmt = $db->prepare('SELECT modelName FROM Model WHERE modelId = ?');
    $stmt->execute([$modelId]);
    return $stmt->fetchColumn();
}

function getImageById($db, $VehicleId) {
    $stmt = $db->prepare('SELECT imageFilePath FROM Images WHERE VehicleId = ?');
    $stmt->execute([$VehicleId]);
    return $stmt->fetchColumn();
}
?>

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
            <img class="logo" src="../docs/Logo.jpg" alt="Logo">
                <a class="nav home" href="../pages/index.php">Home</a>
                <form id="f1">
                <input id="myInput" type="text" placeholder="Search">
                <button id="myBtn">&#10162;</button>
                </form>
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
        </header>
<?php } ?>

<?php
function drawResto($db, $vehicles) {
?>
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
        <?php foreach (array_slice($vehicles, 0, 3) as $vehicle): ?>
    <?php
    // Get the image file path for the current vehicle
    $imagePath = getImageById($db, $vehicle->VehicleId);
    ?>
    <a href="item.php?VehicleId=<?= $vehicle->VehicleId ?>">
        <img class="items" src="<?= $imagePath ? $imagePath : '../docs/placeholder.jpg' ?>" alt="Ad<?= $vehicle->VehicleId ?>">
    </a>
<?php endforeach; ?>
        </div>
        <?php foreach (array_slice($vehicles, 0, 3) as $vehicle): ?>
            <p class="pop first ad<?= $vehicle->VehicleId ?>">
                <?= htmlentities(getBrandName($db, $vehicle->BrandId)) ?> <?= htmlentities(getModelName($db, $vehicle->modelId)) ?> - $<?= htmlentities(number_format($vehicle->price, 2)) ?>
            </p>
        <?php endforeach; ?>
        <div class="trending">
        <?php foreach (array_slice($vehicles, 3, 3) as $vehicle): ?>
    <?php
    // Get the image file path for the current vehicle
    $imagePath = getImageById($db, $vehicle->VehicleId);
    ?>
    <a href="item.php?VehicleId=<?= $vehicle->VehicleId ?>">
        <img class="items" src="<?= $imagePath ? $imagePath : '../docs/placeholder.jpg' ?>" alt="Ad<?= $vehicle->VehicleId ?>">
    </a>
<?php endforeach; ?>
        </div>
        <?php foreach (array_slice($vehicles, 3, 3) as $vehicle): ?>
            <p class="pop second ad<?= $vehicle->VehicleId ?>">
                <?= htmlentities(getBrandName($db, $vehicle->BrandId)) ?> <?= htmlentities(getModelName($db, $vehicle->modelId)) ?> - $<?= htmlentities(number_format($vehicle->price, 2)) ?>
            </p>
        <?php endforeach; ?>
    </section>
<?php
} ?>

<?php function drawFooter() { ?>
    </main>

    <footer>
    <p class="footer">© 2024 BlazeDrive All rights reserved.</p>
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
