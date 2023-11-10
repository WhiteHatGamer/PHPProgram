<?php
    // Start Session iff
    if(!session_status()){
        @session_start();
    }

    // Check if Clicked Submitted LogOut Form
    if(isset($_POST['logout'])){
        session_destroy();
        session_unset();
        header("Location: ../../index.php");
        exit;
    }
?>
<header>
    <div style="width: 96px; padding: .5px; height: 20px; border: 2px solid blue;">
        <a href="/TravelPlanner/index.php">Travel Planner</a>
        <form style="position:absolute; right: 0;" action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
            <button name="logout" type="submit">Log Out</button>
        </form>
    </div>
</header>