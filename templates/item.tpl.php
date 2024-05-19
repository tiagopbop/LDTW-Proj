<?php

declare(strict_types = 1);

require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/brand.class.php');
require_once(__DIR__ . '/../database/model.class.php');
require_once(__DIR__ . '/../database/vehicle.class.php');

require_once(__DIR__ . '/../templates/common.php');

?>


<?php function drawItem($db, int $id) { ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/item.css" rel="stylesheet">
        <img class="item" src="../docs/placeholder.jpg" alt="Ad4">
        <section class="wall">
            
            <?php
                // Fetch brand and model information from the database based on the item ID
                // Assuming you have a function to retrieve this information from the database
                $current = Vehicle::getVehicle($db, $id);
                $brand = getBrandName($db ,$current->BrandId); // Replace getBrandById with your actual function
                $model = getModelName($db, $current->modelId); // Replace getModelById with your actual function
                $user = User::getUser($db, $current->UserId);
            ?>
            <span class="product"><?php echo $brand . ' ' . $model; ?></span>
            <span class="owner"><?php echo $user->userName?></span>
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
