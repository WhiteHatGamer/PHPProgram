<?php

    // Start session
    session_start();

    // Checking If User is Logged In
    if(!isset($_SESSION['email'])){
        echo "<h3>You Are Logged out Please Login Again!!!</h3><br>";
        echo '<a href="../../index.php">Home</a><br>';
        exit;
    }
    ?>

    <!-- Adding Name in Title -->
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Add Note | <?php echo htmlspecialchars($_SESSION['name'])?></title>
        </head>
    </html>
    
    <?php

    // Include env Variable
    require "../../var.php";
    
    // Check if Database is Connected
    if($Mysqli->host_info==NULL){
        throw new Exception("Error Processing Request", 1);
    }
    
    // Executing Query to add a contact
    $Mysqli->query(
        "INSERT INTO `$NoteTable`(`email`,`note`) values('".$_SESSION['email']."','".htmlspecialchars($_POST['note'])."')"
    );
    echo "<h3>Note Saved</h3>";

    // Return To Dashboard
    echo "Goto ";
    echo "<a href='../index.php'>Dashboard</a>";
    
?>