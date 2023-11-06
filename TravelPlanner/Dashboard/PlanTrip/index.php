<?php
    require "../../var.php";

    session_start();

    // Checking If User is Logged In
    if(!isset($_SESSION['email'])){
        echo "<h3>You Are Logged out Please Login Again!!!</h3><br>";
        echo '<a href="../../index.php">Home</a><br>';
        exit;
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plan Trip | Travel Planner</title>
</head>
<body>
    <?php
    include "../inc/header.php"
    ?>
    <h3>Plan Journey</h3>

    <!-- Conditional Radio Buttons -->
    <input type="radio" name="trip" onclick="round.disabled = true" checked value="one_way">One Way
    <input type="radio" name="trip" onclick="round.disabled = false" value="round_trip">Round Trip<br><br>

    <!-- Form Start -->
    <form method="post" name="plan" action=<?=$_SERVER['PHP_SELF']?>>
        <input type="text" name="source" id="source" placeholder="Type Source City" required list="id_list" onkeyup="getCity(this.value)" autocomplete="off">
        <input type="text" name="destination" id="destination" placeholder="Type Destination City" required list="id_list" onkeyup="getCity(this.value)" autocomplete="off">
        <datalist id="id_list">
            <div id="id_city">

                <!-- To be filled onKeyUp type -->
            </div>
        </datalist>
        <select name="way" onchange=CalculateTime(this.value)>
            <option value="">--select-Transport--</option>
            <option value="airplane">Airplane</option>
            <option value="train">Train</option>
            <option value="car">Car</option>
            <option value="bus">Bus</option>
            <option value="cycle">Cycling</option>
            <option value="walk">Walk</option>
        </select>
        <output name="tripTime" id="tripTime"></output>
        <br><br>
        <label for="journey">Journey Date: </label>

        <!-- Date with Limit using PHP -->
        <input type="datetime-local" name="journey" id="journey" required min="<?php echo date('Y-m-d')."T".date("H:i");?>">
        <label for="round">Return Date: </label>
        <input type="datetime-local" name="round" id="round" disabled required min="<?php echo date('Y-m-d')."T".date("H:i");?>"><br><br>
        <button type="submit" name="plan">Save</button>
    </form>
</body>
</html>