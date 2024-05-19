<?php

    declare(strict_types = 1);

    class Types {
        public int $typeId;
        public string $typeName;
        public int $categoryId;
    

        public function __construct(int $typeId, string $typeName, int $categoryId) {
            $this->typeId = $typeId;
            $this->typeName = $typeName;
            $this->categoryId = $categoryId;
        }

        static function getTypes(PDO $db) : array {
            $stmt = $db->prepare('SELECT typeId, typeName, categoryId FROM Types');
            $stmt->execute();

            $types = array();
                
            while ($typee = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $types[] = new Types(
                    intval($typee['typeId']),
                    $typee['typeName'],
                    intval($typee['categoryId'])
                );
            }

            return $types; 
        } 

        static function getCategoryTypes(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT typeId, typeName, categoryId FROM Types
            WHERE categoryId = ?');
            $stmt->execute(array($id));

            $types = array();
                
            while ($typee = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $types[] = new Types(
                    intval($typee['typeId']),
                    $typee['typeName'],
                    $typee['categoryId']
                );
            }

            return $types;
        }

    }

?>