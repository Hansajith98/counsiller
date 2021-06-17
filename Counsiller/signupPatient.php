<?php
    include_once 'header.php';
?>
<div>
<form action="Includes/signupPatient.inc.php" method="post">
    <input type="text" name="name" placeholder="Full Name..."> <br>
    <input type="text" name="userid" placeholder="User Name..."> <br>
    <input type="text" name="email" placeholder="Email..."> <br>
    <input type="text" name="age" placeholder="Age..."> <br>
    <input type="text" name="mobile" placeholder="Mobile Number..."> <br>
    <input type="text" name="city" placeholder="City..."> <br>
    <input type="password" name="pwd" placeholder="Password..."> <br>
    <input type="password" name="confirmpwd" placeholder="Confirm Password..."> <br>
    <button type='submit' name="submit">Sign Up</button>
</form>
<br>
<?php

if(isset($_GET["error"])){
    if($_GET["error"] == "emptyinput"){
        echo "<p>Fill all the fields</p>";

    }else if($_GET["error"] == "invalidemail"){
        echo "<p>Use valid Email</p>";

    }else if($_GET["error"] == "invaliduserid"){
        echo "<p>Use proper User Name</p>";

    }else if($_GET["error"] == "passworddoesntmatch"){
        echo "<p>Confirm Password does not match</p>";

    }else if($_GET["error"] == "existuser"){
        echo "<p>User name already taken</p>";

    }else if($_GET["error"] == "existemail"){
        echo "<p><p>You are already Registered. Please <a href='login.php'>Login here </a> </p></p>";

    }else if($_GET["error"] == "stmtfailed"){
        echo "<p>Something went wrong, Try again</p>";

    }else if($_GET["error"] == "none"){
        echo "<p>Successfuly Registered!</p>";
    }
}

?>
</div>
<?php
    include_once 'footer.php';
?>