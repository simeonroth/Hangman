<?php
    //File: Database class for users
    //Simeon Roth, Brian Ma

class DBProfileAdapter {
    private $DB;
    
    public function __construct() {
        $database = 'mysql:dbname=Users;charset=utf8;host=127.0.0.1';
        $user = 'root';
        $password = '';
        try {
            $this->DB = new PDO ($database, $user, $password);
            $this->DB->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo ('Error establishing connection');
            exit();
        }    
    }
    
    public function addNewUser($userName, $password) {
        $stmt = $this->DB->prepare('insert into user_info(username, password) VALUES( :username, :password)');
        $stmt->bindParam(':username', $userName);
        $stmt->bindParam(':password', $password);
        
        $stmt->execute();
    }
    public function addNewUserLB($userName) {
        $val = 0;
        $stmt = $this->DB->prepare('insert into leaderboard(username, totalGames, Won, Lost) VALUES( :username, :games, :won, :lost)');
        $stmt->bindParam(':username', $userName);
        $stmt->bindParam(':games', $val);
        $stmt->bindParam(':won', $val);
        $stmt->bindParam(':lost', $val);
        
        $stmt->execute();
    }
    public function increment() {
        $val = 1;
        $stmt = $this->DB->prepare('UPDATE leaderboard SET Lost = :lost, totalGames = :games');
        $stmt->bindParam(':lost', $val);
        $stmt->bindParam(':games', $val);
        
        $stmt->execute();
    }
    
    public function checkUsername($userName) {
        $stmt = $this->DB->prepare('SELECT username FROM user_info WHERE EXISTS (SELECT username FROM user_info WHERE username = :username)');
        $stmt->bindParam(':username', $userName);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getPassword($userName) {
        $stmt = $this->DB->prepare('SELECT password FROM user_info WHERE username = :username');
        $stmt->bindParam(':username', $userName);
        
        //$stmt = $this->DB->prepare('SELECT username FROM user_info WHERE EXISTS (SELECT password FROM user_info WHERE password = :password and username = :username)');
        
        //$stmt->bindParam(':password', $password);
        //$stmt->bindParam(':username', $userName);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}



?>