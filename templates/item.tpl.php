<?php

declare(strict_types=1);

require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/brand.class.php');
require_once(__DIR__ . '/../database/color.class.php');
require_once(__DIR__ . '/../database/type.class.php');
require_once(__DIR__ . '/../database/model.class.php');
require_once(__DIR__ . '/../database/vehicle.class.php');
require_once(__DIR__ . '/../database/review.class.php');

require_once(__DIR__ . '/../templates/common.php');

function getCondition(int $id): string {
    switch ($id) {
        case 1:
            return "very bad";
        case 2:
            return "bad";
        case 3:
            return "good";
        case 4:
            return "very good";
        case 5:
            return "pristine";
        default:
            return "unknown";
    }
}

function getFuelType(int $id): string {
    switch ($id) {
        case 1:
            return "Diesel";
        case 2:
            return "Hybrid";
        case 3:
            return "None";
        case 4:
            return "Electric";
        default:
            return "Unknown";
    }
}

function drawItem($db, int $id, int $currentUser) { ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/item.css" rel="stylesheet">
    <img class="item" src=<?= '../productImages/' . $id . '-1.jpg' ?> alt="Ad4">
    <section class="wally">
        <?php
        $current = Vehicle::getVehicle($db, $id);
        $brand = getBrandName($db, $current->BrandId);
        $model = getModelName($db, $current->modelId);
        $user = User::getUser($db, $current->UserId);
        $price = $current->price;
        ?>
        <span class="product"><?php echo $brand . ' ' . $model; ?></span>
        <span class="owner"><?php echo $user->userName ?></span>
        <span class="description"> Vehicle in <?php echo getCondition($current->condition) ?> condition <br>
            Color: <?php echo Color::getColorNameById($db, $current->colorId) ?> <br>
            Fuel Type: <?php echo getFuelType($current->fuelType) ?> <br>
            Kilometers: <?php echo $current->kilometers ?>
        </span>
        <span class="price"><?php echo $price ?>€</span>
        <a class="message" href="#" data-vehicle-user="<?php echo $current->UserId; ?>">Message</a>
        <img class="wishlist" src="../docs/shopping_cart_icon.png" alt="Wishlist">
        <span class="popi">Add to wishlist?</span>
    </section>
    <span class="comments">Comments (0)</span>
    <div class="linha"></div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('.message').on('click', function (e) {
                e.preventDefault(); // Prevent the default anchor behavior

                var currentUser = <?php echo $currentUser; ?>;
                var vehicleUser = $(this).data('vehicle-user');

                // Send the data using AJAX
                $.ajax({
                    type: 'POST',
                    url: '../pages/messages.php',
                    data: {
                        currentUser: currentUser,
                        vehicleUser: vehicleUser
                    },
                    success: function (response) {
                        // Redirect to messages page after successful chat creation
                        window.location.href = '../pages/messages.php';
                    },
                    error: function (xhr, status, error) {
                        console.error(error);
                    }
                });
            });

            // Wishlist event listener
            $('.wishlist').on('click', function () {
                var UserId = <?php echo $currentUser ?>;
                var VehicleId = <?php echo $id ?>;

                // Add to wishlist
                $.ajax({
                    type: 'POST',
                    url: '../database/add_wish.php',
                    data: {UserId: UserId, VehicleId: VehicleId},
                    success: function (response) {
                        // Wishlist added successfully
                    },
                    error: function (xhr, status, error) {
                        console.error(status, error);
                    }
                });
            });
        });
    </script>
    <?php
}

// Example usage
if (isset($_SESSION['userId'])) {
    $loggedInUserId = $_SESSION['userId'];
    $vehicleOwnerId = $current->UserId; // Assuming $current is the vehicle object obtained earlier
    $chatExists = checkChatExistence($db, $loggedInUserId, $vehicleOwnerId);

    if (!$chatExists) {
        // If chat doesn't exist, create one in the database
        createChat($db, $loggedInUserId, $vehicleOwnerId);
    }
}

?>
