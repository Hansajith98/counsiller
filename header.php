<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Counsiller</title>
</head>
<body>
    <div class = "wrapper">
        <nav>
            <ul>
                <li> <a href="index.php">Home</a> </li>
                <?php
                
                if(isset($_SESSION["userid"])){
                    echo "<li> <a href='profile.php'>My Profile</a> </li>";
                    echo "<li> <a href='Includes/logout.inc.php'>Log Out</a> </li>";
                }else{
                    echo "<li> <a href='signupSelect.php'>Sign Up</a> </li>";
                    echo "<li> <a href='login.php'>Login</a> </li>";
                }
                
                ?>
            </ul>
        </nav>
    </div>
    <br><br>
    <hr>
    <div class = "wrapper">