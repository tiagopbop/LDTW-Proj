<?php

require_once('/../database/model.class.php'); 


if(isset($_GET['brandId'])) {

    $brandId = $_GET['brandId'];

    $models = Model::getBrandModels($db, $brandId); 

    $options = "<option value=''>-- Select Model --</option>";
    
    foreach($models as $model) {
        $options .= "<option value='" . $model->modelId . "'>" . $model->modelName . "</option>";
    }
    echo $options;

} else {

    echo "Error: Brand ID is missing.";
}
?>