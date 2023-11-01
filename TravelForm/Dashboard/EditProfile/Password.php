<?php

    // Adding Connection to Database
    require "../var.php";

    // Start session
    session_start();

    // Checking If User is Logged In
    if(!isset($_SESSION['email'])){
        echo "<h3>You Are Logged out Please Login Again!!!</h3><br>";
        echo '<a href="../index.php">Home</a><br>';
        exit;
    }

    if(isset($_POST['change'])){
        $changeFlag = false;

        try {
            $Mysqli->query(
                "UPDATE $UserTable
                SET password='{$_POST['NewPassword']}'
                WHERE email='{$_SESSION['email']}' && password='{$_POST['OldPassword']}'"
            );
            $changeFlag = true;
        } catch (\Throwable $th) {
            echo "<h3>Your old Password is Incorrect. Please Try Again!</h3><br>";
        }
        
        if($changeFlag){
            echo "<h3>Your Password is Changed. Please Login Again!</h3><br>";
            echo '<a href="../index.php">Home</a><br>';
            session_destroy();
            exit;
        }
    }
?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
    <label for="OldPassword">Old Password: </label>
    <input type="password" name="OldPassword"><br>
    <label for="NewPassword">New Password: </label>
    <input type="password" name="NewPassword"><br>
    <button name="change" type="submit">Change Password</button>
</form>