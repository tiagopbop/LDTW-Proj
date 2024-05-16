<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/vehicle.class.php');

    require_once(__DIR__ . '/../templates/common.php');

    $db = getDatabaseConnection();
    $listing = Category::getCategories($db, intval($GET['id']));

    drawHeader($session);
    drawCreateListing($listing);
    drawFooter();

?>