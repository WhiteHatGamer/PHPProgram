<?php
    require "../../var.php";

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
    <title>Plan Trip | Travel Planner</title>
</head>
<body>
    <?php
    include "../inc/header.php"
    ?>
    <h3>Plan Journey</h3>
</body>
</html>