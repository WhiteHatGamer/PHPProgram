<?php

    // Adding MySQL Connection
    require "../var.php";

    $CookieName = $_SERVER['REMOTE_ADDR'];
    
    // Starting Session
    session_start();
    
    if(isset($_POST['logout'])){
        session_unset();
        session_destroy();
        header("Location: ../index.php");
        exit;
    }
    
    // Checking If User is Logged In
    if(!isset($_SESSION['email'])){
        echo "<h3>You Are Logged out Please Login Again!!!</h3><br>";
        echo '<a href="../index.php">Home</a><br>';
        exit;
    }

    // Get Name from db
    $result = $Mysqli->query("SELECT name FROM user WHERE email='".$_SESSION['email']."'");
    $name = $result->fetch_row()[0];
    if(isset($name)){
        $_SESSION['name'] = $name;
    }
    $CookieValue = (isset($_SESSION['name']))? $_SESSION['name']:$_SESSION['email'];

    // Setting Cookie
    @setcookie($CookieName, $CookieValue, time() + (86400*30),'/');
?>

<!-- Adding Name in Title -->
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard | <?php echo htmlspecialchars($_SESSION['name'])?></title>
    </head>
</html>

<?php
    include __DIR__."/../inc/header.php";
    echo "<h3>Hello ".@$_SESSION['name']."</h1>";
?>
<div id="tabs">
    <button onclick="travel.hidden=false, stay.hidden=true, note.hidden = true">Travel Plan</button>
    <button onclick="travel.hidden=true, stay.hidden=false, note.hidden = true">Hotel Stay</button>
    <button onclick="travel.hidden=true, stay.hidden=true, note.hidden = false">Travel Note</button>

</div>
<!-- Travel Plan -->
<div id="travel" hidden>
    <a href="PlanTrip/index.php">Plan Travel</a><br>
    <a href="ShowTrips/index.php">Show Trips</a><br>
    <a href="EditTrip/index.php">Edit Trip</a><br>
</div>

<!-- Stay Plan -->
<div id="stay" hidden>
    <a href="AppointHotel/index.php">Appoint Hotel</a><br>
    <a href="ListStays/index.php">List Stays</a><br>
</div>

<!-- Note Operations -->
<div id="note" hidden>
    <!-- Add Note -->
    <a href="CreateNote/index.php">Create Note</a><br>

    <!-- List Note -->
    <a href="ReadNote/index.php">Read Notes</a><br>

    <!-- Update Note -->
    <a href="UpdateNote/index.php">Update Notes</a><br>

    <!-- Delete Note -->
    <a href="DeleteNote/index.php">Delete Note</a><br>
</div>
<br>
<!-- Log out -->
<form action="EditProfile/index.php" method="post">
    <button type="submit">Edit Profile</button>
</form>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <button name="logout" type="submit">Log Out</button>
</form>