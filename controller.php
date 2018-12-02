<?php 
session_start();
require_once "DBProfileAdapter.php";
//comment
/////////////////////////////////////////////////////////////
if (isset($_GET['new'])){ //for new users
    $new_username = htmlspecialchars($_GET['new_username']);
    
    $new_password = htmlspecialchars($_GET['new_password']);
    $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
    
    $_GET['new'] = new DBProfileAdapter();
    
    if (! $_GET['new']->checkUsername($new_username)) { //if username exists in database
        $_GET['new']->addNewUser($new_username, $hashed_password);
        header("Location: game.php");
    }
    else {
        echo ("<h3>Sorry, the username is already taken. Please try a different username.</h3>");
        echo ("<button type = 'button'><a href = 'register.php'>Back</a></button>");
        exit;
    }
    #Use SESSIONS???????????
    //$_SESSION['oneGame']->addNewUser($new_username, $new_password);

}

if (isset($_GET['return'])) {//for returning users
    $return_username = htmlspecialchars($_GET['return_username']);
    
    $return_password = htmlspecialchars($_GET['return_password']);
    
    $_GET['return'] = new DBProfileAdapter();
    
    if ($_GET['return']->checkUsername($return_username)) { //if username exists in database
        $arr = $_GET['return']->getPassword($return_username);
        $hashed_password = $arr[0]['password'];
        $valid = password_verify($return_password, $hashed_password);
        
        if ($valid) {
            header ("Location: game.php");
        }
        else { //if username exists, but the password is incorrect
            echo ("<h3>Sorry, the username or password is incorrect. Please try again.</h3>");
            echo ("<button type = 'button'><a href = 'register.php'>Back</a></button>");
            exit;
        }

    }
    else { //if username does not exist in database
        echo $return_username;
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
    echo htmlspecialchars(json_encode($_GET['start']), ENT_NOQUOTES);
}


?>