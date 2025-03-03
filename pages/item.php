<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/user.class.php');
    
    require_once(__DIR__ . '/../templates/common.php');

    require_once(__DIR__ . '/../templates/item.tpl.php');

    $db = getDatabaseConnection();

    drawHeader($session, $user);
    drawItem($db, intval($_GET['id']),6);
    drawFooter();
?>