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

}
?>