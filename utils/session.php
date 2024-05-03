<?php
    class Session {
        private array $messages;
        
        public function __construct() {
            session_start();

            $this->messages = isset($_SESSION['messages']) ? $_SESSION['messages'] : array();
            unset($_SESSION['messages']);
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

        public function addMessage(string $type, string $text) {
            $_SESSION['messages'][] = array('type' => $type, 'text' => $text);
          }
      
        public function getMessages() {
            return $this->messages;
        }
    }
?>