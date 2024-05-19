<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/type.class.php');
    require_once(__DIR__ . '/../database/vehicle.class.php');
    require_once(__DIR__ . '/../database/wishlist.class.php');
    require_once(__DIR__ . '/../database/brand.class.php');
    
    require_once(__DIR__ . '/../templates/common.php');

    require_once(__DIR__ . '/../templates/cart.tpl.php');

    $db = getDatabaseConnection();

    $userId = Session::getId();

    $wishlists = Wishlist::getUserWishlist($db, $userId);
    $vehicles = [];

    foreach ($wishlists as $wishlist) {
        $vehicles[] = Vehicle::getVehicle($db, $wishlist->VehicleId);
    }


    drawHeader($session);
    drawCart($db, $vehicles);
    drawFooter();
?>

