<?php

    // Adding MySQL Connection
    require "../../var.php";
    
    // Starting Session
    session_start();

    // Checking If User is Logged In
    if(!isset($_SESSION['email'])){
        echo "<h3>You Are Logged out Please Login Again!!!</h3><br>";
        echo '<a href="../index.php">Home</a><br>';
        exit;
    }
    <?php
    // Checking if Submitted Already
    if(isset($_POST['submit'])){
        $Time = $_SESSION['TimeStamp'][$_POST['number']-1] ?? NULL;

        if($Time == NULL){
            echo "<h3>Invalid Note Number! Try Again</h3>";
        }else{
            $result = $Mysqli->query(
                "DELETE FROM $NoteTable
                WHERE create_time='$Time'"
            );
            echo "Note Deleted";
            unset($_SESSION['timestamp'][$_POST['number']-1]);
        }
    }

    // Getting Every Notes Saved from User
    $result = $Mysqli->query("SELECT * FROM $NoteTable WHERE email='".$_SESSION['email']."'");

    // Looping Through Result
    echo "<br><h5>Saved Notes:</h5><br>";
    $count =1;
    foreach ($result->fetch_all() as $key) {
        echo "$count - &emsp;";
        echo $key[2];
        echo "<br>";
        $_SESSION['TimeStamp'][$count-1] = $key[0];
        $count++;
    }

?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <label for="number">Sr. No &ensp;&ensp;&ensp;: </label>
    <input type="number" name="number" required autofocus><br>
    <button type="submit" name="submit">Delete</button>
</form>
<?php

    // Return To Dashboard
    echo "<br>Goto ";
    echo "<a href='../index.php'>Dashboard</a>";
?>