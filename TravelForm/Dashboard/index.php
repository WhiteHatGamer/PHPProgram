<?php

    // Adding MySQL Connection
    require "../var.php";
    
    // Starting Session
    session_start();

    include "../var.php";

    // Connecting to Database
    $Mysqli = mysqli_connect($server, $UserName, $Password, $Database, $port);

    // Get Name from db
    $result = $Mysqli->query("SELECT name FROM user WHERE email='".$_SESSION['email']."'");

    // Greet
    echo "Hello ".$_SESSION['email'];

    // Add Menu
    echo "Actions:<br>"
?>
<!-- Add Note -->
<a href="AddNote/index.php">Create Note</a><br>
<!-- List Note -->
<a href="ReadNote/index.php">Read Notes</a><br>
<!-- Update Note -->
<a href="UpdateNote/index.php">Update Notes</a><br>
<!-- Delete Note -->
<a href="DeleteNote/index.php">Delete Note</a><br>
    // Add Note
    // List Note
    // Update Note
    // Delete Node
    
?>