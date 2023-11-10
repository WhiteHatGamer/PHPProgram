<?php
    // Starting Session
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
        <title>Add Note | <?php echo htmlspecialchars($_SESSION['name'])?></title>
    </head>
    <body>
        <?php include __DIR__."/../inc/header.php";?>
        <h1>Add Note</h1>
        <h3>Enter Details:</h3>
        <form action="action.php" method="post">
            <label for='note'>Your Note:&emsp;&nbsp;</label>
            <input name='note' id='note' type="text" autofocus required>
            <br>
            <button type="submit">Submit</button>
        </form>
        <br>
        Goto 
        <a href='../index.php'>Dashboard</a>
    </body>
</html>