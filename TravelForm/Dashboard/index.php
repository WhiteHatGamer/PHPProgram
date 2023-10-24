<?php
    session_start();

    include "../var.php";

    // Connecting to Database
    $Mysqli = mysqli_connect($server, $UserName, $Password, $Database, $port);

    // Get Name from db
    $result = $Mysqli->query("SELECT name FROM user WHERE email='".$_SESSION['email']."'");

    // Greet
    echo "Hello ".$_SESSION['email'];

    // Add Menu
    // Add Note
    // List Note
    // Update Note
    // Delete Node
    
?>