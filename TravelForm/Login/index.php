<?php
    if(isset($_POST['submit'])){

        // Including Env Variables with Credentials
        require "../var.php";

        // Check if User Exists
        try {

            // Exception Handling of mysql Authentication Request to Hide any Password Errors
            $result = $Mysqli->query("SELECT * FROM $UserTable WHERE email='".htmlspecialchars($_POST['email'])."' && password='".htmlspecialchars($_POST['password'])."'");
        } catch (\Throwable $th) {

            // Error Catches
            echo "<h3>Error 500</h3><br>Server Error";
            exit;
        }
        if($result->num_rows > 0){

            // Authentication Successful
            //header("Location: ../AddNote/index.php");
            echo "<h3> Login Success</h3>";
            echo "Click the link to go to Dashboard.";
            for($i=0;$i<2;$i++){
                echo ".";
                sleep(1);
            }
            echo "<br>";

            // Starting Session
            session_start();
            $_SESSION['email'] = htmlspecialchars($_POST['email']);
            echo('<a href="../Dashboard/index.php">Dashboard</a>');
            exit;
        }else{

            // Authentication Not Successful
            echo "<h3> Login Failed</h3><br>";
            echo "Retry Again...<br>";
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login | Travel Notes</title>
    </head>
    <body>
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
    </body>
</html>