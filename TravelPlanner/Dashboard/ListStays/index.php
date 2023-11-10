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

    // Edit Form With Autocomplete
    if(isset($_POST['edit'])){
        echo "<br>Edit Details: <br>";

        // Getting Results Based on id
        $result = $Mysqli->query("SELECT * FROM $StayTable WHERE id={$_POST['edit']}")->fetch_all()[0];
        $city = $result[1];
        $Hotel = $result[2];
        $checkIn = strtotime($result[3]);
        $checkOut = strtotime($result[4]);
        $night = round(($checkOut-$checkIn)/60/60/24);

        // Form Table start
        echo "<form method='post' name='stay' action='{$_SERVER['PHP_SELF']}'><table border='1'>
            <tr>
                <th>City</th>
                <th>Hotel</th>
                <th>CheckIn</th>
                <th>CheckOut</th>
                <th>Night(s)</th>
            </tr>";
        echo "<tr>";
        ?>
            <td><input type="text" name="city" id="city" placeholder="Type City" required list="id_list" onkeyup="getCity(this.value)" onblur="getHotels(this.value)" autocomplete="off" value="<?=$city?>" autofocus></td>
            <datalist id="id_list">
                <div id="id_city">
                    <!-- To be filled onKeyUp type -->

                </div>
            </datalist>

            <!-- Select List Based on Selected City -->
            <td><select id="id_hotel" name="id_hotel" onchange=getExpense(this.value) required>
                <option value="<?=$Hotel?>"><?=$Hotel?></option>
            </select></td>
            <br>
            <br>
            
            <!-- Date with Limit using PHP -->
            <td>
                <input style="width: 130px;" type="date" name="checkIn" id="checkIn" required
                    min="<?php echo date('Y-m-d');?>" value="<?=date('Y-m-d',$checkIn)?>">
            </td>
            <td>
                <input  style="width: 130px;" type="date" name="checkOut" id="checkOut" onchange="calculateExpense(this.value)"
                    min="<?php echo date('Y-m-d');?>" value="<?=date('Y-m-d',$checkOut)?>" max="checkIn.value" required>
            </td>
            <td>
                <select id="night" name="night" onchange="calculateDate(this.value)" required>
                <?php for ($i=1; $i < 31; $i++) { 
                    echo "<option value='$i' ".(($i==$night)? 'selected':'').">$i Night(s)</option>";
                } ?>
                <option value="31" <?=($night>30)?'selected':''?>>30+ Night(s)</option>
                </select>
            </td>
            <td>
                <button type="submit" name="stay" value="<?=$_POST['edit']?>">&#10003;</button></form>
            </td>
            <form method="post">
                <td>
                    <button type="submit" name="cancel">&#9747;</button>
                </td>
            </form>
        </table>
        <output name="HotelExpense" id="HotelExpense">
            <!-- Filling Estimate on change -->
        </output>
        <?php
    }

    if(isset($_POST['stay'])){

        // Edit Form Updating with Exception Handling
        try {
            $Mysqli->query(
                "UPDATE $StayTable
                SET city='{$_POST['city']}',
                    hotel = '{$_POST['id_hotel']}',
                    checkIn = '{$_POST['checkIn']}',
                    checkOut = '{$_POST['checkOut']}'
                WHERE email='{$_SESSION['email']}' && id={$_POST['stay']}");
            echo "Details Updated <br>";
        } catch (\Throwable $th) {
            echo "Some Error Occurred: {$th->getMessage()}";
        }
    }

    // Delete Confirmation
    if(isset($_POST['delete'])){
        echo "<br>Confirm <b>Delete</b>: <br>";

        // Listing Selected Row to confirm
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
            if($key=='checkIn' || $key=='checkOut'){
                echo "<td>".date('d-M-Y',strtotime($value))."</td>";
            }else{
                echo "<td>".$value."</td>";
            }
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
            echo "<br>Sorry!! No Hotel Check-In is in Database <br>Please Add Your Stay Using This <b><a href='../AppointHotel/index.php'>Link</a></b>";
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

            // Listing Table Data
            for($i=0;$i<$result->num_rows;$i++){
                echo "<tr>";
                foreach ($result->fetch_assoc() as $key => $value) {
                    if($key=="id"){
                        $id = $value;
                        continue;
                    }elseif($key=='email'){
                        continue;
                    }
                    if($key=='checkIn' || $key=='checkOut'){
                        echo "<td>".date('d-M-Y',strtotime($value))."</td>";
                    }else{
                        echo "<td>".$value."</td>";
                    }
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