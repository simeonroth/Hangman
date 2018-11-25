<?php 
session_start();
require_once "DBWordsAdapter.php";

if (isset($_GET['new'])) {
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