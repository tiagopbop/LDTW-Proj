<?php

    declare(strict_types = 1);

    class Wishlist {
        public int $UserId;
        public int $VehicleId;


        public function __construct(int $UserId, int $VehicleId) {
            $this->UserId = $UserId;
            $this->VehicleId = $VehicleId;
        }

        static function getUserWishlist(PDO $db, int $userId): array {
            $stmt = $db->prepare('SELECT UserId, vehicleId FROM Wishlist 
                                  WHERE UserId = ?');
            $stmt->bindValue(1, $userId, PDO::PARAM_INT); 
            $stmt->execute();
        
            $wishlistV = [];
            while ($wishlist = $stmt->fetch(PDO::FETCH_ASSOC)) {
                $wishlistV[] = new Wishlist(
                    $wishlist['UserId'],
                    $wishlist['VehicleId']
                );
            }
            return $wishlistV;
        }
        
    }
?> 