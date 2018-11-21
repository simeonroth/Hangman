<?php 
session_start();
require_once "DBWordsAdapter.php";

if(! isset($_GET['oneGame'])) {
    $_GET['oneGame'] = new DBWordsAdapter();
    $arr = $_GET['oneGame']->getRandomWord();
}

echo json_encode($arr);

?>