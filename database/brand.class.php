<?php

    declare(strict_types = 1);

    class Brand {
        public int $BrandId;
        public string $BrandName;
        public string $logoFilePath;

        public function __construct(int $BrandId, string $BrandName, string $logoFilePath) {
            $this->BrandId = $BrandId;
            $this->BrandName = $BrandName;
            $this->logoFilePath = $logoFilePath;
        }

        static function getBrands(PDO $db) : array {
            $stmt = $db->prepare('SELECT BrandId, BrandName, logoFilePath FROM Brand');
            $stmt->execute();

            $brands = array();
                
            while ($brand = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $brands[] = new Brand(
                    intval($brand['BrandId']),
                    $brand['BrandName'],
                    $brand['logoFilePath']);
            }

            return $brands; 
        }
    }

?>



