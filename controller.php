<?php
require_once "DBProfileAdapter.php";
session_start();
/*
 * if(! isset($_SESSION['oneGame'])) {
 * $_SESSION['oneGame'] = new DBProfileAdapter();
 * }
 */

/////////////////////////////////////////////////////////////
if (isset($_GET['new_username']) && isset($_GET['new_password'])) { // for new users
    if (! isset($_GET['new'])) {
        $new_username = $_GET['new_username'];

        $new_password = $_GET['new_password'];
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $_GET['new'] = new DBProfileAdapter();

        if (! $_GET['new']->checkUsername($new_username)) { // if username exists in database
            $_GET['new']->addNewUser($new_username, $hashed_password);
            $_GET['new']->addNewUserLB($new_username);
            echo htmlspecialchars($new_username);
        } else {
            echo ("taken");
        }
    }
}

if (isset($_GET['return_username']) && isset($_GET['return_password'])) { // for returning users
    if (! isset($_GET['return'])) {
        $return_username = $_GET['return_username'];

        $return_password = $_GET['return_password'];

        $_GET['return'] = new DBProfileAdapter();

        if ($_GET['return']->checkUsername($return_username)) { // if username exists in database
            $arr = $_GET['return']->getPassword($return_username);
            $hashed_password = $arr[0]['password'];
            $valid = password_verify($return_password, $hashed_password);

            if ($valid) {
                echo htmlspecialchars($return_username);
            } else { // if username exists, but the password is incorrect
                echo ("wrong");
            }
        } else { // if username does not exist in database
            echo ("dne");
        }
    }
}

if (isset($_GET['leaderboard'])) {
    if (! isset($_GET['db_lb'])) {
        $_GET['db_lb'] = new DBProfileAdapter();
        
        $arr = $_GET['db_lb']->getLeaderBoard();
        echo htmlspecialchars(json_encode($arr), ENT_NOQUOTES);
    }
}

if (isset($_GET['username'])) {
    if (! isset($_GET['oneDB'])) {
        $username = $_GET['username'];
        $_GET['oneDB'] = new DBProfileAdapter();
        
        $arr = $_GET['oneDB']->getUsername($username);
        
        $games = $arr[0]['totalGames'];
        $wins = $arr[0]['Won'];
        $losses = $arr[0]['Lost'];
        
        $totalScore = $arr[0]['totalScore'];
        $score = $_GET['score'];
        
        if ($_GET['result'] == "L") {
            $_GET['oneDB']->lostGame($username, $games, $wins, $losses, $score, $totalScore);
        }
        else if ($_GET['result'] == "W") {
            $_GET['oneDB']->wonGame($username, $games, $wins, $losses, $score, $totalScore);
        }
        
    }
}

///////////////////////////////////////
if (isset($_GET['start'])) {
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