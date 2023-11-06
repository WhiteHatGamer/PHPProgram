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

    // Checking if Submitted
    if(isset($_POST['edit'])){
        echo "Edit Details: <br>";

        // Listing the Journey to be Edited using id
        $result = $Mysqli->query("SELECT * FROM $JourneyTable WHERE id={$_POST['edit']}")->fetch_assoc();

        // Creating Form with Table
        echo "<form method='post' action='{$_SERVER['PHP_SELF']}'><table border='1'>
            <tr>
                <th>Source</th>
                <th>Destination</th>
                <th>Way</th>
                <th>Journey</th>
                <th>Return</th>
            </tr>";
        echo "<tr>";

        // List Details with same form as create
        ?>
        <td><input type="text" name="source" id="source" required list="id_list" value="<?=$result['source']?>" onkeyup="getCity(this.value)" autocomplete="off"></td>
        <td><input type="text" name="destination" id="destination" value="<?=$result['destination']?>" required list="id_list" onkeyup="getCity(this.value)" autocomplete="off"></td>
        <datalist id="id_list">
            <div id="id_city">
            </div>
        </datalist>
        <td><select name="way" onchange=CalculateTime(this.value)>
            <option value="">--select-Transport--</option>
            <option value="airplane" <?php if($result['way']=='airplane') echo 'selected'; ?>>Airplane</option>
            <option value="train" <?php if($result['way']=='train') echo 'selected'; ?>>Train</option>
            <option value="car" <?php if($result['way']=='car') echo 'selected'; ?>>Car</option>
            <option value="bus" <?php if($result['way']=='bus') echo 'selected'; ?>>Bus</option>
            <option value="cycle" <?php if($result['way']=='cycle') echo 'selected'; ?>>Cycling</option>
            <option value="walk" <?php if($result['way']=='walk') echo 'selected'; ?>>Walk</option>
        </select>
        <output name="tripTime" id="tripTime"></output></td>
        <td><input type="datetime-local" name="journey" id="journey" required value="<?=$result['journey']?>" min="<?php echo date('Y-m-d')."T".date("H:i");?>"></td>
        <td><input type="datetime-local" name="round" id="round" required value="<?=$result['round']?>" min="<?php echo date('Y-m-d')."T".date("H:i");?>"></td>
        <td><button type='submit' name='confirm_edit' value="<?=$_POST['edit']?>">&#10003;</button></td>
    </form>

    <!-- Separate Form to Cancel Else Conflicts with required and Client side -->
    <form method="post" action="<?= $_SERVER['PHP_SELF']?>">
        <td><button type='submit' name='cancel'>&#9747;</button></td>
        </tr></table></form>
    <?php
    }

    // Confirm Edit
    if(isset($_POST['confirm_edit'])){
        try{

            // Edit With input Data in Form Table
            $Mysqli->query("UPDATE $JourneyTable
                SET source='{$_POST['source']}',
                destination='{$_POST['destination']}',
                way='{$_POST['way']}',
                journey='{$_POST['journey']}',
                round='{$_POST['round']}'
                WHERE id='{$_POST['confirm_edit']}'");
            echo "<h3>EDITED</h3>";
            unset($_POST);
        }catch(Exception $e){

            // Catching Exception
            echo "<h3>Error</h3> Storing Plan Details: {$e->getMessage()}<br><br>";
        }
    }

    // Delete Confirmation
    if(isset($_POST['delete'])){
        echo "Confirm Delete: <br>";
        $result = $Mysqli->query("SELECT * FROM $JourneyTable WHERE id={$_POST['delete']}");
        echo "<form method='post' action='{$_SERVER['PHP_SELF']}'><table border='1'>
            <tr>
                <th>Source</th>
                <th>Destination</th>
                <th>Way</th>
                <th>Journey</th>
                <th>Return</th>
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
            $result = $Mysqli->query("SELECT EXISTS(SELECT * FROM $JourneyTable WHERE id={$_POST['confirm_delete']})");

            // If exists delete and Show Message
            if($result->fetch_row()[0]!=0){
                $Mysqli->query("DELETE FROM $JourneyTable WHERE id={$_POST['confirm_delete']}");
                echo "<br>Delete Confirmed for id: {$_POST['confirm_delete']}<br>";
            }
        }catch(Exception $e){
            echo "<br>Exception Occurred : {$e->getMessage()}<br>";
        }

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