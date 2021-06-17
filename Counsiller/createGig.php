<?php 
    include_once 'header.php';
    if(isset($_SESSION["usertype"])){
        if($_SESSION["usertype"] == "CN"){
?>

<p>
    This is a Home Page. <br>

            <form action="Includes/createGig.inc.php" method="post">
                <input type="text" name="title" placeholder="Title Here..."> <br>
                <input type="text" name="detail" placeholder="Details Here..."> <br>
                <button type="submit" name="submit">Post Gig</button>
            </form>

</p>

<?php
            include_once 'footer.php';
        }
    }else{
        header("location: index.php");
    }
?>