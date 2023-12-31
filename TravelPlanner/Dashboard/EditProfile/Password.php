<?php

    include __DIR__."/../inc/header.php";

    // Adding Connection to Database
    require "../../var.php";

    // Start session
    session_start();

    // Checking If User is Logged In
    if(!isset($_SESSION['email'])){
        echo "<h3>You Are Logged out Please Login Again!!!</h3><br>";
        echo '<a href="../../index.php">Home</a><br>';
        exit;
    }

    // Checking If Submitted
    if(isset($_POST['change'])){
        $changeFlag = false;

        try {
            // Checking if User's Old Password is Same
            $result = $Mysqli->query("SELECT EXISTS(SELECT * FROM user WHERE email='{$_SESSION['email']}' && password=md5('{$_POST['OldPassword']}'))");
            if($result->fetch_row()[0]){
                // if Same Update Password
                $Mysqli->query(
                    "UPDATE $UserTable
                    SET password=md5('{$_POST['NewPassword']}')
                    WHERE email='{$_SESSION['email']}' && password=md5('{$_POST['OldPassword']}')"
                );
                $changeFlag = true;
            }else{
                echo "<br>You Old Password is Incorrect Please Try Again!!!<br>";
            }
        } catch (Exception $e) {

            // Catches Exception
            echo "<h3>ERROR Try Again! : {$e->getMessage()}</h3><br>";
        }
        
        if($changeFlag){
            // Logging Out After Changing Password
            echo "<h3>Your Password is Changed. Please Login Again!</h3><br>";
            echo '<a href="../../index.php">Home</a><br>';
            
            // Clearing sessions
            session_unset();
            session_destroy();
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
</head>
<body>
    <h3>Change Password</h3>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
        <label for="OldPassword">Old Password: </label>
        <input type="password" name="OldPassword" required><br>
        <label for="NewPassword">New Password: </label>
        <input type="password" name="NewPassword" required><br>
        <button name="change" type="submit">Change Password</button>
    </form>
</body>
</html>