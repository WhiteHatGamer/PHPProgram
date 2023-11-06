<?php
    // Starting Session
    session_start();
    $CookieName = $_SERVER['REMOTE_ADDR'];
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="Assets/favicon.ico" type="image/x-icon"/>
        <title>Home | Travel Planner</title>
    </head>
    <body>
        <?php
            // Greeting User if Cookie Found
            //print_r($_COOKIE[$CookieName]);
            if(isset($_COOKIE[$CookieName])){
                echo "Welcome Back, ".$_COOKIE[$CookieName]."<br><br>";
            }
            include "inc/header.php";
        ?>
        <h3>Home</h3>
        <a href="Register/index.php">Register</a>
        <br>
        <a href="Login/index.php">LogIn</a>
        <?php include "inc/footer.php";?>
    </body>
</html>