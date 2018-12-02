<?php 
session_start();
require_once "DBProfileAdapter.php";


if(! isset($_SESSION['oneGame'])) {
    $_SESSION['oneGame'] = new DBProfileAdapter();
}
/////////////////////////////////////////////////////////////
if (isset($_GET['new'])){ 
    $new_username = $_GET['new_username'];
    $new_password = $_GET['new_password'];
    
    $_GET['new'] = new DBProfileAdapter();
    
    if (! $_GET['new']->checkUsername($new_username)) {
        $_GET['new']->addNewUser($new_username, $new_password);
        header("Location: view.php");
    }
    else {
        echo ("<h3>Sorry, the username is already taken. Please try a different username.</h3>");
        echo ("<button type = 'button'><a href = 'register.php'>Back</a></button>");
        exit;
    }
    #Use SESSIONS???????????
    //$_SESSION['oneGame']->addNewUser($new_username, $new_password);

}

if (isset($_GET['return'])) {
    $return_username = $_GET['return_username'];
    $return_password = $_GET['return_password'];
    
    $_GET['return'] = new DBProfileAdapter();
    
    if ($_GET['return']->checkUsername($return_username)) {
        if ($_GET['return']->checkPassword($return_username, $return_password)) {
            header("Location: view.php");
        }
        else {
            echo ("<h3>Sorry, the username or password is incorrect. Please try again.</h3>");
            echo ("<button type = 'button'><a href = 'register.php'>Back</a></button>");
            exit;
        }

    }
    else {
        echo ("<h3>Sorry, the username or password is incorrect. Please try again.</h3>");
        echo ("<button type = 'button'><a href = 'register.php'>Back</a></button>");
        exit;
    }
}

///////////////////////////////////////
if(isset($_GET['start'])) {
    $wordArray = array();
    $parseLine = "";
    $inputFile = fopen("words.txt", "r");
    
    while ($line = fgets($inputFile)) {
        $parseLine = trim($line, "\r\n");
        array_push($wordArray, $parseLine);
    }
    
    $_GET['start'] = $wordArray;
    echo json_encode($_GET['start']);
}


?>