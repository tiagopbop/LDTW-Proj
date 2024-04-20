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

    }

?>