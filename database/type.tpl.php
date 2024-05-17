<?php

    declare(strict_types = 1);

    class Types {
        public int $typeID;
        public string $typeName;
        public int $categoryId;
    

        public function __construct(int $typeID, string $typeName, int $categoryId) {
            $this->categoryId = $categoryId;
            $this->categoryName = $categoryName;
            $this->categoryFilePath = $categoryFilePath;
        }

        static function getCategories(PDO $db, int $count) : array {
            $stmt = $db->prepare('SELECT typeId, typeName, categoryId FROM Types
            LIMIT ?');
            $stmt->execute(array($count));

            $types = array();
                
            while ($typee = $stmt->fetch()) {
                $currentType[] = new Category(
                    intval($typee['categoryId']),
                    $typee['categoryName'],
                    $typee['categoryFilePath'],);
            }

            return $types; 
        } 

    }

?>