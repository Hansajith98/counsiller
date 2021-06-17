<?php
session_start();

if(isset($_POST["submit"])){

    $username = $_POST["username"];
    $useruid = $_POST["useruid"];
    $email = $_POST["email"];
    $pwd = $_POST["pwd"];
    $confirmpwd = $_POST["confirmpwd"];

    include_once "dbh.inc.php";
    include_once "functions.inc.php";

    if( emptyInputSignupAdmin($username, $useruid, $email, $pwd, $confirmpwd) !== false ){
        header("location: ../signupAdmin.php?error=emptyinput");
        exit();
    }
    if( invalidEmail($email) !== false ){
        header("location: ../signupAdmin.php?error=invalidemail");
        exit();
    }
    if( invalidUserId($username) !== false ){
        header("location: ../signupAdmin.php?error=invaliduserid");
        exit();
    }
    if( doesntMatchPassword($pwd, $confirmpwd) !== false ){
        header("location: ../signupAdmin.php?error=passworddoesntmatch");
        exit();
    }
    if( existUser($conn, $useruid) !== false ){
        header("location: ../signupAdmin.php?error=existuser");
        exit();
    }
    if( existEmail($conn, $email) !== false ){
        header("location: ../signupAdmin.php?error=existemail");
        exit();
    }

    createAdmin($conn, $username, $useruid, $email, $pwd);

}else{
    header("location: ../signupAdmin.php");
}
    