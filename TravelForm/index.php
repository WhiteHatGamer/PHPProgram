<?php
    session_start();
    $CookieName = $_SERVER['REMOTE_ADDR'];
    $CookieValue = '';
    
    
    // Checking If User is Logged In
    if(isset($_SESSION['email'])){
        $CookieValue = $_SESSION['name'];
        sleep(1);
        //header('Location: Dashboard/index.php');
    }
    setcookie($CookieName, $CookieValue, time() + (86400*30),'/');
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="icon" href="Assets/favicon.ico" type="image/x-icon"/>
        <title>Home | Travel Notes</title>
    </head>
    <body>
    <?php
        if(isset($_COOKIE[$CookieName])){
            echo "Welcome Back ".$_COOKIE[$CookieName];
        }else{
            echo "Cookie is not Set";
            print_r($_COOKIE);
        }
    ?>
        <?php include "inc/header.php";?>
        <h3>Home</h3>
        <a href="Register/index.php">Register</a>
        <br>
        <a href="Login/index.php">LogIn</a>
        <?php include "inc/footer.php";?>
    </body>
</html>
