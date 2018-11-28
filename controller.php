<?php 
session_start();
require_once "DBProfileAdapter.php";

if (isset($_GET['new'])) {
    $new_username = $_GET['new_username'];
    $new_password = $_GET['new_password'];
    
    $_GET['new'] = new DBProfileAdapter();
    $_GET['new']->addNewUser($new_username, $new_password);
    
    header("Location: view.php");
}
if (isset($_GET['returning'])) {
    header("Location: view.php");
}

if(! isset($_GET['oneGame'])) {
    $wordArray = array();
    $parseLine = "";
    $inputFile = fopen("words.txt", "r");
    
    while ($line = fgets($inputFile)) {
        $parseLine = trim($line, "\r\n");
        array_push($wordArray, $parseLine);
    }
    
    $_GET['oneGame'] = $wordArray;
    echo json_encode($_GET['oneGame']);
}


?>