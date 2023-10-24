
    // Checking If User is Logged In
    if(!isset($_SESSION['email'])){
        echo "<h3>You Are Logged out Please Login Again!!!</h3><br>";
        echo '<a href="../index.php">Home</a><br>';
        exit;
    }
<?php

    // Return To Dashboard
    echo "<br>Goto ";
    echo "<a href='../index.php'>Dashboard</a>";
?>