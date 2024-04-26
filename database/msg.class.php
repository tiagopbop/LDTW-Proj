<?php
declare(strict_types = 1);

class Msg {
    public int $chatId;
    public int $userId;
    public string $when_sent;
    public string $text_message;


    public function __construct(int $chatId, int $UserId, string $when_sent, string $text_message) {
        $this->chatId = $chatId;
        $this->userId = $userId;
        $this->when_sent = $when_sent;
        $this->text_message = $text_message;
    }

    public static function getMessagesByChatId(PDO $db, int $chatId): array {
        $stmt = $db->prepare('SELECT * FROM Msg WHERE chatId = ? ORDER BY when_sent DESC');
        $stmt->execute([$chatId]);
        
        $messages = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $messages[] = new Msg(
                $row['chatId'],
                $row['userId'],
                $row['when_sent'],
                $row['text_message']
            );
        }
        
        return $messages;
    }
}
?>