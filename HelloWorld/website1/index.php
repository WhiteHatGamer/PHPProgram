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
        <?php
            if($enterFlag){
                print_r($_POST);
                echo "<br>";
                // Printing Entered Details
                echo "<h3>Details Entered: </h3>";
                echo "$name<br>";
                echo "$email<br>";
                echo "$website<br>";
                echo "$gender<br>";
                echo "$comment<br>";
                $genderEnum = $gender=='male'? 'm' : (($gender=='female')? 'f' : 'o');

                // Template Like in SQL
                $PrepareAddDetails = $Mysqli->prepare("INSERT INTO form(name,email,age,gender,website,comment) VALUES(?,?,?,?,?,?)");
                $PrepareAddDetails->bind_param("ssisss", $name, $email, $age, $genderEnum, $website, $comment);
                // try{
                    if($PrepareAddDetails->execute()==true){
                        $lastId = $Mysqli->insert_id;
                        echo "Details Stored In Database with id: $lastId<br>";
                    }else{
                        echo "Error Creating Table: ".$Mysqli->error;
                    }
                // }catch(exception $e){
                //     echo "Error Inserting Value=> {$e->getMessage()}";
                // }

                $table = $Mysqli->query("SELECT * from form LIMIT 15 ORDER BY id DESC");
                
                // Listing Every Row in the Database with Filtering as Table
                if($table->num_rows > 1){
                    ?>
                    <table border="1">
                        <tr>
                            <th>Sr.No</th>
                            <th>Name</th>
                            <th>Email</th>
                        </tr>
                    <?php
                    while($row = $table->fetch_assoc()){
                        echo "<tr>";
                        foreach($row as $key => $value){
                            if(!preg_match("/id|name|email/i", $key)){
                                continue;
                            }
                            echo "<td>$value</td>";
                        }
                        echo "</tr>";
                    }
                }else{
                    echo "0 Data in Database<br>";
                }

                // Delete Data Filtered
                if($Mysqli->query("DELETE FROM form WHERE age=56")==true){
                    echo "Data Deleted Where Age was wrong<br>";
                }

                // Update Data With Condition
                if($Mysqli->query(
                    "UPDATE form
                    SET email='7025250093'
                    WHERE id=4")){
                    echo "Database Updated<br>";
                }
            }
            // Included Var
            echo "<br>";
            echo "I have a $color $car<br>";

            // File Handling
            echo "<h3>File Handling</h3>";
            // Read Operation
            // echo readfile("webDict.txt");  // Returns the file contents of the file
            $fileH = fopen("webDict.txt", 'r') or die("Unable to Open File");
            // Printing the contents of the file each by line
            while(!feof($fileH)){
                echo fgets($fileH);
                echo "<br>";
            }
            // echo fread($fileH, filesize("webDict.txt")); // Read Complete File Upto size of the file stream
            fclose($fileH);

            // Write operation - w
            $fileH = fopen("webDict.txt",'w') or die("Unable to open File");
            $http = "HTTP - Hyper Text Transfer Protocol\n";
            fwrite($fileH, $http);
            fclose($fileH);

            // Append Mode - a
            $fileH = fopen("webDict.txt", 'a') or die("Unable to open File");
            $FTP = "FTP - File Transfer Protocol\n";
            fwrite($fileH, $FTP);
            fclose($fileH);

            // File uploading
            echo "File upload Form";
        ?>
        <form action="upload.php" method="post", enctype="multipart/form-data">
            Select Image:
            <input type="file" name="fileUpload" id="fileUpload">
            <button type="submit" name="fSubmit">Upload</button>
        </form>
        <h3>Cookies</h3>
        <h5><?php 

        if(isset($_COOKIE[$CookieName])){
            echo "Welcome Back: ".$_COOKIE[$CookieName]."<br>";
        }else{
            echo "Cookie Not Set<br>";
        }
        foreach($_SESSION as $key => $value){
            echo "$key => $value<br>";
        }

        // If we used session_destroy without session_unset data. The session data remains in the variable.
        session_unset();
        session_destroy();
        echo "<h3>Filter variables</h3>";
        ?></h5>
        <table border="3px">
            <tr>
                <th>Filter id</th>
                <th>Filter Name</th>
            </tr>
            <?php
                foreach(filter_list() as $id => $name){
                    echo "<tr><td>$id</td><td>$name</td></tr>";
                }
            ?>
        </table>
        <?php
            $ip = $_SERVER['REMOTE_ADDR'];
            if(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)){
                echo "IP Valid(IPV4)-> $ip<br>";
            }elseif(filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6)){
                echo "IP Valid(IPV6)-> $ip<br>";
            }else{
                echo "IP Not Valid<br>";
            }
            if(filter_var($age, FILTER_VALIDATE_INT, array("options"=>array("min_range"=>0,"max_range"=>110))) == true){
                echo "age is withing range: $age<br>";
            }else{
                echo "age Error: $age";
            }
            function filterStringLength($element){
                return strlen($element);
            }

            echo "<h3>Array Mapping</h3>";
            $fruitArray = ['Apple','Banana','Cocoa'];
            $fruits = array_map("filterStringLength", $fruitArray);
            print_r($fruitArray);
            echo "<br>Mapping String Lengths<br>";
            print_r($fruits);
            foreach($fruits as $key=>$value){
                $fruits[$fruitArray[$key]] = $fruits[$key];
                unset($fruits[$key]);
            }
            echo "<h3>JSON Encoding and Decoding</h3>";
            $jsonString = json_encode($fruits);
            echo $jsonString."<br>";

            echo "<br>";
            try{
                $jsonDecoded = json_decode($jsonString);
                if(gettype($jsonDecoded) == 'object'){
                    throw new Exception("Error Associative Not Considered", 1);
                }
            }catch(Exception $th){
                //echo "Exception Captured: $th<br>";
                $jsonDecoded = json_decode($jsonString,true);
                try {
                    // Passing Previous exception in the next new exception causes it to Print the stack trace of the Exception old to new
                    throw new Exception("Error Processing Request", 1,$th);
                } catch (Exception $ex) {
                    echo "<h3>Exception Handling</h3>";
                    echo "Exception Captured: <br>";
                    echo "&ensp;Message: ".$ex->getMessage()."<br>";
                    echo "&ensp;Previous: ".$ex->getPrevious()."<br>";
                    echo "&ensp;Code: ".$ex->getCode()."<br>";
                    echo "&ensp;File: ".$ex->getFile()."<br>";
                    echo "&ensp;Line: ".$ex->getLine()."<br>";
                }
            }finally{
                print_r($jsonDecoded);
            }
            ?>
        <br>
        <h3>Footer</h3>
<?php include "/src/PHPProgram/HelloWorld/website1/inc/footer.php"?>