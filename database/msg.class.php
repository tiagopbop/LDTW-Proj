<?php
declare(strict_types = 1);

class Msg {
    public int $chatId;
    public int $userId;
    public string $when_sent;
    public string $text_message;


    public function __construct(int $chatId, int $UserId, string $when_sent, string $text_message) {
        $this->chatId = $chatId;
        $this->userId = $UserId;
        $this->when_sent = $when_sent;
        $this->text_message = $text_message;
    }

    public static function getChatByIds(PDO $db, int $buyerId, int $sellerId): ?int {
        try {
            $stmt = $db->prepare("SELECT ChatId FROM Chat WHERE (BuyerId = :buyer_id AND SellerId = :seller_id) OR (BuyerId = :seller_id AND SellerId = :buyer_id)");
            $stmt->bindValue(':buyer_id', $buyerId, PDO::PARAM_INT);
            $stmt->bindValue(':seller_id', $sellerId, PDO::PARAM_INT);
            $stmt->execute();
            $chatId = $stmt->fetchColumn();
            return $chatId ? (int) $chatId : null;
        } catch (PDOException $e) {
            // Handle the exception as per your application's error handling strategy
            return null;
        }
    }
}
?>