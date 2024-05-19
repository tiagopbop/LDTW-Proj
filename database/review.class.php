<?php
    declare(strict_types = 1);


    class Review {
        public int $ReviewId;
        public int $UserId;
        public int $VehicleId;
        public int $Rating;
        public string $Comment;
    

        public function __construct(int $ReviewId, int $UserId, int $VehicleId, int $Rating, string $Comment) {
            $this->ReviewId = $ReviewId;
            $this->UserId = $UserId;
            $this->VehicleId = $VehicleId;
            $this->Rating = $Rating;
            $this->Comment = $Comment;

        }

        static function getVehicleReviews(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT ReviewId, UserId, VehicleId, Rating, Comment 
                                FROM Review 
                                WHERE VehicleId = ?');
            $stmt->execute(array($id));

            $reviews = [];

            while ($review = $stmt->fetch()) {
                $reviews[] = new Review(
                    $review['ReviewId'],
                    $review['UserId'],
                    $review['VehicleId'],
                    $review['Rating'],
                    $review['Comment']
                );
            }
            return $reviews;
        }
        }
        
?>