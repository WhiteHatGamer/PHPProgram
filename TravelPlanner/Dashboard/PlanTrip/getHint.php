<?php
$city = [
    'Ajman'=>69,
    'Abu-Dhabi'=>242,
    'Al Ain'=>223,
    'Ar-Rams'=>28,
    'Al Jazirah Al Hamra'=>27,
    'Delhi'=>2971,
    'Dubai'=>108,
    'Dibba Al-Fujairah'=>60,
    'Dhaid'=>53,
    'Dibba Al-Hisn'=>64,
    'Fujairah'=>93,
    'Ghayathi'=>456,
    'Hatta'=>134,
    'Jebel Ali'=>146,
    'Khorfakkan'=>94,
    'Kalba'=>108,
    'Kerala'=>4347,
    'Liwa Oasis'=>438,
    'Madinat Zayed'=>365,
    'Pakistan'=>2336,
    'Ruwais'=>431,
    // 'riyadh'=>1195,
    // 'jeddah'=>2330,
    'Cairo'=>3680,
    'Istanbul'=>3839,
    'Mumbai'=>3095,
    'Kochi'=>4340,
    'Ahmedabad'=>2593,
    'Chennai'=>4177,
    'Hyderabad'=>3619,
    'Karachi'=>1781,
    'Manila'=>12957,
    'Bangkok'=>6748,
    'Baku'=>2312,
    // 'Tbilisi'=>2613,
    // 'paris'=>6519,
    // 'london'=>6742,
    'Ras Al Khaimah'=>0,
    'Sharjah'=>78,
    'Tamil Nadu'=>4254,
    'Umm Al Quwain'=>60
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
        
        $km = abs($city[$destination] - $city[$source]);
        
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
        exit;
    default:
        # code...
        exit;
}
?>