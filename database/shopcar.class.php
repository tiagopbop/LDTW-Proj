<?php
declare(strict_types = 1);

class Shopcar {
    public int $UserId;
    public int $VehicleId;

    public function __construct(int $UserId, int $VehicleId) {
        $this->UserId = $UserId;
        $this->VehicleId = $VehicleId;
    }

    static function getUserShopCar(PDO $db, int $userId, int $count): array {
        $stmt = $db->prepare('SELECT userId, vehicleId FROM Shopcar 
                              WHERE userId = ? 
                              LIMIT ?');
        $stmt->bindValue(1, $userId, PDO::PARAM_INT); 
        $stmt->bindValue(2, $count, PDO::PARAM_INT);
        $stmt->execute();
    
        $shopcars = [];
        while ($shopcar = $stmt->fetch()) {
            $shopcars[] = new Shopcar(
                $shopcar['userId'],
                $shopcar['vehicleId']
            );
        }
        return $shopcars;
    }
}

?>