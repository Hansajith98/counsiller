<?php

include_once "dbh.inc.php";
include_once "functions.inc.php";

$receiverid = 2;

if(isset($_POST["submit"]) && isset($_SESSION["usertype"])){
    $senderid = $_SESSION["userid"];
    $message = $_POST["message"];

    if(empty($message)){
        sendMessage($conn, $senderid, $receiverid, $message);
    }
}else{
    header("location: ../message.php?mid=$receiverid" );
    exit();
}