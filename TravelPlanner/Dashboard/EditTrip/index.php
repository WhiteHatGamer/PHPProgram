<?php
    // Include SQL Connection
    require "../../var.php";
    include "../inc/header.php";

    // Start Session
    session_start();

    // Checking If User is Logged In
    if(!isset($_SESSION['email'])){
        echo "<h3>You Are Logged out Please Login Again!!!</h3><br>";
        echo '<a href="../../index.php">Home</a><br>';
        exit;
    }


    // List Upcoming Journeys as Table
    echo "<h3>Edit Journeys</h3>";
    try {
        $result = $Mysqli->query("SELECT * FROM $JourneyTable WHERE email='{$_SESSION['email']}'");
        echo "<form method='post' action='{$_SERVER['PHP_SELF']}'><table border='3'>
            <tr>
                <th>Source</th>
                <th>Destination</th>
                <th>Way</th>
                <th>Journey</th>
                <th>Return</th>
            </tr>";
        for($i=0;$i<$result->num_rows;$i++){
            $id = '';
            echo "<tr>";
            foreach ($result->fetch_assoc() as $key => $value) {
                if($key=="id"){
                    $id = $value;
                    continue;
                }
                if($key=='email'){
                    continue;
                }
                echo "<td>".$value."</td>";
            }

            // Form Action Buttons
            echo "<td><button type='submit' name='edit' value='$id'>&#9874;</button></td>";
            echo "<td><button type='submit' name='delete' value='$id'>&#9760;</button></td>";
            echo "</tr>";
        }
        echo "</table></form>";
    } catch (Exception $e) {
        echo "<br>Some Error Occurred: {$e->getMessage()}<br>";
    }    
?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Journeys | <?=$_SESSION['email']?></title>
</head>
</html>