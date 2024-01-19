<html>
<head>
    <title>jQuery AJAX Autocomplete</title>
    
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script> -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    
</head>
<body>
    <h1>jQuery AJAX Country Autocomplete</h1>
    <div class="frmSearch">
        <input type="text" list="country-list" id="searchBox" placeholder="Country Name" style="background-image: url(https://media.tenor.com/JeNT_qdjEYcAAAAj/loading.gif); background-size: 10px; background: #FFF no-repeat; "/>
        <div id="suggestion-box"></div>
        <br>
        <input type="text" placeholder="HOTEL">
    </div>
    
    <script>
        // AJAX call for autocomplete 
        $(document).ready(function() {
            $("#searchBox").keyup(function() {
                $.ajax({
                    type: "POST",
                    url: "readCountry.php",
                    data: 'keyword=' + $(this).val(),
                    beforeSend: function() {
                        $("#searchBox").css("background-image", "url(https://media.tenor.com/JeNT_qdjEYcAAAAj/loading.gif)");
                        $("#searchBox").css("background", "#FFF no-repeat 165px");
                    },
                    success: function(data) {
                        $("#suggestion-box").show();
                        $("#suggestion-box").html(data);
                        $("#searchBox").css("background", "#FFF");
                    }
                });
            });
        });

        //To select a country name
        function selectCountry(val) {
            $("#searchBox").val(val);
            $("#suggestion-box").hide();
        }

    </script>
</body>
</html>
