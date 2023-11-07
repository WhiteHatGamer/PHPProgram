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

    // Debugging Print
    // print_r($_POST);
    // echo "<br>";


    // Delete Confirmation
    if(isset($_POST['delete'])){
        echo "<br>Confirm <b>Delete</b>: <br>";
        $result = $Mysqli->query("SELECT * FROM $StayTable WHERE id={$_POST['delete']}");
        echo "<form method='post' action='{$_SERVER['PHP_SELF']}'><table border='1'>
            <tr>
                <th>City</th>
                <th>Hotel</th>
                <th>CheckIn</th>
                <th>CheckOut</th>
            </tr>";
        echo "<tr>";
        foreach ($result->fetch_assoc() as $key => $value) {
            if(($key=="id") || ($key=='email')){
                continue;
            }
            echo "<td>".$value."</td>";
        }

        // Button with id as Value
        echo "<td><button type='submit' name='confirm_delete' value={$_POST['delete']}>&#10003;</button></td>";
        echo "<td><button type='submit' name='cancel'>&#9747;</button></td>";
        echo "</tr></table></form>";

    }
    
    if(isset($_POST['confirm_delete'])){
        try{

            // Checking if id Exists for resubmission of Form
            $result = $Mysqli->query("SELECT EXISTS(SELECT * FROM $StayTable WHERE id={$_POST['confirm_delete']})");

            // If exists delete and Show Message
            if($result->fetch_row()[0]!=0){
                $Mysqli->query("DELETE FROM $StayTable WHERE id={$_POST['confirm_delete']}");
                echo "<br>Delete Confirmed for id: {$_POST['confirm_delete']}<br>";
            }
        }catch(Exception $e){
            echo "<br>Exception Occurred : {$e->getMessage()}<br>";
        }

    }


    try{
        $result = $Mysqli->query("SELECT * FROM $StayTable WHERE(email='{$_SESSION['email']}') ORDER BY checkIn");
        if(!$result->num_rows){
            // No Data Stored
            echo "<br>Sorry!! No Trip is in Database <br>Please Add journey Using This <b><a href='../PlanTrip/index.php'>Link</a></b>";
        }else{
            
            // Details Available
            echo "<h3>Hotel Stays</h3>";
            echo "<form method='post'><table border='3'>
                <tr>
                    <th>City</th>
                    <th>Hotel</th>
                    <th>CheckIn</th>
                    <th>CheckOut</th>
                    <th>Edit</th>
                </tr>";
            for($i=0;$i<$result->num_rows;$i++){
                echo "<tr>";
                foreach ($result->fetch_assoc() as $key => $value) {
                    if($key=="id"){
                        $id = $value;
                        continue;
                    }elseif($key=='email'){
                        continue;
                    }
                    echo "<td>".$value."</td>";
                }
                echo "<td><button type='submit' name='edit' value=$id>&#9874;</button>";
                echo "<button type='submit' name='delete' value=$id>&#9760;</button></td>";
                echo "</tr>";
            }
            echo "</table></form>";
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
    <title>Hotel Stays | <?=$_SESSION['name']?></title>
</head>
</html>