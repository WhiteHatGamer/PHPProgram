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
    ?>

    <!-- Adding Name in Title -->
    <!DOCTYPE html>
    <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Update Note | <?php echo htmlspecialchars($_SESSION['name'])?></title>
        </head>
    </html>
    
    <?php

    // Checking if Submitted Already
    if(isset($_POST['submit'])){
        $Time = $_SESSION['TimeStamp'][$_POST['number']-1] ?? NULL;

        if($Time == NULL){
            echo "<h3>Invalid Note Number! Try Again</h3>";
        }else{
            $edit = $_POST['edit'];
            $result = $Mysqli->query(
                "UPDATE $NoteTable
                SET note='$edit'
                WHERE create_time='$Time'"
            );
            echo "Note Edited";
        }
    }

    // Getting Every Notes Saved from User
    $result = $Mysqli->query("SELECT * FROM $NoteTable WHERE email='".$_SESSION['email']."'");

    // Looping Through Result
    echo "<br><h5>Saved Notes:</h5><br>";
    echo "<table border='1px'>";
    echo "
    <tr>
        <th>ID No</th>
        <th>Modified Time</th>
        <th>Note</th>
    </tr>";
    foreach ($result->fetch_all() as $key) {
        echo "<tr>
            <td>".$key[3]."</td>
            <td>".date("d/M H:i",strtotime($key[0]))."</td>
            <td>".$key[2]."</td>
        </tr>";
    }
    echo "</table>";

?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <label for="number">ID No &ensp;&ensp;&ensp;: </label>
    <input type="number" name="number" required autofocus autocomplete="off"><br>
    <label for="edit">Edited Note:</label>
    <input type="text" name="edit"><br>
    <button type="submit" name="submit">Edit</button>
</form>
<?php

    // Return To Dashboard
    echo "<br>Goto ";
    echo "<a href='../index.php'>Dashboard</a>";
?>