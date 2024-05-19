<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/vehicle.class.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/category.class.php');
require_once(__DIR__ . '/../database/brand.class.php');
require_once(__DIR__ . '/../database/color.class.php');
?>

<?php
function drawCreateListing(array $listing, array $brands, array $colors)
{
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../css/selling.css" rel="stylesheet">
    <title>BlazeDrive</title>
    <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
</head>
<form action="../actions/action_create_listing.php" method="post" enctype="multipart/form-data">
    <label for="category">Select Category:</label>
    <select name="category" id="category">
        <?php foreach ($listing as $category): ?>
            <option value="<?= $category->categoryId ?>">
                <?= htmlentities($category->categoryName) ?> 
            </option>
        <?php endforeach; ?>
    </select>

    <label for="types">Select Type:</label>
    <select name="types" id="types">
        <!-- Types will be populated dynamically based on the selected brand -->
    </select>

    <label for="brand">Select Brand:</label>
    <select name="brand" id="brand">
        <?php foreach ($brands as $brand): ?>
            <option value="<?= $brand->BrandId ?>">
                <?= htmlentities($brand->BrandName) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <label for="model">Select Model:</label>
    <select name="model" id="model">
        <!-- Models will be populated dynamically based on the selected brand -->
    </select>

    <label for="color">Select Color:</label>
    <select name="color" id="color">
        <?php foreach($colors as $color): ?>
            <option value="<?= $color->colorId ?>">
                <?= htmlentities($color->colorName) ?>
            </option>
        <?php endforeach; ?>
    </select>


    <label for="kilometers">Kilometers:</label>
    <input type="number" name="kilometers" id="kilometers" step="1" required>

    <label for="condition">Condition:</label>
    <input type="number" name="condition" id="condition" min="1" max="5" required>

    <label for="fuelType">Fuel Type:</label>
    <input type="number" name="fuelType" id="fuelType" min="1" max="4" required>

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" step="0.01" required>

    <label for="images">Upload Images:</label>
    <input type="file" name="images[]" id="images" multiple required>

    <button type="submit">Submit</button>


</form>

<script>
    document.getElementById('brand').addEventListener('change', function() {
        var brandId = this.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('model').innerHTML = xhr.responseText;
                } else {
                    console.error('Request failed: ' + xhr.status);
                }
            }
        };
        xhr.open('GET', '../utils/get_models.php?brandId=' + brandId, true);
        xhr.send();
    });
</script>

<script>
    document.getElementById('category').addEventListener('change', function() {
        var categoryId = this.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('types').innerHTML = xhr.responseText;
                } else {
                    console.error('Request failed: ' + xhr.status);
                }
            }
        };
        xhr.open('GET', '../actions/get_types.php?categoryId=' + categoryId, true);
        xhr.send();
    });
</script>

<?php
}
?>
