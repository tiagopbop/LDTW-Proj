<?php

    declare(strict_types = 1);

    class Brand {
        public int $brandId;
        public string $brandName;

        public function __construct(int $brandId, string $brandName) {
            $this->brandId = $brandId;
            $this->brandName = $brandName;
        }
    }

?>



