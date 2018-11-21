<?php
    //File: Database class
    //Simeon Roth, Brian Ma

class DBWordsAdapter {
    private $DB;
    
    public function __construct() {
        $database = 'mysql:dbname=Words;charset=utf8;host=127.0.0.1';
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
    
    public function getAllRecords() {
        $stmt = $this->DB->prepare('SELECT * FROM words');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getRandomWord() {
        $stmt = $this->DB->prepare('SELECT word FROM words ORDER BY RAND() LIMIT 1');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}//end class DBWordsAdapter


//testing

//$theDBA = new DBWordsAdapter();
//echo $theDBA->getRandomWord()[0]['word'];


//$arr = $theDBA->getAllRecords();
//echo $arr[0]['word'] . "<br>" . $arr[1]['word'] . "<br>" . $arr[2]['word'] . "<br>";
//print_r($arr);


?>