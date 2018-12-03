<?php
require_once "DBProfileAdapter.php";
session_start();

/*
 * if(! isset($_SESSION['oneGame'])) {
 * $_SESSION['oneGame'] = new DBProfileAdapter();
 * }
 */

// ///////////////////////////////////////////////////////////
if (isset($_GET['new_username']) && isset($_GET['new_password'])) { // for new users
    if (! isset($_GET['new'])) {
        $new_username = htmlspecialchars($_GET['new_username']);

        $new_password = htmlspecialchars($_GET['new_password']);
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

        $_GET['new'] = new DBProfileAdapter();

        if (! $_GET['new']->checkUsername($new_username)) { // if username exists in database
            $_GET['new']->addNewUser($new_username, $hashed_password);
            $_GET['new']->addNewUserLB($new_username);
            echo ($new_username);
        } else {
            echo ("taken");
        }
    }
}

if (isset($_GET['return_username']) && isset($_GET['return_password'])) { // for returning users
    if (! isset($_GET['return'])) {
        $return_username = htmlspecialchars($_GET['return_username']);

        $return_password = htmlspecialchars($_GET['return_password']);

        $_GET['return'] = new DBProfileAdapter();

        if ($_GET['return']->checkUsername($return_username)) { // if username exists in database
            $arr = $_GET['return']->getPassword($return_username);
            $hashed_password = $arr[0]['password'];
            $valid = password_verify($return_password, $hashed_password);

            if ($valid) {
                echo ($return_username);
            } else { // if username exists, but the password is incorrect
                echo ("wrong");
            }
        } else { // if username does not exist in database
            echo ("dne");
        }
    }
}

/*
 * if (isset($_GET['win'])) {
 * $_SESSION['oneGame']->increment();
 * }
 */

// /////////////////////////////////////
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