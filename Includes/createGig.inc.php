<?php
session_start();

if(isset($_POST["submit"])){
    
    $title = $_POST["title"];
    $detail = $_POST["detail"];

    include_once "dbh.inc.php";
    include_once "functions.inc.php";

    if(emptyInputGig($title, $detail)){
        header("location: ../createGig.php?error=emptyinput");
        exit();
    }
    $userid = $_SESSION["userid"];
    echo $userid;
    createGig($conn, $title, $detail, $userid);
    
}else{
    header("location: ../createGig.php");
}