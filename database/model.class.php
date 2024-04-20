<?php

    declare(strict_types = 1);

    class Model {
        public int $modelId;
        public string $modelName;


        public function __construct(int $modelId, string $modelName) {
            $this->modelId = $modelId;
            $this->modelName = $modelName;
        }

        static function getBrandModels(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT modelId, modelName 
                                  FROM Model
                                  WHERE brandId = ?');
            $stmt->execute(array($id));

            $models = [];

            while ($model = $stmt->fetch()) {
                $models[] = new Model(
                    $model['modelId'],
                    $model['modelName']
                );
            }

            return $models;
        }



    }
    
?>