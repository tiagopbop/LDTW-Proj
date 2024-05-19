<?php
declare(strict_types=1);

require_once(__DIR__ . '/../database/vehicle.class.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../database/category.class.php');
require_once(__DIR__ . '/../database/brand.class.php');
require_once(__DIR__ . '/../database/color.class.php');
?>

<?php function drawBrowse() { ?>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/browse.css" rel="stylesheet">
        <title>BlazeDrive</title>
        <link rel="icon" type="image/x-icon" href="../docs/favicon.ico">
    </head>
    <body>
        <div class="options">
          <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Item1"></a>
          <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Item2"></a>
          <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Item3"></a>
          <br>
          <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Item4"></a>
          <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Item5"></a>
          <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Item6"></a>
          <br>
          <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Item7"></a>
          <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Item8"></a>
          <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Item9"></a>
          <br>
          <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Item10"></a>
          <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Item11"></a>
          <a href="item.php"><img class="items" src="../docs/placeholder.jpg" alt="Item12"></a>
        </div>
        <section class="wall">
          <span class="brand">Brand</span>
          <forms>
          <select class="brand_options" name="brand" id="brand">
        <?php foreach ($brands as $brand): ?>
            <option  value="<?= $brand->BrandId ?>">
                <?= htmlentities($brand->BrandName) ?>
            </option>
        <?php endforeach; ?>
    </select>
        </forms>
        </section>
    </body>
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
</html>
<?php } ?>
