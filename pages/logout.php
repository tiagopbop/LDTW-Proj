<?php
require_once(__DIR__ . '/../utils/session.php');
$session = new Session();
$session->logout();

header('Location: ../pages/index.php');
exit();
?>
