<?php
    // Starting Session
    session_start();

    echo "<h3>Header</h3>";
    // 'require' instead of 'include' makes it wont print anything else without that content
    include __DIR__."/inc/header.php";
    require_once __DIR__."/../vars.php";

    // Setting Cookies
    $CookieName = $_SERVER['REMOTE_ADDR'];
    $CookieValue = '';

    setcookie($CookieName, $CookieValue, time()+(86400*30),'/');
?>
    <h1>Home</h1>
    <style>
    .error {color: #FF0000;}
    </style>
    <body>
        <h3>FORM With Validation</h3>
        <?php
            // MYSQLi Connections:
            try{
                $Mysqli->query("CREATE DATABASE test");
            }catch(Exception $th){
                echo "Error Creating Database=> {$th->getMessage()}<br>";
            }
            if($Mysqli->select_db($Database)==true){
                echo "Database Changed to $Database<br>";
            }

            // Creating Form Table:
            try{
                $QueryCreateTable = "CREATE TABLE form(
                    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
                    name VARCHAR(25) NOT NULL,
                    email VARCHAR(255) NOT NULL,
                    age INT(3) UNSIGNED ,
                    gender enum('m','f'),
                    website VARCHAR(255),
                    comment VARCHAR(1000),
                    time_stamp TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
                    )";
                if($Mysqli->query($QueryCreateTable)){
                    echo "Table Created<br>";
                }
            }catch(Exception $e){
                echo "Error Creating Table=> {$e->getMessage()}<br>";
            }
<?php include "/src/PHPProgram/HelloWorld/website1/inc/footer.php"?>