<?php


function getUnreadMessage($conn, $userid) {
    $sql = "SELECT * FROM messages  WHERE receiverid = ? AND messageread = ?;" ;
    $stmt = mysqli_stmt_init($conn);
    if(!mysqli_stmt_prepare($stmt, $sql)){
        // header("location: index.php?error=stmtfailed");
        exit();
    }
    $read = "1";
    mysqli_stmt_bind_param($stmt, "ss", $useruid, $read);
    mysqli_stmt_execute($stmt);
    $resultData = mysqli_stmt_get_result($stmt);

    if($row = mysqli_fetch_array($resultData, MY_SQLI_BOTH)){
        return $row;
    }else{
        return false;
    }
    mysqli_stmt_close($stmt);
}