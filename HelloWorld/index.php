<?php
    // Single Line COmment
    # Same in Python too?
    /*
    Multi Line Comment Same in C
    */
    echo "Hello World"; // Faster
    echo"<br>";
    print "Yeah Again";
    echo"<br>";
    
    /** Variables
     * PreFix $
     */
    $hello = 'Hello World!';
    echo $hello;
    echo"<br>";
    
    /** Data Types
     * String
     * integer
     * float
     * bool
     * arrays
     * object/class
     * NULL
     * resource?
     */
    $str1 = "Char";
    $str2 = "string";
    $num1 = 4;
    $float1 = 27.65;
    $bool4 = true;
    
    $sum = $num1 + $float1;
    $concat = $str1 . $str2;
    $alsoConcat = "$str1 $str2"; // same as $concat
    
    $Quotes = "he said \"hello\" ";
    
    define("MY_NAME", "WhiteHatGamer");
    
    // TITLE: ARRAYS
    $numbers = array(0,1,2,3,4,5,6,7,8,9);
    
    echo $numbers[5];
    echo"<br>";

    $HexAlpha = ['a','b','c','d','e','f']; // another method
    
    $numbers[] = 10; // append to array
    
    $HexCount = count($HexAlpha);
    
    print_r($HexAlpha); // Array Display
    echo"<br>";
    
    var_dump($numbers); // Dumps data, type, etc of a variable
    echo"<br>";
    
    // associative array (Or Hash Table?)
    $ids = [4563=>"person1", 423=>"person2", 64=>"person3"];
    
    echo $ids[4563];
    echo"<br>";

    # TITLE: Loops
    /**
     * For
     * While
     * Do While
     * Foreach
     */

    echo "###For Loop###<br>";
    for($i = 0;$i < 10;$i++){
        echo "Number".$i;
        echo"<br>";
    }

    echo "###While Loop###<br>";
    $i = 0;
    while ($i <= 10) {
        echo $i;
        echo"<br>";
        $i++;
    }

    echo "###Do-While Loop###<br>";
    $i=0;
    do {
        echo $i;
        echo"<br>";
        $i++;
    } while ($i <= 10);

    echo "###For Each###<br>";
    $people = [1,2,3,4,5,6,7,8,9,0];
    foreach ($people as $i) {
        echo $i;
        echo "<br>";
    }

    echo "###Foreach with Key and value###<br>";
    $HexAssociative = [10=>'a',11=>'b',12=>'c',13=>'d',14=>'e',15=>'f']; 
    foreach($HexAssociative as $k => $i){
        echo $k.": ".$i;
        echo '<br>';
    }

    // Function Definition
    // TITLE: Function Definition
    function myFunction(){
        echo "Inside Function<br>";
    }

    // Function Calling
    myFunction();

    // Function with Parameters
    function greeting($name = "World"){
        echo "Hello, ".$name."<br>";
    }

    greeting("WhiteHatGamer");
    greeting();

    // Function with return
    function add($num1,$num2){
        return $num1+$num2;
    }

    $sum = add(6,86);

    echo "sum = $sum <br>";

    // Function pass by reference
    function addTen(&$num1){
        $num1 += 10;
    }

    echo "Before addTen $num1 <br>";
    addTen($num1);
    echo "After addTen $num1 <br>";

    # Conditional Statements and operators
    
    // IF conditional value ==, >, < ,!= 
    if($num1 == 14){
        echo "num1 is 14<br>";
    }else{
        echo "num1 is not 14<br>";
    }

    // If data type comparison === 
    if ($num1 === "a"){
        echo "num1 is string<br>";
    }elseif($num1 === 1){
        echo "num1 is number<br>";
    }else{
        echo "num1 is unknown type<br>";
    }

    // If Logical Operators || , OR, &&, AND, XOR
    $num1 = 65;
    if($num1>60 || $num1 < 15){
        echo "num1 is under aged or over aged<br>";
    }

    // Switch
    switch ($num1) {
        case 1:
            echo "num1 is 1<br>";
            break;
        default:
            echo "num1 is not 1<br>";
            break;
    }

    date_default_timezone_set('Asia/Kolkata');
    echo date('H:i:s l d/m/Y');

    $timestamp = mktime(15,37,16,10,10,23);
    echo "<br>";
    echo (date('H:i:s l d/m/Y', $timestamp));

    $timestamp2 = strtotime("15th October 2023 13:05");
    echo "<br>";
    echo (date('H:i:s l d/m/Y', $timestamp2));

    /*foreach ($_SERVER as $key) {
        echo $key;
        echo "<br>";
    }*/
    echo '<br>';
    echo $_SERVER['HTTP_USER_AGENT'];
    echo "<br>";
    if(str_contains($_SERVER['HTTP_USER_AGENT'], 'Chrome')){
        echo "You are using Chrome";
    }else{
        echo "You are not using Chrome";
    }

?>
<html>
    <body>
        <br>
        <h2>
        <a href="/HelloWorld/website1/index.php">My Website</a>
    </body> 
</html>