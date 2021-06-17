<?php
    include_once 'header.php';
?>

<p>
    Messages <br>
    <?php
        if(isset($_SESSION["usertype"])){ ?>
<form action="Includes/message.inc.php" method="post">
    <input type="text" name="message" placeholder="your message..."> <br>
    <button type='submit' name="submit">send message</button>
</form>
    <?php }
    ?>
</p>

<?php
    include_once 'footer.php';
?>