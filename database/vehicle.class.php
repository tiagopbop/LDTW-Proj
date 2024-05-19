<?php
    declare(strict_types = 1);

    class Vehicle {
        public int $VehicleId;
        public int $UserId;
        public int $typeId;
        public int $BrandId;
        public int $modelId;
        public int $colorId;
        public int $price;
        public int $condition;
        public int $kilometers;
        public int $fuelType;
    

        public function __construct(int $VehicleId, int $UserId, int $typeId, int $BrandId, int $modelId, int $colorId, int $price, int $condition, int $kilometers, int $fuelType) {
            $this->VehicleId = $VehicleId;
            $this->UserId = $UserId;
            $this->typeId = $typeId;
            $this->BrandId = $BrandId;
            $this->modelId = $modelId;
            $this->colorId = $colorId;
            $this->price = $price;
            $this->condition = $condition;
            $this->kilometers = $kilometers;
            $this->fuelType = $fuelType;
        }

        static function getVehicle(PDO $db, int $id) {
            $stmt = $db->prepare('SELECT VehicleId, UserId, typeId, BrandId, modelId, colorId, price, condition, kilometers, fueltype
            FROM vehicle WHERE VehicleId = ?');
            $stmt->execute(array($id));

            $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

            return new Vehicle(
                $vehicle['VehicleId'],
                $vehicle['UserId'],
                $vehicle['typeId'],
                $vehicle['BrandId'],
                $vehicle['modelId'],
                $vehicle['colorId'],
                $vehicle['price'],
                $vehicle['condition'],
                $vehicle['kilometers'],
                $vehicle['fuelType']
            );
        }

        static function getSomeVehicles(PDO $db, int $count) : array {
            // Prepare and execute the query
            $stmt = $db->prepare('SELECT VehicleId, UserId, typeId, BrandId, modelId, colorId, price, condition, kilometers, fueltype FROM Vehicle LIMIT :count');
            $stmt->bindValue(':count', $count, PDO::PARAM_INT);
            $stmt->execute();
        
            // Fetch and construct vehicles
            $vehicles = array();
            while ($vehicle = $stmt->fetch(PDO::FETCH_ASSOC)) {
                // Debugging: Check the fetched data
                if (is_null($vehicle['VehicleId'])) {
                    error_log("Vehicle ID is null: " . json_encode($vehicle));
                }
        
                $vehicles[] = new Vehicle(
                    (int)$vehicle['VehicleId'],
                    (int)$vehicle['UserId'],
                    (int)$vehicle['typeId'],
                    (int)$vehicle['BrandId'],
                    (int)$vehicle['modelId'],
                    (int)$vehicle['colorId'],
                    (int)$vehicle['price'],
                    (int)$vehicle['condition'],
                    (int)$vehicle['kilometers'],
                    (int)$vehicle['fuelType']
                );
            }
        
            return $vehicles;
        }
        

        static function searchBrandVehicle(PDO $db, string $search, int $count) : array {
            $stmt = $db->prepare('SELECT VehicleId, UserId, typeId, BrandId, modelId, colorId, price, condition, kilometers, fueltype FROM Vehicle JOIN
                                Brand ON (BrandId)
                                WHERE brandName LIKE ? LIMIT ?');
            $stmt->execute(array($search . '%', $count));

            $vehicles = array();
            while ($vehicle = $stmt->fetch()) {
                $vehicles[] = new Vehicle(
                    $vehicle['VehicleId'],
                    $vehicle['UserId'],
                    $vehicle['typeId'],
                    $vehicle['BrandId'],
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
            $stmt = $db->prepare('SELECT VehicleId, UserId, typeId, BrandId, modelId, colorId, price, condition, kilometers, fueltype FROM Vehicle JOIN
                                Model ON (modelId)
                                WHERE modelName LIKE ? LIMIT ?');
            $stmt->execute(array($search . '%', $count));

            $vehicles = array();
            while ($vehicle = $stmt->fetch()) {
                    $vehicles[] = new Vehicle(
                        $vehicle['VehicleId'],
                        $vehicle['UserId'],
                        $vehicle['typeId'],
                        $vehicle['BrandId'],
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
            $stmt = $db->prepare('SELECT VehicleId, UserId, typeId, BrandId, modelId, colorId, price, condition, kilometers, fueltype FROM Vehicle JOIN
                                Color ON (colorId)
                                WHERE colorId = ? LIMIT ?');
            $stmt->execute(array($search . '%', $count));

            $vehicles = array();
            while ($vehicle = $stmt->fetch()) {
                    $vehicles[] = new Vehicle(
                        $vehicle['VehicleId'],
                        $vehicle['UserId'],
                        $vehicle['typeId'],
                        $vehicle['BrandId'],
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
            $stmt = $db->prepare('SELECT VehicleId, UserId, typeId, BrandId, modelId, colorId, price, condition, kilometers, fueltype FROM Vehicle
                                WHERE fuelType = ? LIMIT ?');
            $stmt->execute(array($search . '%', $count));

            $vehicles = array();
            while ($vehicle = $stmt->fetch()) {
                    $vehicles[] = new Vehicle(
                        $vehicle['VehicleId'],
                        $vehicle['UserId'],
                        $vehicle['typeId'],
                        $vehicle['BrandId'],
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
            $stmt = $db->prepare('SELECT VehicleId, UserId, typeId, BrandId, modelId, colorId, price, condition, kilometers, fueltype 
                                  FROM Vehicle
                                  WHERE typeId = ?');
            $stmt->execute(array($id));

            $vehicles = [];

            while ($vehicle = $stmt->fetch()) {
                $vehicles[] = new Vehicle(
                    $vehicle['VehicleId'],
                    $vehicle['UserId'],
                    $vehicle['typeId'],
                    $vehicle['BrandId'],
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

        static function getVehicleCount(PDO $db) {
            $stmt = $db->query('SELECT COUNT(*) AS vehicleCount FROM vehicles');
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row['vehicleCount'];
        }

        static function getTypeVehicles(PDO $db, int $id) : array {
                $stmt = $db->prepare('SELECT VehicleId, Vehicle.UserId, Vehicle.typeId, Vehicle.BrandId, Vehicle.modelId, Vehicle.colorId, Vehicle.price, Vehicle.condition, Vehicle.kilometers, Vehicle.fueltype 
                      FROM Vehicle 
                      JOIN Types ON Vehicle.typeId = Types.typeId
                      WHERE Types.categoryId = ?');

            $stmt->execute(array($id));
        
            $vehicles = [];
        
            while ($vehicle = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $vehicles[] = new Vehicle(
                    $vehicle['VehicleId'],
                    $vehicle['UserId'],
                    $vehicle['typeId'],
                    $vehicle['BrandId'],
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