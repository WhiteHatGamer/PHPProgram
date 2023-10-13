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
    
    // Title: ARRAYS
    $numbers = array(0,1,2,3,4,5,6,7,8,9);
    
    echo $numbers[5];
    echo"<br>";

    $HexAlpha = ['a','b','c','d','e','f']; // another method
    
    $numbers[] = 10; // append to array
    
    $HexCount = count($HexAlpha);
    
    print_r($HexAlpha); // Array Display
    echo"<br>";
    
    var_dump($concat); // Dumps data, type, etc of a variable
    echo"<br>";
    
    // associative array (Or Hash Table?)
    $ids = [4563=>"person1", 423=>"person2", 64=>"person3"];
    
    echo $ids[4563];
    echo"<br>";
?>