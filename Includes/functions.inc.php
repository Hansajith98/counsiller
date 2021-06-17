<?php

function emptyInputSignupAdmin($username, $useruid, $email, $pwd, $confirmpwd) {
    if(empty($username) || empty($useruid) || empty($email) || empty($pwd) || empty($confirmpwd)){
        return true;
    }
    return false;
}

function emptyInputSignupPatient($username, $useruid, $email, $age, $mobile, $city, $pwd, $confirmpwd) {
    if(empty($username) || empty($useruid) || empty($email) || empty($pwd) || empty($confirmpwd) || empty($city) || empty($mobile) || empty($age)) {
        return true;
    }
    return false;
}

function emptyInputSignupCounsiller($username, $useruid, $email, $appointedyear, $regnumber, $mobile, $city, $pwd, $confirmpwd) {
    if(empty($username) || empty($useruid) || empty($email) || empty($appointedyear) || empty($regnumber) || empty($mobile) || empty($city) || empty($pwd) || empty($confirmpwd)){
        return true;
    }
    return false;
}

function emptyInputGig($title, $detail) {
    if(empty($title) || empty($detail)){
        return true;
    }
    return false;
}

function emptyInputLogin($useruid, $pwd) {
    if(empty($useruid) || empty($pwd)){
        return true;
    }
    return false;
}

function invalidEmail($email) {
    if( !filter_var($email, FILTER_VALIDATE_EMAIL) ){
        return true;
    }
    return false;
}

function invalidUserId($useruid) {
    if(!preg_match('/^[a-zA-Z0-9]+/', $useruid)){
        return true;
    }
    return false;
}

function doesntMatchPassword($pwd, $confirmpwd) {
    if($pwd !== $confirmpwd){
        return true;
    }
    return false;
}

function existUser($conn, $useruid) {
    $sql = "SELECT * FROM users WHERE useruid = ?;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return "stmtfailed";
    }
    mysqli_stmt_bind_param($stmt, "s", $useruid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if(!mysqli_fetch_assoc($resultData)){
        return false;
    }else{
        return true;
    }
    mysqli_stmt_close($stmt);

}

function existEmail($conn, $email) {
    $sql = "SELECT * FROM users WHERE email = ?;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        return "stmtfailed";
    }
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if(!mysqli_fetch_assoc($resultData)){
        return false;
    }else{
        return true;
    }
    mysqli_stmt_close($stmt);

}

function createPatient($conn, $username, $useruid, $email, $age, $mobile, $city, $pwd) {
    $sql = "INSERT INTO users ( username, email, age, mobile, city, useruid, pwd, usertype) VALUES( ?, ?, ?, ?, ?, ?, ?, ?);" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signupPatient.php?error=stmtfailed");
        exit();
    }

    $usertype = "PT";
    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "ssssssss", $username, $email, $age, $mobile, $city, $useruid, $hashpwd, $usertype);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../login.php?error=none");
    exit();

}

function createAdmin($conn, $username, $useruid, $email, $pwd) {
    $sql = "INSERT INTO users (username, email, useruid, pwd, usertype) VALUES( ?, ?, ?, ?, ?);" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signupAdmin.php?error=stmtfailed");
        exit();
    }

    $usertype = "AD";
    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssss", $username, $email, $useruid, $hashpwd, $usertype);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../login.php?error=none");
    exit();

}

function createCounsiller($conn, $username, $useruid, $email, $appointedyear, $regnumber, $mobile, $city, $pwd) {
    $sql = "INSERT INTO users (username, email, appointedyear, govregnumber, mobile, city, useruid, pwd, usertype) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?);" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../signupCounsiller.php?error=stmtfailed");
        exit();  
    }
    $usertype = "CN";
    $hashpwd = password_hash($pwd, PASSWORD_DEFAULT);

    mysqli_stmt_bind_param($stmt, "sssssssss", $username, $email, $appointedyear, $regnumber, $mobile, $city, $useruid, $hashpwd, $usertype);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../login.php?error=none");
    exit();

}

function loginUser($conn, $useruid, $pwd) {
    $uidExist = existEmailorId($conn, $useruid);

    if($uidExist === false){
        header("location: ../login.php?error=invalidlogin");
        exit();
    }else{
        $pwdHashed = $uidExist["pwd"];
        $checkpwd = password_verify($pwd, $pwdHashed);
        if($checkpwd === false){
            header("location: ../login.php?error=$pwdHashed");
            exit();
        }else if($checkpwd === true){
            session_start();
            $_SESSION["userid"] = $uidExist["userid"];
            $_SESSION["useruid"] = $uidExist["useruid"];
            $_SESSION["usertype"] = $uidExist["usertype"];


            header("location: ../index.php");
            exit();
        }
    }

}

function existEmailorId($conn, $useruid) {
    $sql = "SELECT * FROM users WHERE useruid = ? OR email = ?;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../login.php?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "ss", $useruid, $useruid);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_assoc($resultData)){
        return $row;
    }else{
        return false;
    }
    mysqli_stmt_close($stmt);
}

function createGig($conn, $title, $detail, $userid){
    $sql = "INSERT INTO gigs ( counsillerid, topic, details, gigdate) VALUES ( ?, ?, ?, ?);" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../createGig.php?error=stmtfailed");
        exit();
    }
    $date = date("Y-m-d");

    mysqli_stmt_bind_param($stmt, "ssss", $userid, $title, $detail, $date);
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../index.php");
    exit();
}

function getGigForPatient($conn) {
    $sql = "SELECT * FROM gigs ;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        exit();
    }
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_all($resultData)){
        return $row;
    }else{
        return false;
    }
    mysqli_stmt_close($stmt);
}

function sendMessage($conn, $senderid, $receiverid, $message){
    $sql = "INSERT INTO messages ( senderid, recieverid, messagecontent, messagetime, messageread) VALUES ( ?, ?, ?, ?, ?);" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        header("location: ../createGig.php?error=stmtfailed");
        exit();
    }
    $date = date("Y-m-d h:i:sa");
    $read = "1";
    
    mysqli_stmt_bind_param($stmt, "sssss", $senderid, $receiverid, $message, $date, );
    mysqli_stmt_execute($stmt);

    mysqli_stmt_close($stmt);

    header("location: ../message.php");
    exit();
}