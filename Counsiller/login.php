<?php
    include_once 'header.php';
?>
<div>
<form action="Includes/login.inc.php" method="post">
    <input type="text" name="useruid" placeholder="User Name or Email..."> <br>
    <input type="password" name="pwd" placeholder="Password..."> <br>
    <button type='submit' name="submit">Log In</button>
</form>

<?php

if(isset($_GET["error"])){
    if($_GET["error"] == "emptyinput"){
        echo "<p>Fill all the fields</p>";

    }else if($_GET["error"] == "invalidlogin"){
        echo "<p>Do you have Registered? If not, <a href='signupSelect.php'>Register here </a></p> ";

    }else if($_GET["error"] == "invalidloginInfo"){
        echo "<p>User name or password is incorrect!</p>";

    }else if($_GET["error"] == "stmtfailed"){
        echo "<p>Something went wrong, Try again</p>";

    }else if($_GET["error"] == "none"){
        echo "<p>Yoe are registered successfully. Please login...</p>";

    }
}

?>

</div>
<?php
    include_once 'footer.php';
?>