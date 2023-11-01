<?php

    // Including Env Variables with Credentials
    require "../var.php";

    // Checking if Connection Success
    if($Mysqli->host_info==NULL){
        throw new Exception("Error Processing Request", 1);
    }

    // Checking if User Already Exists
    $result = $Mysqli->query("SELECT * FROM user WHERE email='".htmlspecialchars($_POST['email'])."'");
    echo "<br>";
    if($result->num_rows>0){

        // User already Exists
        echo "<h3>User Not Added</h3>";
        echo "User Already Exist goto Login Page<br>";
        echo '<a href="../Login/index.php">Login Page</a><br>';
    }else{
        
        // User Don't Exist. Adding User
        $result = $Mysqli->query(
            "INSERT INTO $UserTable(`email`, `password`) values('".htmlspecialchars($_POST['email'])."',md5('".htmlspecialchars($_POST['password'])."'))"
        );
        echo "<h3>User Added</h3>";
        echo "Go to Login Page for Adding Your First Note";
        echo '<br><a href="../Login/index.php">Login Page</a>';
    }
?>