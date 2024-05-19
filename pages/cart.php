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

    if ($userId != NULL) {
        $wishlists = Wishlist::getUserWishlist($db, $userId);
    }
    else {
        $vehicles = [];
    }

    

    foreach ($wishlists as $wishlist) {
        $vehicles[] = Vehicle::getVehicle($db, $wishlist->VehicleId);
    }
    
    $user = $userId !== null ? User::getUser($db, (int)$userId) : null;

    if ($userId != NULL) {
        $user = User::getUser($db, $userId);
        drawHeader($session, $user);
    }
    else {
        drawHeader($session, $user=NULL);
    }
    if ($vehicles != NULL) {
        drawCart($db, $vehicles);
    }
    else {
        drawCart($db, $vehicles=NULL);
    }
    drawFooter();
?>

