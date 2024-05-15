<?php
    declare(strict_types = 1);

    
    class User {
        public int $userId;
        public string $userName;
        public string $pass;
        public string $email;
        public bool $is_admin;
    

        public function __construct(int $userId, string $userName, string $pass, string $email, bool $is_admin) {
            $this->userId = $userId;
            $this->userName = $userName;
            $this->pass = $pass;
            $this->email = $email;
            $this->is_admin = $is_admin;
        }

        public function giveAdmin($db) {
            $stmt = $db->prepare('UPDATE User SET is_admin = 1 WHERE userId = ?');

            $stmt->execute(array($this->is_admin, $this->userId));
        }

        static function getUserWithPassword(PDO $db, string $email, string $userName, string $pass) : ?User {
            $stmt = $db->prepare(' SELECT userId, userName, pass, email, is_admin, creattion_date
            FROM User
            WHERE lower(email) = ? AND userName = ? AND pass = ? ');
  
            $stmt->execute(array(strtolower($email), $userName, sha1($pass)));
    
            if ($user = $stmt->fetch()) {
                return new User(
                    $user['userId'],
                    $user['userName'],
                    $user['pass'],
                    $user['email'],
                    $user['is_admin'],
                    $user['creattion_date'],
                );
            } else return null;
        }

        static function getUser (PDO $db, int $id) : ?User {
            $stmt = $db->prepare(' SELECT userId, userName, pass, email, is_admin, creattion_date
            FROM User
            WHERE userId = ? ');

            $stmt->execute(array($id));
            $user = $stmt->fetch();

            return new User(
                $user['userId'],
                $user['userName'],
                $user['pass'],
                $user['email'],
                $user['is_admin'],
                $user['creattion_date'],
            );
        }
    }
?>
