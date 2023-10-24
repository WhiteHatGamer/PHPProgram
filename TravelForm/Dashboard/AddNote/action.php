<?php

    // Start session
    session_start();

    // Checking If User is Logged In
    if(!isset($_SESSION['email'])){
        echo "<h3>You Are Logged out Please Login Again!!!</h3><br>";
        echo '<a href="../index.php">Home</a><br>';
        exit;
    }

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

    // Getting Every Notes Saved from User
    $result = $Mysqli->query("SELECT * FROM $NoteTable WHERE email='".$_SESSION['email']."'");

    echo "<br><h5>Saved Notes:</h5><br>";
    foreach ($result->fetch_all() as $key) {
        echo "Modified Time:".$key[0];
        echo "&emsp;";
        echo "Note: ".$key[2];
        echo "<br>";
    }
    
    ?>