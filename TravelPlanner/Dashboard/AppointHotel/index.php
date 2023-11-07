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

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotels | <?=@$_SESSION['name']?></title>
    </head>
    <body>
        <?php
            include "../inc/header.php"
        ?>
        <h3>Hotel Stay</h3>

        <!-- Form Start -->
        <form method="post" name="stay" action=<?=$_SERVER['PHP_SELF']?>>
            <input type="text" name="city" id="city" placeholder="Type City" required list="id_list" onkeyup="getCity(this.value)" onblur="getHotels(this.value)" autocomplete="off">
            <datalist id="id_list">
                <div id="id_city">
                    <!-- To be filled onKeyUp type -->

                </div>
            </datalist>

            <!-- Select List Based on Selected City -->
            <select id="id_hotel" name="id_hotel" onchange=getExpense(this.value)>
                <option value="">--Select-Hotel--</option>
            </select>
            <output name="HotelExpense" id="HotelExpense"></output>
            <br>
            <br>
            
            <!-- <label for="checkIn">Check In: </label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <label for="checkOut">Check Out: </label> -->
            <!-- Date with Limit using PHP -->
            <input style="width: 130px;" type="text" name="checkIn" placeholder="Check In" onfocus="(this.type='date')" id="checkIn" required min="<?php echo date('Y-m-d');?>">
            <input style="width: 130px;" type="text" name="checkOut" placeholder="Check Out" onfocus="(this.type='date')" id="checkOut" onchange="calculateExpense(this.value)" required min="<?php echo date('Y-m-d');?>"><br>
            <select id="night" name="night" onchange="calculateDate(this.value)">
                <?php for ($i=1; $i < 31; $i++) { 
                    echo "<option value='$i'>$i Night(s)</option>";
                } ?>
                <option value="31">30+ Night(s)</option>
            </select><br><br>
            <button type="submit" name="stay">Save</button>
        </form>
    </body>
</html>