<?php

    declare(strict_types = 1);

    class Color {
        public int $colorId;
        public string $colorName;

        public function __construct(int $colorId, string $colorName) {
            $this->colorId = $colorId;
            $this->colorName = $colorName;
        }

        static function searchVehicleColor(PDO $db, int $search, int $count) : array {
            $stmt = $db->prepare('SELECT vehicleId, userId, categoryId, brandId, modelId, colorId, price, condition, kilometers, fueltype FROM Vehicle JOIN
                                Color ON (colorId)
                                WHERE colorId = ? LIMIT ?');
            $stmt->execute(array($search . '%', $count));

            $vehicles = array();
            while ($vehicle = $stmt->fetch()) {
                    $vehicles[] = new Vehicle(
                        $vehicle['vehicleId'],
                        $vehicle['userId'],
                        $vehicle['categoryId'],
                        $vehicle['brandId'],
                        $vehicle['modelId'],
                        $vehicle['colorId'],
                        $vehicle['price'],
                        $vehicle['condition'],
                        $vehicle['kilometers'],
                        $vehicle['fuelType']
                );
            }
        
            return $vehicles;
        }

    }
?>