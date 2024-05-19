<?php

declare(strict_types=1);

class Color {
    public int $colorId;
    public string $colorName;

    public function __construct(int $colorId, string $colorName) {
        $this->colorId = $colorId;
        $this->colorName = $colorName;
    }

    static function getColors(PDO $db): array {
        $stmt = $db->prepare('SELECT colorId, colorName FROM Color');
        $stmt->execute();

        $colors = array();
        while ($color = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $colors[] = new Color(
                intval($color['colorId']),
                $color['colorName']
            );
        }

        return $colors;
    }

    static function getColorNameById(PDO $db, int $id) : ?string {
        $stmt = $db->prepare('SELECT colorName FROM Color WHERE colorId = ?');
        $stmt-> execute([$id]);

        $colorName = $stmt->fetchColumn();
        return $colorName;
    }
}
?>
