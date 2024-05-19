<?php
require_once(__DIR__ . '/../database/vehicle.class.php');
require_once(__DIR__ . '/../database/user.class.php');
require_once(__DIR__ . '/../utils/session.php');
require_once(__DIR__ . '/../database/category.class.php');
require_once(__DIR__ . '/../database/brand.class.php');
require_once(__DIR__ . '/../database/color.class.php');
require_once(__DIR__ . '/../templates/common.php');

$db = new PDO('sqlite:../database/store.db');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Fetch some vehicles
$vehicles = Vehicle::getSomeVehicles($db, 6);

session_start();
$session = new Session();

drawHeader($session);
drawResto($db, $vehicles);  // Pass the database connection
drawFooter();
?>
