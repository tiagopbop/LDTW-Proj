<?php

    declare(strict_types = 1);

    class Category {
        public int $categoryId;
        public string $categoryName;
        public string $categoryFilePath;
    

        public function __construct(int $categoryId, string $categoryName, string $categoryFilePath) {
            $this->categoryId = $categoryId;
            $this->categoryName = $categoryName;
            $this->categoryFilePath = $categoryFilePath;
        }

        static function getCategories(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT categoryId, categoryName, categoryFilePath FROM Category');
            $stmt->execute(array($id));

            $categories = array();
                
            while ($category = $stmt->fetch()) {
                $currentCat = new Category(
                    intval($category['categoryId']),
                    $category['categoryName'],
                    $category['categoryFilePath']);
                    
                    $categories[] = array($currentCat);
            }

            return $categories; 
        }

    }

?>