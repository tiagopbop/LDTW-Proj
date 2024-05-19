<?php

declare(strict_types = 1);

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

?>

<?php
function getCondition(int $id) : string {
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
} ?>


<?php
function getFuelType(int $id) : string {
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
} ?>


<?php function drawItem($db, $id) { ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/item.css" rel="stylesheet">
        <img class="item" src=<?= '../productImages/' . $id . '-1.jpg' ?> alt="Ad4">
        <section class="wally">
            
            <?php
                // Fetch brand and model information from the database based on the item ID
                // Assuming you have a function to retrieve this information from the database
                
                $current = Vehicle::getVehicle($db, $id);
                $brand = getBrandName($db ,$current->BrandId); // Replace getBrandById with your actual function
                $model = getModelName($db, $current->modelId); // Replace getModelById with your actual function
                $user = User::getUser($db, $current->UserId);
                $price = $current->price;
                $type = Types::getTypeName($db, $current->typeId);
            ?>

            <span class="product"><?php echo $brand . ' ' . $model; ?></span>
            <span class="owner"><?php echo $user->userName?></span>
            <span class="description"> Vehicle in <?php echo getCondition($current->condition)?> condition <br> 
            Color: <?php echo Color::getColorNameById($db, $current->colorId)?> <br>
            Fuel Type: <?php echo getFuelType($current->fuelType)?> <br>
            Kilometers: <?php echo $current->kilometers?> <br>
            </span>
            <span class="price"><?php echo $price?>€</span>
            <a class="message" href="../pages/messages.php">Message</a>
            <img class="wishlist" src="../docs/shopping_cart_icon.png" alt="Wishlist">
            <span class="popi">Add to wishlist?</span>
        </section>

        <?php
            $reviews = Review::getVehicleReviews($db, $id);
            $number = count($reviews);
            foreach ($reviews as $review) {
                $user = User::getUser($db, $review->UserId);
            ?>
            <span class="comments">Comments: <?php echo $number?></span>
            <div class="review">
                <div class="username"><?php echo $user->userName; ?></div>
                <div class="rating">Rating: <?php echo $review->Rating; ?></div>
                <div class="message"><?php echo $review->Comment; ?></div>
            </div>
            <?php
            }
            ?>
            
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>            
        <div class="linha"></div>
        <script>
            $(document).ready(function() {
                // Event listener for profile click
                $('.wishlist').on('click', function() {
                    var UserId = <?php echo Session::getId()?>;
                    var VehicleId = <?php echo $id?>;
                    
                    console.log(UserId, VehicleId);

                    // Fetch chat ID between current user and selected user
                    $.ajax({
                        type: 'POST',
                        url: '../database/add_wish.php',
                        data: { UserId: UserId, VehicleId: VehicleId },
                        success: function(messagesResponse) {
                            // yay it works
                        },
                        error: function(xhr, status, error) {
                            console.error(status, error);
                        }
                    });
                });
            });
        </script>
    </body>
</html>
<?php } ?>
