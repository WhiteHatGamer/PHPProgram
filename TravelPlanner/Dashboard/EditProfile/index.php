<?php
    // Adding SQL Connection
    require __DIR__."/../../var.php";

    // Starting Session
    session_start();

    // Checking If User is Logged In
    if(!isset($_SESSION['email'])){
        echo "<h3>You Are Logged out Please Login Again!!!</h3><br>";
        echo '<a href="../../index.php">Home</a><br>';
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Profile | <?php echo @$_SESSION['name'] ;?></title>
    </head>
    <style>
        img[src=""] {
            display: none;
            }
    </style>
    </body>
</html>
