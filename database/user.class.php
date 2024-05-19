<?php
    declare(strict_types = 1);

    
    class User {
        public int $userId;
        public string $userName;
        public string $named;
        public string $pass;
        public string $email;
        public bool $is_admin;
    

        public function __construct(int $userId, string $userName,string $named, string $pass, string $email, bool $is_admin) {
            $this->userId = $userId;
            $this->userName = $userName;
            $this->pass = $pass;
            $this->email = $email;
            $this->is_admin = $is_admin;
            $this->named = $named;
        }

        public function giveAdmin($db) {
            $stmt = $db->prepare('UPDATE User SET is_admin = 1 WHERE userId = ?');

            $stmt->execute(array($this->is_admin, $this->userId));
        }

        static function getUserWithPassword(PDO $db, string $email, string $userName, string $pass) : ?User {
            $stmt = $db->prepare(' SELECT userId, userName,named, pass, email, is_admin, creattion_date
            FROM User
            WHERE lower(email) = ? AND userName = ? AND pass = ? ');
  
            $stmt->execute(array(strtolower($email), $userName, sha1($pass)));
    
            if ($user = $stmt->fetch()) {
                return new User(
                    $user['userId'],
                    $user['userName'],
                    $user['named'],
                    $user['pass'],
                    $user['email'],
                    $user['is_admin'],
                    $user['creattion_date'],
                );
            } else return null;
        }

        static function getUser (PDO $db, int $id) : ?User {
            $stmt = $db->prepare(' SELECT userId, userName,named, pass, email, is_admin, creattion_date
            FROM User
            WHERE userId = ? ');

            $stmt->execute(array($id));
            $user = $stmt->fetch();

            return new User(
                $user['userId'],
                $user['userName'],
                $user['named'],
                $user['pass'],
                $user['email'],
                $user['is_admin'],
                $user['creattion_date'],
            );
        }
        public static function getUsers($db) {
            try {
                $stmt = $db->query("SELECT * FROM User");
                $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $users;
            } catch (PDOException $e) {
                // Handle the exception as per your application's error handling strategy
                return [];
            }
        }
    }
?>
