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
        <span class="error"><p>* Required Field</p></span>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" name="submit" method="post">
            <label for="prefix">Prefix: </label>
            <select name="prefix">
                <option value="Mr.">Mr.</option>
                <option value="Ms.">Ms.</option>
                <option value="Mrs.">Mrs.</option>
                <option value="Dr.">Dr.</option>
                <option value="Adv.">Adv.</option>
            </select><br>
            <label for="name">Name: </label>
            <input type="text" name="name" value="<?php echo $name; ?>" autofocus><span class="error">*<?php echo $nameErr; ?></span><br>
            <label for="email">Email: </label>
            <input type="text" name="email" value="<?php echo $email; ?>"><span class="error">*<?php echo $emailErr; ?></span><br>
            <label for="website">Website: </label>
            <input type="text" name="website"  value="<?php echo $website; ?>"><span class="error"><?php echo $websiteErr; ?></span><br>
            Gender: 
            <input type="radio" name="gender" value="male"  <?php if(isset($gender) && $gender=="male"){echo "checked";}; ?>>Male
            <input type="radio" name="gender" value="female" <?php if(isset($gender) && $gender=="female"){echo "checked";}; ?>>Female
            <input type="radio" name="gender" value="Other" <?php if(isset($gender) && $gender=="other"){echo "checked";}; ?>>Other
            <span class="error">*<?php echo $genderErr; ?></span>
            <br>
            <label for="age">Age(0-110): </label>
            <input type="range" min="1" max="110" name='age' id='age' onchange="ageV.value=this.value">
            <input type="number" name="ageV" id="ageV" max="110" onchange="age.value=this.value"></output><br>
            <label for="comment">Comment</label>
            <textarea name="comment" rows="5" cols="40"><?php echo $comment; ?></textarea><br>
            <button type="submit">Submit</button>
        </form>
<?php include "/src/PHPProgram/HelloWorld/website1/inc/footer.php"?>