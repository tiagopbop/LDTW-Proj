<?php
    declare(strict_types = 1);

    class Vehicle {
        public int $vehicleId;
        public int $userId;
        public int $categoryId;
        public int $brandId;
        public int $modelId;
        public int $colorId;
        public int $price;
        public int $condition;
        public int $kilometers;
        public int $fuelType;
    

        public function __construct(int $vehicleId, int $userId, int $categoryId, int $modelId, int $colorId, int $price, int $condition, int $kilometer, int $fuelType) {
            $this->vehicleId = $vehicleId;
            $this->userId = $userId;
            $this->categoryId = $categoryId;
            $this->brandId = $brandId;
            $this->modelId = $modelId;
            $this->colorId = $colorId;
            $this->price = $price;
            $this->condition = $condition;
            $this->kilometers = $kilometers;
            $this->fuelType = $fuelType;
        }

        public function getRecentVehicles(PDO $db, int $count) : array {
            $stmt = $db->prepare('SELECT vehicleId, userId, categoryId, brandId, modelId, colorId, price, condition, kilometers, fueltype FROM Vehicle LIMIT ?');
            $stmt->execute(array($count));

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

        static function searchBrandVehicle(PDO $db, string $search, int $count) : array {
            $stmt = $db->prepare('SELECT vehicleId, userId, categoryId, brandId, modelId, colorId, price, condition, kilometers, fueltype FROM Vehicle JOIN
                                Brand ON (brandId)
                                WHERE brandName LIKE ? LIMIT ?');
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

        static function searchModelVehicle(PDO $db, string $search, int $count) : array {
            $stmt = $db->prepare('SELECT vehicleId, userId, categoryId, brandId, modelId, colorId, price, condition, kilometers, fueltype FROM Vehicle JOIN
                                Model ON (modelId)
                                WHERE modelName LIKE ? LIMIT ?');
            $stmt->execute(array($search . '%', $count));

            $vehicles = array();
            while ($vehicle = $stmt->fetch()) {
                $vehicles[] = new Vehicle(
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

        static function searchColorVehicle(PDO $db, int $search, int $count) : array {
            $stmt = $db->prepare('SELECT vehicleId, userId, categoryId, brandId, modelId, colorId, price, condition, kilometers, fueltype FROM Vehicle JOIN
                                Color ON (colorId)
                                WHERE colorId = ? LIMIT ?');
            $stmt->execute(array($search . '%', $count));

            $vehicles = array();
            while ($vehicle = $stmt->fetch()) {
                $vehicles[] = new Vehicle(
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

        static function searchFuelVehicle(PDO $db, int $search, int $count) : array {
            $stmt = $db->prepare('SELECT vehicleId, userId, categoryId, brandId, modelId, colorId, price, condition, kilometers, fueltype FROM Vehicle
                                WHERE fuelType = ? LIMIT ?');
            $stmt->execute(array($search . '%', $count));

            $vehicles = array();
            while ($vehicle = $stmt->fetch()) {
                $vehicles[] = new Vehicle(
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

        static function getCategoryVehicles(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT vehicleId, userId, categoryId, brandId, modelId, colorId, price, condition, kilometers, fueltype 
                                  FROM Vehicle
                                  WHERE categoryId = ?')
            $stmt->execute(array($id));

            $vehicles = [];

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