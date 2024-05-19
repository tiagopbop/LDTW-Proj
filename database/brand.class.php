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
            $stmt->execute(array());
            
            $brands = array();
            while ($brand = $stmt->fetch()) {
                $brands[] = new Brand(
                    $brand['BrandId'],
                    $brand['BrandName'],
                    $brand['logoFilePath']
                );
            }
            
            return $brands;
        }

        public static function getBrandNameById(PDO $db, int $brandId) : ?string {
            $stmt = $db->prepare('SELECT BrandName FROM Brand WHERE BrandId = ?');
            $stmt->execute([$brandId]);
            
            $brandName = $stmt->fetchColumn();
            if ($brandName === false) {
                // Return null if no brand name is found
                return null;
            }
            return $brandName;
        }
}
?>



