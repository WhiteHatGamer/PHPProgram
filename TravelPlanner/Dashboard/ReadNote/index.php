<?php

    // Adding MySQL Connection
    require "../../var.php";

    // Starting Session
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
            <title>Read Note | <?php echo htmlspecialchars($_SESSION['name'])?></title>
        </head>
    </html>
    
    <?php
    include __DIR__."/../inc/header.php";

    // Getting Every Notes Saved from User
    $result = $Mysqli->query("SELECT * FROM $NoteTable WHERE email='".$_SESSION['email']."'");
    
    if(!$result->num_rows){
            
        // No Data Stored
        echo "<br>Sorry!! No Notes Added in Database <br>Please Add Your Notes Using This <b><a href='../CreateNote/index.php'>Link</a></b>";
        exit;
    }

    // Looping Through Result
    echo "<br><h5>Saved Notes:</h5><br>";
    echo "<table border='1px'>";
    echo "
    <tr>
        <th>Modified Time</th>
        <th>Note</th>
    </tr>";
    foreach ($result->fetch_all() as $key) {
        echo "<tr>
            <td>".date("d/M H:i",strtotime($key[0]))."</td>";
        echo "<td>".$key[2]."</td>";
        echo "</tr>";
    }
    echo "</table>";

    // Return To Dashboard
    echo "<br>Goto ";
    echo "<a href='../index.php'>Dashboard</a>";
?>