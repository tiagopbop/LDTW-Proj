<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/vehicle.class.php');
    require_once(__DIR__ . '/../database/category.class.php');

    require_once(__DIR__ . '/../templates/common.php');
    
    require_once(__DIR__ . '/../templates/selling.tpl.php');

    $db = getDatabaseConnection();

    $categories = Category::getCategories($db);
    $brands = Brand::getBrands($db);
    $colors = Color::getColors($db);

    drawHeader($session, $user);
    drawCreateListing($categories, $brands, $colors);
    drawFooter();

?>