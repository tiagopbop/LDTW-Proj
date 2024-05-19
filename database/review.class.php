<?php
    declare(strict_types = 1);


    class Review {
        public int $idReview;
        public int $userId;
        public int $vehicleId;
        public int $rating;
        public string $comment;
    

        public function __construct(int $idReview, int $userId, int $vehicleId, int $rating, string $comment) {
            $this->idReview = $idReview;
            $this->userId = $userId;
            $this->vehicleId = $vehicleId;
            $this->rating = $rating;
            $this->comment = $comment;

        }

        static function getVehicleReviews(PDO $db, int $id) : array {
            $stmt = $db->prepare('SELECT idReview, userId, rating, comment 
                                FROM Review 
                                WHERE vehicleId = ?');
            $stmt->execute(array($id));

            $reviews = [];

            while ($review = $stmt->fetch()) {
                $reviews[] = new Review(
                    $review['idReview'],
                    $review['userId'],
                    $review['rating'],
                    $review['comment'],
                    $review['vehicleId']
                );
            }
            return $reviews;
        }
        }
        
?>