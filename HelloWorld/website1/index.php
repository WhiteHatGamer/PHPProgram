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
<?php include "/src/PHPProgram/HelloWorld/website1/inc/footer.php"?>