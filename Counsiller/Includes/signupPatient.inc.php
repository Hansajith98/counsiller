<?php
session_start();

if(isset($_POST["submit"])){
    
    $name = $_POST["name"];
    $userid = $_POST["userid"];
    $email = $_POST["email"];
    $age = $_POST["age"];
    $mobile = $_POST["mobile"];
    $city = $_POST["city"];
    $pwd = $_POST["pwd"];
    $confirmpwd = $_POST["confirmpwd"];

    include_once "dbh.inc.php";
    include_once "functions.inc.php";

    if( emptyInputSignupPatient($name, $userid, $email, $age, $mobile, $city, $pwd, $confirmpwd) !== false ){
        header("location: ../signupPatient.php?error=emptyinput");
        exit();
    }
    if( invalidEmail($email) !== false ){
        header("location: ../signupPatient.php?error=invalidemail");
        exit();
    }
    if( invalidUserId($name) !== false ){
        header("location: ../signupPatient.php?error=invaliduserid");
        exit();
    }
    if( doesntMatchPassword($pwd, $confirmpwd) !== false ){
        header("location: ../signupPatient.php?error=passworddoesntmatch");
        exit();
    }
    $error = existUser($conn, $userid);
    if(  $error !== false ){
        if($error === "stmtfailed"){
            header("location: ../signupPatient.php?error=stmtfailed");
            exit();
        }
        header("location: ../signupPatient.php?error=existuser");
        exit();
    }
    if( $error = existEmail($conn, $email) !== false ){
        if($error === "stmtfailed"){
            header("location: ../signupPatient.php?error=stmtfailed");
            exit();
        }
        header("location: ../signupPatient.php?error=existemail");
        exit();
    }

    createPatient($conn, $name, $userid, $email, $age, $mobile, $city, $pwd, $confirmpwd);

}else{
    header("location: ../signupPatient.php");
}