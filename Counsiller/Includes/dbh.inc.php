<?php

$serverName = "localhost";
$userName = "root";
$dBPassword = "";
$dBName = "counsiller";

$conn = mysqli_connect($serverName, $userName, $dBPassword, $dBName);

if(mysqli_connect_errno()){
    die("Connection failed : ". mysqli_connect_error());
}