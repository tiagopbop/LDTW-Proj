<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    if (!$session->isLoggedIn()) die(header('Location: /'));

    require_once(__DIR__ . '/../database/connection.db.php');
    require_once(__DIR__ . '/../database/vehicle.class.php');

    require_once(__DIR__ . '/../templates/selling.tpl.php');

    $db = getDatabaseConnection();


    drawCreateListing($db);

?>