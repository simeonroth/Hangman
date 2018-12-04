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
        $stmt = $this->DB->prepare('insert into leaderboard(username, totalGames, Won, Lost, totalScore) VALUES( :username, :games, :won, :lost, :totalScore)');
        $stmt->bindParam(':username', $userName);
        $stmt->bindParam(':games', $val);
        $stmt->bindParam(':won', $val);
        $stmt->bindParam(':lost', $val);
        $stmt->bindParam(':totalScore', $val);
        
        $stmt->execute();
    }
    public function lostGame($username, $games, $wins, $losses, $score, $totalScore) {
        $newLosses = $losses + 1;
        $newGames = $games + 1;
        $totalScore = $totalScore + $score;
        
        $stmt = $this->DB->prepare('UPDATE leaderboard SET Won = :win, Lost = :lost, totalGames = :games,  
                                    totalScore = :totalScore WHERE username = :username');
        
        $stmt->bindParam(':win', $wins);
        $stmt->bindParam(':lost', $newLosses);
        $stmt->bindParam(':games', $newGames);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':totalScore', $totalScore);
        
        $stmt->execute();
    }
    public function wonGame($username, $games, $wins, $losses, $score, $totalScore) {
        $newWins = $wins + 1;
        $newGames = $games + 1;
        $totalScore = $totalScore + $score;
        
        $stmt = $this->DB->prepare('UPDATE leaderboard SET Won = :win, Lost = :lost, totalGames = :games, 
                                    totalScore = :totalScore WHERE username = :username');
        
        $stmt->bindParam(':win', $newWins);
        $stmt->bindParam(':lost', $losses);
        $stmt->bindParam(':games', $newGames);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':totalScore', $totalScore);
        
        $stmt->execute();
    }
    public function getLeaderBoard() {
        $stmt = $this->DB->prepare('SELECT * FROM leaderboard');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function joinLeaderBoard() {
        $stmt = $this->DB->prepare('SELECT user_info.username, leaderboard.totalGames, leaderboard.Won, leaderboard.Lost, leaderboard.totalScore FROM user_info JOIN leaderboard ON user_info.username = leaderboard.username');
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
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
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getUsername($username) {
        $stmt = $this->DB->prepare('SELECT * FROM leaderboard WHERE username = :username');
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchALL(PDO::FETCH_ASSOC);
    }
    
}


?>