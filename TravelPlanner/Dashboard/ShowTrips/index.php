<?php
    // Include SQL Connection
    require "../../var.php";
    
    // Start Session
    session_start();
    
    include "../inc/header.php";

    // Checking If User is Logged In
    if(!isset($_SESSION['email'])){
        echo "<h3>You Are Logged out Please Login Again!!!</h3><br>";
        echo '<a href="../../index.php">Home</a><br>';
        exit;
    }
    
    try{
        $result = $Mysqli->query("SELECT * FROM $JourneyTable WHERE(email='{$_SESSION['email']}') ORDER BY journey");
        if(!$result->num_rows){
            // No Data Stored
            echo "<br>Sorry!! No Trip is in Database <br>Please Add journey Using This <b><a href='../PlanTrip/index.php'>Link</a></b>";
        }else{
            
            // Details Available
            echo "<h3>Upcoming Journeys</h3>";
            echo "<table border='3'>
                <tr>
                    <th>Source</th>
                    <th>Destination</th>
                    <th>Way</th>
                    <th>Journey</th>
                    <th>Return</th>
                </tr>";
            for($i=0;$i<$result->num_rows;$i++){
                echo "<tr>";
                foreach ($result->fetch_assoc() as $key => $value) {
                    if(($key=="id") || ($key=='email')){
                        continue;
                    }
                    echo "<td>".$value."</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
    }catch(Exception $e){
        echo "ERROR Listing Journeys: {$e->getMessage()}";
    }

?>

<!-- HTML -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Trips | <?=$_SESSION['name']?></title>
</head>
</html>