<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/user.class.php');
    require_once(__DIR__ . '/../database/vehicle.class.php');

    $db = getDatabaseConnection();
    
    require_once(__DIR__ . '/../templates/common.php');

    require_once(__DIR__ . '/../templates/browse.tpl.php');

    drawHeader($session, $user);
    drawBrowse($db, intval($_GET['id']));
    drawFooter();
?>

