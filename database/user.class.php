<?php
    declare(strict_types = 1);

    
    class User {
        public int $UserId;
        public string $userName;
        public string $named;
        public string $pass;
        public string $email;
        public int $is_admin;
    

        public function __construct(int $UserId, string $userName,string $named, string $pass, string $email, int $is_admin) {
            $this->UserId = $UserId;
            $this->userName = $userName;
            $this->pass = $pass;
            $this->email = $email;
            $this->is_admin = $is_admin;
            $this->named = $named;
        }

        public function giveAdmin($db) {
            $stmt = $db->prepare('UPDATE User SET is_admin = 1 WHERE UserId = ?');

            $stmt->execute(array($this->is_admin, $this->UserId));
        }

        static function getUserWithPassword(PDO $db, string $email, string $userName, string $pass) : ?User {
            $stmt = $db->prepare(' SELECT UserId, userName,named, pass, email, is_admin, creattion_date
            FROM User
            WHERE lower(email) = ? AND userName = ? AND pass = ? ');
  
            $stmt->execute(array(strtolower($email), $userName, sha1($pass)));
    
            if ($user = $stmt->fetch()) {
                return new User(
                    $user['UserId'],
                    $user['userName'],
                    $user['named'],
                    $user['pass'],
                    $user['email'],
                    $user['is_admin'],
                );
            } else return null;
        }

        static function getUser (PDO $db, int $id) : ?User {
            $stmt = $db->prepare(' SELECT UserId, userName, named, pass, email, is_admin
            FROM User
            WHERE UserId = ? ');

            $stmt->execute(array($id));
            $user = $stmt->fetch();

            return new User(
                $user['UserId'],
                $user['userName'],
                $user['named'],
                $user['pass'],
                $user['email'],
                $user['is_admin'],
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
