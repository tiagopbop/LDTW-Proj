<?php

require_once(__DIR__ . '/../database/connection.php');
require_once(__DIR__ . '/../database/type.class.php'); 

$db = getDatabaseConnection();




if(isset($_GET['categoryId'])) {

    $categoryId = $_GET['categoryId'];

    $types = Types::getCategoryTypes($db, $categoryId); 

    $options = "<option value=''>-- Select Type --</option>";
    
    foreach($types as $typee) {
        $options .= "<option value='" . $typee->typeId . "'>" . $typee->typeName . "</option>";
    }
    echo $options;

} else {

    echo "Error: Type ID is missing.";
}
?>