<?php

    declare(strict_types = 1);

    class Wishlist {
        public int $UserId;
        public string $VehicleId;


        public function __construct(int $UserId, string $VehicleId) {
            $this->UserId = $UserId;
            $this->VehicleId = $VehicleId;
        }

        static function getUserWishlist(PDO $db, int $userId, int $count): array {
            $stmt = $db->prepare('SELECT userId, vehicleId FROM Wishlist 
                                  WHERE userId = ? 
                                  LIMIT ?');
            $stmt->bindValue(1, $userId, PDO::PARAM_INT); 
            $stmt->bindValue(2, $count, PDO::PARAM_INT);
            $stmt->execute();
        
            $wishlistV = [];
            while ($wishlist = $stmt->fetch()) {
                $wishlistV[] = new Wishlist(
                    $wishlist['userId'],
                    $wishlist['vehicleId']
                );
            }
            return $wishlistV;
        }
        
    }
?> 