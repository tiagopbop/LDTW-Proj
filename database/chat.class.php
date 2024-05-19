<?php
declare(strict_types = 1);

class Chat {
    public int $chatId;
    public int $buyerId;
    public int $sellerId;


    public function __construct(int $chatId, int $buyerId, int $sellerId) {
        $this->chatId = $chatId;
        $this->buyerId = $buyerId;
        $this->sellerId = $sellerId;
    }

    public static function getChat($db) {
        try {
            $stmt = $db->query("SELECT * FROM Chat");
            $chats = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $chats;
        } catch (PDOException $e) {
            // Handle the exception as per your application's error handling strategy
            return [];
        }
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