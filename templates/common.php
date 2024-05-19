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

<?php function drawHeader($session, $user) { ?>
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
                <a class="nav messages" href="../pages/messages.php">Messages</a>
                <a class="cart trans" href="../pages/cart.php"></a>
                <img class="cart unhovered" src="../docs/shopping_cart_icon.png" alt="Cart">
                <?php
                    if ($user->UserId != NULL && $user->is_admin == 1) adminTrue();
                ?>
                <?php
                    if (!$session->isLoggedIn()) logInFalse();
                    else logInTrue();
                ?>
        </header>
<?php } ?>

<?php
function drawResto($db, $vehicles) {
    ?>
    <div class="line"></div>
    <section>
        <div class="decoration terra"></div>
        <div class="vehicles terrain white"></div>
        <a class="vehicles terrain trans" href="../pages/browse.php?id=1"></a>
        <img class="vehicles terrain car" src="../docs/Terrain.jpg" alt="Terrain">
    </section>
    <section>
        <div class="decoration aqua"></div>
        <div class="vehicles aquatic white"></div>
        <a class="vehicles aquatic trans" href="../pages/browse.php?id=2"></a>
        <img class="vehicles aquatic boat" src="../docs/Aquatic.jpg" alt="Aquatic">
    </section>
    <section>
        <div class="decoration air"></div>
        <div class="vehicles aerial white"></div>
        <a class="vehicles aerial trans" href="../pages/browse.php?id=3"></a>
        <img class="vehicles aerial plane" src="../docs/Aerial.jpg" alt="Aerial">
    </section>
    <div class="popup">TRENDING</div>
    <section class="wall">
        <div class="trending">
            <?php 
            $number = 0;
            foreach (array_slice($vehicles, 0, 3) as $vehicle): ?>
                <?php 
                    $number++; 
                ?>
                <a href="item.php?id=<?= $vehicle->VehicleId?>">
                    <img class="items" src="<?= '../productImages/' . $vehicle->VehicleId . '-1.jpg' ?>" alt="Ad<?= $vehicle->VehicleId ?>">
                </a>
                <p class="pop first ad<?= $number ?>">
                    <?= htmlentities(getBrandName($db, $vehicle->BrandId)) ?> <?= htmlentities(getModelName($db, $vehicle->modelId)) ?> - $<?= htmlentities(number_format($vehicle->price, 2)) ?>
                </p>
            <?php endforeach; ?>
        </div>
        <?php if (count($vehicles) > 3): ?>
            <div class="trending">
                <?php foreach (array_slice($vehicles, 3) as $vehicle): ?>
                    <?php 
                        $number++; 
                    ?>
                    <a href="item.php?id=<?= $vehicle->VehicleId?>">
                        <img class="items" src="<?= '../productImages/' . $vehicle->VehicleId . '-1.jpg' ?>" alt="Ad<?= $vehicle->VehicleId ?>">
                    </a>
                    <p class="pop second ad<?= $number ?>">
                        <?= htmlentities(getBrandName($db, $vehicle->BrandId)) ?> <?= htmlentities(getModelName($db, $vehicle->modelId)) ?> - $<?= htmlentities(number_format($vehicle->price, 2)) ?>
                    </p>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </section>
    <?php
}
?>



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
    <a class="nav login" href="../pages/create_listing.php">Add item</a>
    <a class="nav register" href="../pages/profile.php">Profile</a>
<?php } ?>

<?php function adminTrue() { ?>
    <a class="nav admin" href="../pages/createAdmin.php">Give admin</a>
    <a class="nav addCat" href="../pages/addCat.php">Add new category</a>
<?php } ?>