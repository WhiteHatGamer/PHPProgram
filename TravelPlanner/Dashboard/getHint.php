<?php

// Cities Local Database with distance and Hotels with Rate
$city = [
    // Template: 'CityName=>[0=>distance, 1=>['HotelName'=>RateInAED, ...] ]'
    'Ajman'=>array(69,['radison'=>497, 'Crown Palace'=>172, 'mermaid'=>170]),
    'Abu-Dhabi'=>array(242,['Radison'=>732]),
    'Al Ain'=>array(223,['Radison'=>314, 'Al Soft'=>320]),
    'Ar-Rams'=>array(28,['Hilton'=>344, 'Cove Rotana'=>794]),
    'Al Jazirah Al Hamra'=>array(27,['The Ritz Carlton'=>3811, 'SH Hotel'=>123]),
    'Delhi'=>array(2971,['The Ashok'=>422, 'Oberoi Udaivilas'=>3956, 'Oberoi'=>1033, 'De Pavilion'=>156]),
    'Dubai'=>array(108,['Radison Blue'=>642]),
    'Dibba Al-Fujairah'=>array(60,['Fairmont'=>642]),
    'Dhaid'=>array(53,['Aldar'=>164]),
    'Dibba Al-Hisn'=>array(64,['Mirage'=>202]),
    'Fujairah'=>array(93,['V Hotel'=>120, 'Al Bahar'=>495]),
    'Ghayathi'=>array(456,['Western Hotel'=>250]),
    'Hatta'=>array(134,['Ja Hatta'=>621]),
    'Jebel Ali'=>array(146,['Premier Inn'=>331]),
    'Khorfakkan'=>array(94,['Oceanic'=>508]),
    'Kalba'=>array(108,['KingFisher'=>1882]),
    'Kerala'=>array(4347,['Ginger'=>165, 'ailink Castle'=>155, 'Vivanta tvr'=>341, 'KTDC'=>311]),
    'Liwa Oasis'=>array(438,['Liva'=>588, 'Liva Nights'=>1588]),
    'Madinat Zayed'=>array(365,['Western'=>387]),
    'Pakistan'=>array(2336,['Safi Land'=>291, 'Ramada Plaza'=>331, 'Beach Luxury'=>268]),
    'Ruwais'=>array(431,['Dafra'=>351]),
    // 'riyadh'=>array(1195,[]),
    // 'jeddah'=>array(2330,[]),
    'Cairo'=>array(3680,['Grand Nile'=>561, 'Flamenco'=>351]),
    'Istanbul'=>array(3839,['St Regis'=>2617, 'Concept'=>250, 'Kaya Istanbul'=>435]),
    'Mumbai'=>array(3095,['Niranta'=>284,'Bawa'=>275]),
    'Kochi'=>array(4340,['Ginger'=>165, 'ailink Castle'=>155]),
    'Ahmedabad'=>array(2593,['Comfort'=>206, 'SilverCloud'=>104]),
    'Chennai'=>array(4177,['Pride'=>117, 'YWCA'=>95]),
    'Hyderabad'=>array(3619,['Radison'=>385, 'Siesta'=>145]),
    'Karachi'=>array(1781,['Ramada Plaza'=>331, 'Beach Luxury'=>268]),
    'Manila'=>array(12957,['Peninsula'=>608, 'Mini Suite Eton Tower'=>135, 'Bayview'=>145]),
    'Bangkok'=>array(6748,['Center Point'=>295]),
    'Baku'=>array(2312,['Radison'=>400, 'Holiday Inn'=>323]),
    // 'Tbilisi'=>array(2613,[]),
    // 'paris'=>array(6519,[]),
    // 'london'=>array(6742,[]),
    'Ras Al Khaimah'=>array(0,['Hilton'=>346, 'The Cove Rotana'=>795]),
    'Sharjah'=>array(78,['Crown Palace'=>172,'Crystal Plaza'=>142]),
    'Tamil Nadu'=>array(4254,['Shelter Beach'=>178, 'NK Grand'=>104, 'Pride'=>117, 'YWCA'=>95]),
    'Umm Al Quwain'=>array(60,['Beach Hotel'=>426, 'Pearl'=>323, 'Palma'=>292]),
];

// get query
$q = $_REQUEST['q'];

// menu search on query
switch ($q) {
    case 'time':
        $time = $source = $destination = '';
        // get strings from GET
        $source = htmlspecialchars($_REQUEST['s']);
        $destination = htmlspecialchars($_REQUEST['d']);
        $way = htmlspecialchars($_REQUEST['w']);
        
        // checking if source and destination set
        if(!isset($city[$source])){
            echo "Please Select Source City";
            exit;
        }
        if(!isset($city[$destination])){
            echo "Please Select Destination City";
            exit;
        }
        
        $km = abs($city[$destination][0] - $city[$source][0]);
        
        switch($way){
            case 'airplane':
                $time = round($km/800, 3)."hr";
                break;
            case 'train':
                $time = round($km/120, 3).'hr';
                break;
            case 'car':
                $time = round($km/80, 3).'hr';
                break;
            case 'bus':
                $time = round($km/60, 3).'hr';
                break;
            case 'cycle':
                $time = round($km/15, 3).'hr';
                break;
            case 'walk':
                $time = round($km/4, 3).'hr';
                break;
        }
        
        echo $time === '' ? "Select an Option" : "ETA: ".$time;
        exit;
    
    case 'searchCity':
        // Get string from GET with HTML filter
        $options = '';
        $str = htmlspecialchars($_REQUEST['s']);
        $len = strlen($str);

        // // Checking if any string entered
        // if($len==0){
        //     exit;
        // }


        // Loop through every City name in 
        foreach($city as $key => $value){

            // cut string of city to check if contains from start
            $strip = mb_strcut($key, 0, $len);
            if(!(stripos($strip, $str)===false)) {

                // Add Option
                $options = "<option>$key</option>".$options;
            }else{

                // removing space from key to suggest if entered without space also
                $noSpace = str_replace(' ','',$key);
                $strip = mb_strcut($noSpace, 0, $len);
                if(!(stripos($strip, $str)===false)) {
                    $options = "<option>$key</option>".$options;
                }
            }
        }
        // printing Option string
        echo $options;
        exit;
    case 'getHotel':

        // Get string from GET with HTML filter
        $options = '';
        $cityName = htmlspecialchars($_REQUEST['s']);
        $len=strlen($cityName);

        // Checking if any string entered
        if($len==0){
            $options = "<option value=''>--Select-Hotel--</option>".$options;
            echo ($options);
            exit;
        }
        
        // checking if City Name is Available
        if(!isset($city[$cityName])){
            $options = "<option value=''>--Select-Hotel--</option>".$options;
            echo ($options);
            exit;
        }
        
        $cityValue = $city[$cityName][1];
        foreach ($cityValue as $key => $value) {
            $options = "<option value='$key'>$key</option>".$options;
        }
        
        // Adding the select option without Value to prevent AutoSelect
        $options = "<option value=''>--Select-Hotel--</option>".$options;

        // printing Option string
        echo ($options);
        exit;
    case 'getExpense':
        // Get Hotel Name
        $hotel = $_REQUEST['h'];
        $CityName = $_REQUEST['c'];
        $night = $_REQUEST['n'];
        $len = strlen($hotel);

        // checking if any string exist
        if(!isset($hotel)){
            exit;
        }

        // Check if Hotel is Available
        if(!isset($city[$CityName][1][$hotel])){
            exit;
        }

        $hotelRate = @$city[$CityName][1][$hotel];
        
        if($night==1){
            
            // Check price of one day from array
            echo "Estimated: AED $hotelRate for $night Night";
        }else{
            
            $fare = (int)$hotelRate*(int)$night;
            // Check price of one day from array
            echo "Estimated: AED $hotelRate for $night Night(s) => AED $fare";
        }
        exit;
    case 'calculateExpense':

        // Calculate Expense of the Hotel with Daily into Days Chosen
        $checkIn = htmlspecialchars($_REQUEST['i']);
        $checkOut = htmlspecialchars($_REQUEST['o']);
        $hotel = htmlspecialchars($_REQUEST['h']);
        $cityName = htmlspecialchars($_REQUEST['c']);

        $hotelRate = @$city[$cityName][1][$hotel];

        // Checking if checkin after checkout
        if($checkOut <= $checkIn){
            echo "Estimated: AED $hotelRate for 1 Night";
            exit;
        }
        $day = round((strtotime($checkOut)-strtotime($checkIn))/60/60/24, 2);
        $fare = $hotelRate * $day;
        echo "Estimated: AED $hotelRate for $day Night(s) => AED $fare";
        exit;
    case 'calculateDate':
        // Calculate Date From Nights Selected
        $checkIn = htmlspecialchars($_REQUEST['i']);
        $night = (int)htmlspecialchars($_REQUEST['n']);
        
        $day = strtotime($checkIn)+(60*60*24*$night);
        echo date("Y-m-d",$day);
        exit;
    case 'calculateNight':
        // Calculate Night From CheckOut Selected
        $checkIn = htmlspecialchars($_REQUEST['i']);
        $checkOut = htmlspecialchars($_REQUEST['o']);

        if($checkOut <= $checkIn){
            echo "1";
            exit;
        }

        $day = round((strtotime($checkOut)-strtotime($checkIn))/60/60/24, 2);
        if($day<31){
            echo "$day";
        }else{
            echo "31";
        }
    default:
        # code...
        exit;
}
?>