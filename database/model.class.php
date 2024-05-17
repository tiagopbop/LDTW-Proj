<?php

    declare(strict_types = 1);

    class Model {
        public int $BrandId;
        public int $modelId;
        public string $modelName;


        public function __construct(int $BrandId, int $modelId, string $modelName) {
            $this->BrandId = $BrandId;
            $this->modelId = $modelId;
            $this->modelName = $modelName;
        }

        static function getBrandModels(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT BrandId, modelId, modelName 
                                  FROM Model
                                  WHERE brandId = ?');
            $stmt->execute(array($id));

            $models = [];

            while ($model = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $models[] = new Model(
                    intval($model['BrandId']),
                    intval($model['modelId']),
                    $model['modelName']
                );
            }

            return $models;
        }



    }
    
?>