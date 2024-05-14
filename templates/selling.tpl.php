<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../database/vehicle.class.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/session.class.php');


?>


<?php 
function drawCreateListing(PDO $db) { 
?>

    <form action="../actions/action_edit_listing.php" method="post">

        <label for="category">Select Category:</label>
        <select name="category" id="category">
            <option value="">-- Select Category --</option>
            <?php
            $categories = Category::getCategories($db);
            foreach($categories as $category) {
                echo "<option value='" . $category['categoryId'] . "'>" . $category['categoryName'] . "</option>";
            }
            ?>
        </select>
        <br>

        <label for="brand">Select Brand:</label>
        <select name="brand" id="brand">
            <option value="">-- Select Brand --</option>
            <?php
            $brands = Brand::getBrands($db);
            foreach($brands as $brand) {
                echo "<option value='" . $brand['brandId'] . "'>" . $brand['brandName'] . "</option>";
            }
            ?>
        </select>
        <br>
    
        <label for="model">Select Model:</label>
        <select name="model" id="model">
            <option value="">-- Select Model --</option>
        </select>
        <br>

        

        <label for="fuelType">Select Fuel Type:</label>
        <select name="fuelType" id="fuelType">
            <option value="">-- Select Fuel Type --</option>
            <option value="1">tipo 1</option>
            <option value="2">tipo 2</option>
            <option value="3">tipo 3</option>
            <option value="4">tipo 4</option>
            <option value="5">tipo 5</option>
        <select>
        <br>

        <label for="condition">Select Condition:</label>
        <select name="condition" id="condition">
            <option value="">-- Select Condition --</option>
            <option value="1">Very Bad</option>
            <option value="2">Bad</option>
            <option value="3">Good</option>
            <option value="4">Very Good</option>
            <option value="5">Pristine</option>
        <select>
        <br>


        <label for="color">Color:</label>
        <select name="color" id="color">
            <option value="">-- Select Color --</option>
            <?php
            $colors = Color::getColors($db);
            foreach($colors as $color) {
                echo "<option value='" . $color['colorId'] . "'>" . $color['colorName'] . "</option>";
            }
            ?>
        </select>
        <br>

        
        <label for="kilometers">Kilometers:</label>
        <input type="number" name="kilometers" id="kilometers" step="1" placeholder="Enter kilometers">
        <br>
        

        <label for="price">Price:</label>
        <input type="number" name="price" id="price" step="0.01" placeholder="Enter price">
        <br>

        <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image">
        <br>

        <?php


        if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $imageName = "unedited" . '_' . $_FILES['image']['name']; 
            $imagePath = '../images/' . $imageName; 
            move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            echo '<img src="' . $imagePath . '" alt="Uploaded Image">';
        }

        //dar rename ao ficheiro depois de ser adicionado para
        //por o id do veiculo
        ?>
        

        
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
