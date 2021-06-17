<?php
session_start();

if(isset($_POST["submit"])){
    
    $useruid = $_POST["useruid"];
    $pwd = $_POST["pwd"];

    include_once "dbh.inc.php";
    include_once "functions.inc.php";

    if( emptyInputLogin($useruid, $pwd) !== false ){
        header("location: ../login.php?error=emptyinput");
        exit();
    }
    loginUser($conn, $useruid, $pwd);

}else{
    header("location: ../login.php");
}