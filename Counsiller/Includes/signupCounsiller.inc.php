<?php
session_start();

if(isset($_POST["submit"])){
    
    $username = $_POST["username"];
    $useruid = $_POST["useruid"];
    $email = $_POST["email"];
    $appointedyear = $_POST["appointedyear"];
    $regnumber = $_POST["regnumber"];
    $mobile = $_POST["mobile"];
    $city = $_POST["city"];
    $pwd = $_POST["pwd"];
    $confirmpwd = $_POST["confirmpwd"];

    include_once "dbh.inc.php";
    include_once "functions.inc.php";

    if( emptyInputSignupCounsiller($username, $useruid, $email, $appointedyear, $regnumber, $mobile, $city, $pwd, $confirmpwd) !== false ){
        header("location: ../signupCounsiller.php?error=emptyinput");
        exit();
    }
    if( invalidEmail($email) !== false ){
        header("location: ../signupCounsiller.php?error=invalidemail");
        exit();
    }
    if( invalidUserId($username) !== false ){
        header("location: ../signupCounsiller.php?error=invaliduserid");
        exit();
    }
    if( doesntMatchPassword($pwd, $confirmpwd) !== false ){
        header("location: ../signupCounsiller.php?error=passworddoesntmatch");
        exit();
    }
    $error = existEmail($conn, $email);
    if( $error !== false ){
        if($error === "stmtfailed"){
            header("location: ../signupCounsiller.php?error=stmtfailed");
            exit();
        }
        header("location: ../signupCounsiller.php?error=existemail");
        exit();
    }
    $error = existUser($conn, $userid);
    if( $error !== false ){
        if($error === "stmtfailed"){
            header("location: ../signupPatient.php?error=stmtfailed");
            exit();
        }
        header("location: ../signupCounsiller.php?error=existuser");
        exit();
    }

    createCounsiller( $conn, $username, $useruid, $email, $appointedyear, $regnumber, $mobile, $city, $pwd);

}else{
    header("location: ../signupCounsiller.php");
}