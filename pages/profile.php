<?php
    declare(strict_types = 1);

    require_once(__DIR__ . '/../utils/session.php');
    $session = new Session();

    require_once(__DIR__ . '/../database/connection.php');
    require_once(__DIR__ . '/../database/user.class.php');
    
    require_once(__DIR__ . '/../templates/common.php');

    require_once(__DIR__ . '/../templates/profile.tpl.php');

    $userId = $session->getId();
    $db = getDatabaseConnection();

    $user = User::getUser($db, $userId);

    drawHeader($session);
    drawProfile($user);
    drawFooter();
?>

