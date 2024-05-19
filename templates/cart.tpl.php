<?php function drawCart($db, $vehicles) { ?>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/cart.css" rel="stylesheet">

    <body>
        <section class="wally">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
            <?php
            $count = 0;
            foreach ($vehicles as $vehicle)  { $count++;
                $type = Types::getTypeName($db, $vehicle->typeId);
                $brand = Brand::getBrandNameById($db, $vehicle->BrandId);
                $model = getModelName($db, $vehicle->modelId);
                $user = User::getUser($db, $vehicle->UserId);
                ?>
                <div><img class="itemsy" src="../productImages/<?php echo $vehicle->VehicleId ?>-1.jpg" alt="Ad1"></div>
                <div class="linei f<?= $count ?>">
                    <?php  echo $type ?> | <?php echo $brand ?> | <?php echo $model ?> | <?php echo $user->userName ?> | <?php  echo $vehicle->price ?>
                </div>

                <img class="wishlist" src="../docs/shopping_cart_icon.png" id="wishlist<?= $count ?>">


                <script>
                    $(document).ready(function() {
                        // Event listener for profile click
                        $('#wishlist<?= $count ?>').on('click', function() {
                            var UserId = <?php echo Session::getId()?>;
                            var VehicleId = <?php echo $vehicle->VehicleId?>;

                            $.ajax({
                                type: 'POST',
                                url: '../database/rm_wish.php',
                                data: { UserId: UserId, VehicleId: VehicleId },
                                success: function(messagesResponse) {
                                    location.reload();
                                },
                                error: function(xhr, status, error) {
                                    console.error(status, error);
                                }
                            });
                        });
                     });
                </script>

            <?php } ?>
        </section>

        
    </body>
</html>
<?php } ?>