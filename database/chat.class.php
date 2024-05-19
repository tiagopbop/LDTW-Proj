<?php
declare(strict_types = 1);

class Chat {
    public int $ChatId;
    public int $BuyerId;
    public int $SellerId;


    public function __construct(int $ChatId, int $BuyerId, int $SellerId) {
        $this->ChatId = $ChatId;
        $this->BuyerId = $BuyerId;
        $this->SellerId = $SellerId;
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
    public static function getChatByIds(PDO $db, int $BuyerId, int $SellerId): ?int {
        try {
            $stmt = $db->prepare("SELECT ChatId FROM Chat WHERE (BuyerId = :buyer_id AND SellerId = :seller_id) OR (BuyerId = :seller_id AND SellerId = :buyer_id)");
            $stmt->bindValue(':buyer_id', $BuyerId, PDO::PARAM_INT);
            $stmt->bindValue(':seller_id', $SellerId, PDO::PARAM_INT);
            $stmt->execute();
            $ChatId = $stmt->fetchColumn();
            return $ChatId ? (int) $ChatId : null;
        } catch (PDOException $e) {
            // Handle the exception as per your application's error handling strategy
            return null;
        }
    }
}
?>