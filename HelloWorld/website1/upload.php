<?php
    // specifies upload directory
    $targetDir = "Uploads/";
    if(isset($_POST['fSubmit'])){
        // specifies File Upload Path - $_FILES contains the file uploaded in the form
        $targetFile = $targetDir.basename($_FILES['fileUpload']['name']);
        $uploadFlag = 1;
        // Checking image Type using extension
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $check = true;
        $imageType = getimagesize($_FILES['fileUpload']['tmp_name']);
        if(!$imageType){
            echo "File is Not an Image<br>";
            $check = false;
        }elseif($_FILES['fileUpload']['size']>500000){
            echo "Sorry: File size is too Large<br>";
            $check = false;
        }elseif(file_exists($targetFile)){
            echo "Sorry: File already Exists<br>";
            $check = false;
        }
        if($check != false){
            echo "File is an image - ".$imageType['mime'].".";
            $uploadFlag = 1;
        }else{
            $uploadFlag = 0;
        }
        if($uploadFlag){
            if(move_uploaded_file($_FILES['fileUpload']['tmp_name'], $targetFile)){
                echo "File Uploaded<br>";
            }
        }else{
            echo "File Not Uploaded<br>";
        }
        echo 'Go back to <a href="index.php">Home</a>';
    }
?>