<?php
    // Adding SQL Connection
    require __DIR__."/../../var.php";

    // Starting Session
    session_start();
    
    include "../inc/header.php";

    // Checking If User is Logged In
    if(!isset($_SESSION['email'])){
        echo "<h3>You Are Logged out Please Login Again!!!</h3><br>";
        echo '<a href="../../index.php">Home</a><br>';
        exit;
    }

    if(isset($_POST['stay'])){

        // Null Validation
        if(!(@$_POST['city'])){
            exit;
        }
        if(!(@$_POST['id_hotel'])){
            exit;
        }
        if(!(@$_POST['checkIn'])){
            exit;
        }
        if(!(@$_POST['checkOut'])){
            exit;
        }

        // storing data into Variables
        $city = $_POST['city'];
        $hotel = $_POST['id_hotel'];
        $checkIn = $_POST['checkIn'];
        $checkOut = $_POST['checkOut'];

        try {

            // Insertion Query
            $Mysqli->query("INSERT INTO $StayTable(email,city,hotel,checkIn,checkOut)
            VALUES('{$_SESSION['email']}', '$city', '$hotel', '$checkIn', '$checkOut')");
            echo "<h3>Data Saved</h3>";
        } catch (\Throwable $th) {

            // Catches Exception
            echo "Error Occurred: {$th->getMessage()}<br>";
            exit;
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Hotels | <?=@$_SESSION['name']?></title>
        <script>
            async:false;
            function getCity(str){
                // Function to suggest City
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById("id_city").innerHTML = this.responseText;
                    }
                }
                xmlHttp.open("GET", "../getHint.php?q=searchCity&s="+str, true);
                xmlHttp.send();
            }

            function getHotels(str){
                // Function to get City Hotels
                var xmlHttp = new XMLHttpRequest();
                xmlHttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        const list = document.getElementById("id_hotel");
                        list.innerHTML = this.response;
                    }
                }
                xmlHttp.open("GET", "../getHint.php?q=getHotel&s="+str, true);
                xmlHttp.send();
            }

            function getExpense(hotel){
                // Function to get Expense of Hotel Selected
                var xmlHttp = new XMLHttpRequest();
                cityName = document.getElementById('city').value;
                night = document.getElementById('night').value;
                xmlHttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById("HotelExpense").value = this.responseText;
                    }
                }
                xmlHttp.open("GET", "../getHint.php?q=getExpense&h="+hotel+"&c="+cityName+"&n="+night, true);
                xmlHttp.send();
            }

            function calculateExpense(checkOut){
                // Function to Calculate Expense Based on Days
                var xmlHttp = new XMLHttpRequest();
                checkIn  = document.getElementById('checkIn').value;
                hotel  = document.getElementById('id_hotel').value;
                cityName  = document.getElementById('city').value;

                // Check if checkOut is After CheckIn
                if(new Date(checkIn).getTime() > new Date(checkOut).getTime()){
                    document.getElementById("HotelExpense").value = "Please Select Check Out Date After Check In";
                    document.getElementById('checkOut').value = document.getElementById('checkIn').value;
                    document.getElementById("night").value = 1;
                    return;
                };

                xmlHttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById("HotelExpense").value = this.response;
                    }
                }
                xmlHttp.open("GET", "../getHint.php?q=calculateExpense&o="+checkOut+"&i="+checkIn+"&h="+hotel+"&c="+cityName, true);
                xmlHttp.send();
                
                // Calculate Night
                var xmlHttp = new XMLHttpRequest();
                checkIn  = document.getElementById('checkIn').value;
                xmlHttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        document.getElementById("night").value = this.response;
                    }
                }
                xmlHttp.open("GET", "../getHint.php?q=calculateNight&o="+checkOut+"&i="+checkIn, true);
                xmlHttp.send();

            }
            
            function calculateDate(night){
                // Function to calculate Date after selecting Nights
                var xmlHttp = new XMLHttpRequest();
                checkIn  = document.getElementById('checkIn').value;
                document.getElementById('checkOut').type = 'date';
                xmlHttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        checkOut = this.response;
                        document.getElementById("checkOut").value = checkOut;

                        // Calculating Expense after selecting nights
                        var xmlHttpExpense = new XMLHttpRequest();
                        checkIn  = document.getElementById('checkIn').value;
                        hotel  = document.getElementById('id_hotel').value;
                        cityName  = document.getElementById('city').value;
                        xmlHttpExpense.onreadystatechange = function(){
                            if(this.readyState == 4 && this.status == 200){
                                document.getElementById("HotelExpense").value = this.response;
                            }
                        }
                        xmlHttpExpense.open("GET", "../getHint.php?q=calculateExpense&o="+checkOut+"&i="+checkIn+"&h="+hotel+"&c="+cityName, true);
                        xmlHttpExpense.send();
                    }
                }
                xmlHttp.open("GET", "../getHint.php?q=calculateDate&n="+night+"&i="+checkIn, true);
                xmlHttp.send();
                
            }   

            function calculateCheckOut(checkIn){
                // Function to calculate Date after selecting CheckIn
                var xmlHttp = new XMLHttpRequest();
                night  = document.getElementById('night').value;
                document.getElementById('checkOut').type = 'date';
                xmlHttp.onreadystatechange = function(){
                    if(this.readyState == 4 && this.status == 200){
                        checkOut = this.response;
                        document.getElementById("checkOut").value = checkOut;

                        // Calculating Expense after->
                        var xmlHttpExpense = new XMLHttpRequest();
                        checkIn  = document.getElementById('checkIn').value;
                        hotel  = document.getElementById('id_hotel').value;
                        cityName  = document.getElementById('city').value;
                        xmlHttpExpense.onreadystatechange = function(){
                            if(this.readyState == 4 && this.status == 200){
                                document.getElementById("HotelExpense").value = this.response;
                            }
                        }
                        xmlHttpExpense.open("GET", "../getHint.php?q=calculateExpense&o="+checkOut+"&i="+checkIn+"&h="+hotel+"&c="+cityName, true);
                        xmlHttpExpense.send();
                    }
                }
                xmlHttp.open("GET", "../getHint.php?q=calculateDate&n="+night+"&i="+checkIn, true);
                xmlHttp.send();
                
            }
        </script>
    </head>
    <body>
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
            <select id="id_hotel" name="id_hotel" onchange=getExpense(this.value) required>
                <option value="">--Select-Hotel--</option>
            </select>
            <output name="HotelExpense" id="HotelExpense"></output>
            <br>
            <br>
            
            <!-- <label for="checkIn">Check In: </label>&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;
            <label for="checkOut">Check Out: </label> -->
            <!-- Date with Limit using PHP -->
            <input style="width: 130px;" type="text" name="checkIn" placeholder="Check In" onfocus="(this.type='date')" id="checkIn" onchange="calculateCheckOut(this.value)" required min="<?php echo date('Y-m-d');?>">
            <input style="width: 130px;" type="text" name="checkOut" placeholder="Check Out" onfocus="(this.type='date')" id="checkOut" onchange="calculateExpense(this.value)" required min="checkIn.value"><br>
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