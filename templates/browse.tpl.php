
<?php function drawBrowse($db, $id) { ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/browse.css" rel="stylesheet">
    <body>
        <div class="options">
          <?php 
            $vehicles = Vehicle::getTypeVehicles($db, $id);
            $count = 0;

            var_dump($vehicles);
            
            foreach ($vehicles as $vehicle) $count++; ?> {
              <a href="item.php?id=<?= $vehicle->VehicleId?>">
                <img class="items" src="<?= '../productImages/' . $vehicle->VehicleId . '-1.jpg' ?>" alt="Item<?= $count ?>">
              </a>
            }
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
        </section>
    </body>
</html>
<?php } ?>
            
