<?php
declare(strict_types = 1);

class Trans {
    public int $transId;
    public int $buyerId;
    public int $sellerId; 
    public int $vehicleId;

    public function __construct(int $transId, int $buyerId, int $sellerId, int $vehicleId) {
        $this->transId = $transId;
        $this->buyerId = $buyerId;
        $this->sellerId = $sellerId;
        $this->vehicleId = $vehicleId;
    }

    static function getTransactionsByVehicleId(PDO $db, int $vehicleId): array {
        $stmt = $db->prepare('SELECT * FROM Trans WHERE vehicleId = ?');
        $stmt->execute([$vehicleId]);
        
        $transactions = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $transactions[] = new Trans(
                $row['transId'],
                $row['buyerId'],
                $row['sellerId'],
                $row['vehicleId']
            );
        }
        
        return $transactions;
    }

    public static function getTransactionsByUserId(PDO $db, int $userId): array {
        $stmt = $db->prepare('SELECT * FROM Trans WHERE buyerId = ? OR sellerId = ?');
        $stmt->execute([$userId, $userId]);
        
        $transactions = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $transactions[] = new Trans(
                $row['transId'],
                $row['buyerId'],
                $row['sellerId'],
                $row['vehicleId']
            );
        }
        
        return $transactions;
    }
}
?>


