<?php
    include_once 'header.php';
?>

<p>
    This is a Home Page. <br>
    <?php
        if(isset($_SESSION["usertype"])){
            if($_SESSION["usertype"] == 'PT'){ 
                include_once "Includes/patientIndex.inc.php";
            }
            if($_SESSION["usertype"] == 'CN'){ 
                echo "<a href='createGig.php'>Make a gig</a>";
            } ?>
    <p>
        <form action="post" method="post">
            <input type="text" name="message" placeholder="Type your message here...">
            <button type="submit">Send message</button>
        </form>
    </p>
    <?php }
    ?>
</p>

<?php
    include_once 'footer.php';
?>