<?php
    class Session {
        
        public function __construct() {
            session_start();
        }

        public function isLoggedIn() : bool {
            return isset($_SESSION['id']);
        }

        public function logout() {
            session_destroy();
        }

        public function getId() : ?int {
            return isset($_SESSION['id']) ? $_SESSION['id'] : null;
        }

        public function getUsername() : ?string {
            return isset($_SESSION['username']) ? $_SESSION['username'] : null;
        }

        public function setId(int $id) {
            $_SESSION['id'] = $id;
        }

        public function setUsername(string $username) {
            $_SESSION['username'] = $username;
        }

        public function setRole(bool $role) {
            $_SESSION['role'] = $role;
        }

        public function isAdmin() : bool {
            if (!$this->isLoggedIn()) {
                return false;
            }
    
            return $this->isLoggedIn() && isset($_SESSION['role']) && $_SESSION['role'] === true;
        }
    }
?>