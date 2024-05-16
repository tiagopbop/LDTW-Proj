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
            <option value="">-- Select Category --</option>
            <?php foreach ($listing as $list): ?>
                <option value="<?= $list['categoryId'] ?>"><?= $list['categoryName'] ?></option>
            <?php endforeach; ?>
        </select>


        
        <input type="submit" value="Submit">
    </form>

    <script>
    document.getElementById("brand").addEventListener("change", function() {
        var brandId = this.value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById("model").innerHTML = xhr.responseText;
            }
        };
        xhr.open("GET", "./utils/get_models.php?brandId=" + brandId, true); // Adjust the URL to point to your PHP file
        xhr.send();
    });
    </script>

<?php
}
?>
