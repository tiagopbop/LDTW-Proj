<?php
    declare(strict_types = 1);

    
    class User {
        public int $userId;
        public string $userName;
        public string $pass;
        public string $email;
        public bool $is_admin;
        public date $creation;
    

        public function __construct(int $userId, string $userName, string $pass, string $email, bool $is_admin, date $creation) {
            $this->userId = $userId;
            $this->userName = $userName;
            $this->pass = $pass;
            $this->email = $email;
            $this->is_admin = $is_admin;
            $this->creation = $creation;
        }

        public function giveAdmin($db) {
            $stmt = $db->prepare('UPDATE User SET is_admin = 1 WHERE userId = ?');

            $stmt->execute(array($this->is_admin, $this->UserId));
        }

        static function getUserWithPassword(PDO $db, string $email, string $userName, string $pass) : ?Customer {
            $stmt = $db->prepare(' SELECT userId, userName, pass, email, is_admin, creattion_date
            FROM User
            WHERE lower(email) = ? AND userName = ? AND pass = ? ');
  
            $stmt->execute(array(strtolower($email), string($userName), sha1($password)));
    
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

        static funtion getUser (PDO $db, int $id) : User {
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
