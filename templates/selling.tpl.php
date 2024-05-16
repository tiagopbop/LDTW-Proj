<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/vehicle.class.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/category.class.php');
    require_once(__DIR__ . '/../database/brand.class.php');
    require_once(__DIR__ . '/../database/color.class.php');


?>


<?php 
function drawCreateListing(array $listing) { 
?>

<form action="../actions/action_edit_listing.php" method="post">
    <label for="category">Select Category:</label>
    <select name="category" id="category">
        <?php foreach ($listing as $category): ?>
            <option value="<?= $category['categoryId'] ?>">
                <?= htmlentities($category['categoryName']) ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>


<?php 
} // Close the function drawCreateListing
?>

