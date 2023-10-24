<?php

    // Start session
    session_start();

    // Include env Variable
    include "../var.php";
    
    // Connect to database using Credentials// Connect to database using Credentials
    try {
        $Mysqli = mysqli_connect($Server, $UserName,  $Password, $Database, $port);
    } catch (\Throwable $th) {
        echo "ERROR 500 <br><br>Server Error";
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