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

    if(isset($_POST['edit'])){
        echo "<br>Edit Details: <br>";
        $result = $Mysqli->query("SELECT * FROM $StayTable WHERE id={$_POST['edit']}");
        echo "<form method='post' name='stay' action={$_SERVER['PHP_SELF']}'><table border='1'>
            <tr>
                <th>City</th>
                <th>Hotel</th>
                <th>CheckIn</th>
                <th>CheckOut</th>
                <th>Night(s)</th>
            </tr>";
        echo "<tr>";
        ?>
            <td><input type="text" name="city" id="city" placeholder="Type City" required list="id_list" onkeyup="getCity(this.value)" onblur="getHotels(this.value)" autocomplete="off"></td>
            <datalist id="id_list">
                <div id="id_city">
                    <!-- To be filled onKeyUp type -->

                </div>
            </datalist>

            <!-- Select List Based on Selected City -->
            <td><select id="id_hotel" name="id_hotel" onchange=getExpense(this.value)>
                <option value="">--Select-Hotel--</option>
            </select></td>
            <output name="HotelExpense" id="HotelExpense"></output>
            <br>
            <br>
            
            <!-- <label for="checkIn">Check In: </label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <label for="checkOut">Check Out: </label> -->
            <!-- Date with Limit using PHP -->
            <td><input style="width: 130px;" type="date" name="checkIn" id="checkIn" required min="<?php echo date('Y-m-d');?>"></td>
            <td><input style="width: 130px;" type="date" name="checkOut" id="checkOut" onchange="calculateExpense(this.value)" required min="<?php echo date('Y-m-d');?>"></td>
            <td><select id="night" name="night" onchange="calculateDate(this.value)">
                <?php for ($i=1; $i < 31; $i++) { 
                    echo "<option value='$i'>$i Night(s)</option>";
                } ?>
                <option value="31">30+ Night(s)</option>
            </select></td>
            <td><button type="submit" name="stay">&#10003;</button></form></td>
            <form method="post">
                <td><button type="submit" name="cancel">&#9747;</button></td>
            </form>
            </table></form>
        <?php
    }

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