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
            // FORM Validation
            $enterFlag = true;
            $nameErr = $emailErr = $websiteErr = $genderErr = "";
            $name = $email = $comment = $website = $gender = "";
            $age = null;
            $urlProtocolPattern = '/https|ftp|http|smtp|tcp/i';
            // Checking if entered Details
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                if(empty($_POST['name'])){
                    $nameErr = "Name is Required";
                    $enterFlag = false;
                    
                }else{
                    $nameBuffer = htmlspecialchars($_POST['name']);
                    // Checking if name is of Correct Format
                    if(preg_match("/^[a-zA-Z-' ]*$/", $nameBuffer)){
                        $name = $nameBuffer;
                        $_SESSION['name'] = $name;
                        $CookieValue = @str_replace(" ", "_", $name);//$name;
                        setrawcookie($CookieName,$CookieValue, time()+(86400),'/');
                    }else{
                        $nameErr = "Only Letters, WhiteSpaces, apostrophe and dash is allowed";
                    }
                }
                if(empty($_POST['email'])){
                    $enterFlag = false;
                    $emailErr = "Email is Required";
                }else{
                    $emailBuffer = htmlspecialchars($_POST['email']);
                    // Validating Email Format
                    if(filter_var($emailBuffer, FILTER_VALIDATE_EMAIL)){
                        $email = $emailBuffer;
                        $_SESSION['email'] = $email;
                    }else{
                        $emailErr = "Enter Valid Email";
                    }
                }
                if(!empty($_POST['comment'])){
                    $comment = htmlspecialchars($_POST['comment']);
                }
                if(!empty($_POST['website'])){
                    $websiteBuffer = htmlspecialchars($_POST['website']);
                    // Website Pattern Checking
                    if(preg_match($urlProtocolPattern,$websiteBuffer)){
                        if(filter_var($websiteBuffer,FILTER_VALIDATE_URL)){
                            $website = $websiteBuffer;
                            $websiteErr = '';
                        }else{
                            $websiteErr = $websiteBuffer.' is Not a Valid URL';
                        }
                    }else{
                        $websiteErr = 'Please Specific protocol Details eg: http:// , https://, etc.';
                    }
                }
                if(empty($_POST['gender'])){
                    $genderErr = "Gender is Required";
                    $enterFlag = false;
                }else{
                    $gender =htmlspecialchars($_POST['gender']);
                    $_SESSION['gender'] = $gender;
                }
                if(!empty($_POST['age'])){
                    $age = htmlspecialchars($_POST['age']);
                }
            }else{
                $enterFlag = false;
            }
        ?>
<?php include "/src/PHPProgram/HelloWorld/website1/inc/footer.php"?>