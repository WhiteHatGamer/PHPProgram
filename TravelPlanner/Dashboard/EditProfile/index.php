<?php
    // Adding SQL Connection
    require __DIR__."/../../var.php";

    // Starting Session
    session_start();

    // Checking If User is Logged In
    if(!isset($_SESSION['email'])){
        echo "<h3>You Are Logged out Please Login Again!!!</h3><br>";
        echo '<a href="../../index.php">Home</a><br>';
        exit;
    }

    // Execute Query
    function QueryExecuteUpdate($column, $value){
        require __DIR__."/../../var.php";

        $QueryUpdate = "UPDATE user SET var1 = var2 WHERE email='".$_SESSION['email']."'";
        $VarReference = array(&$column, &$value);
        $updateVar = ["var1", "var2"];
        $QueryStr = str_replace($updateVar, $VarReference, $QueryUpdate);
        $result = $Mysqli->query($QueryStr);

        return $result;
    }

    // Execute Query
    function QueryExecuteSelect($column){
        require __DIR__."/../../var.php";

        $QuerySelect = "SELECT var1 FROM user WHERE email='".$_SESSION['email']."'";
        $QueryStr = str_replace("var1", $column, $QuerySelect);
        $result = $Mysqli->query($QueryStr);

        return $result->fetch_row()[0];
    }

    // Loading Data From Database
    $Picture = QueryExecuteSelect("image");
    $Prefix = QueryExecuteSelect("prefix");
    $Name = QueryExecuteSelect("name");
    $Number = QueryExecuteSelect("number");
    $Gender = QueryExecuteSelect("gender");
    $DOB = QueryExecuteSelect("dob");
    
    // Updating Image
    if(isset($_POST['profEdit'])){
        
        // Setting Format String and Initialization
        $column = $value = '';
        $VarReference = array(&$column, &$value);
        
        if(!$_FILES['image']['error']){
            // Saving File into Database
            $source = $_FILES['image']['tmp_name'];

            // Changing Path Separator
            $source = str_replace("\\", "/",$source);
            
            QueryExecuteUpdate("image", "LOAD_FILE('$source')");
            $Picture = QueryExecuteSelect("image");
        }
        if($_POST['prefix']){
            // Executing Update and Fetch
            QueryExecuteUpdate("prefix", "'{$_POST['prefix']}'");
            $Prefix = QueryExecuteSelect("prefix");
        }
        if($_POST['name']){
            // Executing Update and Fetch
            QueryExecuteUpdate("name", "'{$_POST['name']}'");
            $Name = QueryExecuteSelect("name");
        }
        if($_POST['number']){
            // Executing Update and Fetch
            $value = str_replace(' ','',$_POST['number']);
            QueryExecuteUpdate("number", "'$value'");
            $Number = QueryExecuteSelect("number");
        }
        if($_POST['gender']){
            // Executing Update and Fetch
            QueryExecuteUpdate("gender", "'{$_POST['gender']}'");
            $Gender = QueryExecuteSelect("gender");
        }
        if($_POST['dob']){
            // Executing Update and Fetch
            QueryExecuteUpdate("dob", "'{$_POST['dob']}'");
            $DOB = QueryExecuteSelect("dob");
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Profile | <?php echo @$_SESSION['name'] ;?></title>
    </head>
    <style>
        img[src=""] {
            display: none;
            }
    </style>
    <body>
        <?php include __DIR__."/../inc/header.php"?>
        <h2>Edit Profile</h2>
        <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
            <label for="image">Picture: </label>
            <input name="image" type="file">
            <img src="<?php if($Picture){ echo ("data:image/jpeg;base64, ".base64_encode($Picture));}?>" width="40px" height="40px"/>
            <br>
            <label for="prefix">Prefix: </label>
            <select name="prefix">
                <option value="">--Select--</option>
                <option value="Mr." <?php if($Prefix && $Prefix=="Mr.") echo "selected"; ?>>Mr.</option>
                <option value="Ms." <?php if($Prefix && $Prefix=="Ms.") echo "selected"; ?>>Ms.</option>
                <option value="Mrs." <?php if($Prefix && $Prefix=="Mrs.") echo "selected"; ?>>Mrs.</option>
                <option value="Dr." <?php if($Prefix && $Prefix=="Dr.") echo "selected"; ?>>Dr.</option>
                <option value="Adv." <?php if($Prefix && $Prefix=="Adv.") echo "selected"; ?>>Adv.</option>
            </select><br>
            <label for="name">Name: </label>
            <input type="text" name="name" value="<?php echo $Name; ?>"><br>
            <label for="email">Email: </label>
            <input type="text" name="email" value="<?php echo $_SESSION['email']; ?>" disabled><br>
            <label for="number">Number: </label>
            <input name="number" type="tel" value="<?php echo $Number; ?>"><br>
            Gender: 
            <input type="radio" name="gender" value="m"  <?php if(isset($Gender) && $Gender=="m"){echo "checked";}; ?>>Male
            <input type="radio" name="gender" value="f" <?php if(isset($Gender) && $Gender=="f"){echo "checked";}; ?>>Female
            <input type="radio" name="gender" value="o" <?php if(isset($Gender) && $Gender=="o"){echo "checked";}; ?>>Other
            <br>
            <label for="dob">Date of Birth: </label>

            <!-- Date Client Validation Min-100yrs max-tdy  -->
            <input name="dob" type="date" value="<?php echo $DOB; ?>" min="<?php echo date("Y-m-d", time()-(86400*36500)) ?>" max="<?php echo date("Y-m-d") ?>"><br>
            <button type="submit" name="profEdit">Save</button>
        </form>
        <br>
        <a href="Password.php"><button type="button">Edit Password</button></a>
    </body>
</html>
