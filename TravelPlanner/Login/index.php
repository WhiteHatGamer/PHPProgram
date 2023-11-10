<?php
    session_start();

    // Checking If User is Logged In
    if(isset($_SESSION['email'])){
        sleep(1);
        header('Location: ../Dashboard/index.php');
    }

    if(isset($_POST['submit'])){

        // Including Env Variables with Credentials
        require "../var.php";

        // Check if User Exists
        try {

            // Exception Handling of mysql Authentication Request to Hide any Password Errors
            $result = $Mysqli->query("SELECT * FROM $UserTable WHERE email='".htmlspecialchars($_POST['email'])."' && password=md5('".htmlspecialchars($_POST['password'])."')");
        } catch (\Throwable $th) {

            // Error Catches
            echo "<h3>Error 500</h3><br>Server Error";
            exit;
        }
        if($result->num_rows > 0){
            
            // Authentication Successful
            header("Location: ../Dashboard/index.php");
            echo "<h3> Login Success</h3>";
            echo "Click the link to go to Dashboard.";
            for($i=0;$i<2;$i++){
                echo ".";
                sleep(1);
            }
            echo "<br>";

            // Starting Session
            @session_start(); // Already Started Session.
            $_SESSION['email'] = htmlspecialchars($_POST['email']);
            echo('<a href="../Dashboard/index.php">Dashboard</a>');
            exit;
        }else{

            // Authentication Not Successful
            echo "<h3> Login Failed</h3><br>";
            echo "Retry Again...<br>";
        }
    }elseif(isset($_POST['login'])){
        
        // Including Env Variables with Credentials
        require "../var.php";

        // Check if User Exists
        try {
 
            // Exception Handling of mysql Authentication Request to Hide any Password Errors
            $result = $Mysqli->query("SELECT * FROM $UserTable WHERE email='abc@example.com' && password=md5('abc')");
        } catch (\Throwable $th) {
 
            // Error Catches
            echo "<h3>Error 500</h3><br>Server Error";
            exit;
        }
        if($result->num_rows > 0){
             
            // Authentication Successful
            //header("Location: ../CreateNote/index.php");
            echo "<h3> Login Success</h3>";
            echo "Click the link to go to Dashboard...";
            sleep(1);
            echo "<br>";

            // Starting Session
            @session_start(); // Already Started Session.
            $_SESSION['email'] = 'abc@example.com';
            echo('<a href="../Dashboard/index.php">Dashboard</a>');
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | Travel Planner</title>
    </head>
    <body>
        <header><a href="/TravelPlanner/index.php">Travel Planner</a></header>
        <h1>Login</h1><br>
        <h3>Enter User Details:</h3>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for='email'>Your Email:</label>
            <input name='email' id='email' type="email" autofocus required>
            <br>
            <label for='password'>Password:</label>
            <input name='password' id='password' type='password' required>
            <br>
            <button type="submit" name="submit">Submit</button>
        </form>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <button type="login" name="login">Test Log-in</button>
        </form>
    </body>
</html>