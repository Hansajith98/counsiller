<?php

include_once "dbh.inc.php";
include_once "messageFunctions.inc.php";

if(isset($_SESSION["userid"])) {
    $userid = $_SESSION["userid"];
    $messageResullt = getUnreadMessage($conn, $userid);
    if($messageResullt !== false){
        foreach($messageResullt as $message){
            echo $message['message'] . "<br>";
        }
    }else{
        echo "No new messages <br>";
    }
}

