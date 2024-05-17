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

        static function getCategories(PDO $db) : array {
            $stmt = $db->prepare('SELECT categoryId, categoryName, categoryFilePath FROM Category');
            $stmt->execute();

            $categories = array();
                
            while ($category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $categories[] = new Category(
                    intval($category['categoryId']),
                    $category['categoryName'],
                    $category['categoryFilePath']);
            }

            return $categories; 
        }

    }

?>