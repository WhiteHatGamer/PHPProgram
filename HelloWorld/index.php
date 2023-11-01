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

    // Numbers and operations
    $num1 = 4;
    $float1 = 27.65;
    $bool4 = true;

    // Type Casting
    $num2 = (int)$float1;
    
    $sum = $num1 + $float1;
    
    // Strings and Operations
    $str1 = "Char";
    $str2 = "string";
    $hello = "Hello World!";

    $length = strlen($str2);
    echo "len = $length <br>";
    $words = str_word_count($hello);
    echo "words = $words <br>";
    $reverse = strrev($str1);
    echo "rev = $reverse <br>";
    $find = strpos($hello, "o World");
    echo "find = $find <br>";
    $replace = str_replace("World","PHP", $hello);
    echo "replace = $replace <br>";

    
    $Quotes = "he said \"hello\" ";
    
    define("MY_NAME", "WhiteHatGamer");
    
    // TITLE: ARRAYS
    echo "<h3>Arrays</h3><br>";
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
    echo "<h3>Loops</h3><br>";
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

    // Faster Than adding the Size variable in condition
    for($i=0,$size=count($numbers);$i<$size;$i++){
        if($i==10){
            echo "Breaking before 10<br>";
            break 1;
        }
        echo "numbers['$i']: ".$numbers[$i]."<br>";
        echo mt_rand(000000,999999)."<br>";
    }

    echo "While Loop<br>";
    $i = 0;
    while ($i <= 10) {
        echo $i;
        echo"<br>";
        $i++;
    }

    echo "Do-While Loop><br>";
    $i=0;
    do {
        echo $i;
        echo"<br>";
        $i++;
    } while ($i <= 10);

    echo "For Each<br>";
    $people = [1,2,3,4,5,6,7,8,9,0];
    foreach ($people as $i) {
        echo $i;
        echo "<br>";
    }

    echo "Foreach with Key and value<br>";
    $HexAssociative = [10=>'a',11=>'b',12=>'c',13=>'d',14=>'e',15=>'f']; 
    foreach($HexAssociative as $k => $i){
        echo $k.": ".$i;
        echo '<br>';
    }

    // TITLE: Math Functions
    min($numbers);  // Returns Smallest
    max($numbers);  // Returns Largest
    abs(-56.564);   // returns absolute Value = 56.564
    sqrt(4);        // returns Square root = 16
    round(564.554); // rounds to nearest = 565
    rand();          // Generates any random number
    rand(0,100);     // Generated Random within range of 0-100

    // CONSTANTS
    echo "Constants<br>";
    define ("PI", 3.1417);
    const MY_PHONE = "OPPO A78";
    echo "PI Value is ".PI."<br>"; // Don't need $
    echo "My Phone is ".MY_PHONE."<br>";

    // TITLE: operators
    echo "<h3>Operators</h3><br>";

    // Arithmetic Operators
        // +, -, *, /, %, **

    // Ternary Operator

    $max = 4>10? 4 : 10;
    echo "Max is $max<br>";

    // If Logical Operators || , OR, &&, AND, XOR, !
    $num1 = 65;
    if($num1>60 || $num1 < 15){
        echo "num1 is under aged or over aged<br>";
    }

    //  Error control Operators - @

    $MyFile = @file('Non-existing File');// or die ('Failed Opening File: Error('.error_get_last()['message'].')'); // This Stops the remaining File From Executing
    echo error_get_last()['message']."<br>";

    $value = @$cache['key'];
    echo error_get_last()['message']."<br>";

    // Execution Operator - ` ` - This operator Runs shell Code and can store in variables

    $output = `ls`;
    echo "<pre>$output</pre>";

    // String Concatenation Operators

    $concat = $str1 . $str2;
    $alsoConcat = "$str1 $str2"; // same as $concat
    $str1 .= $str2; // Same as  $str1 = $Str1.$Str2;

    // Array Operations - + == === != <> !==

    $a = ['A' => "Apple", 'B' => "Banana"];
    $b = ['A' => "Airplane", 'B'=> "Bat", 'C'=>"Cherry"];

    echo "Union A+B: ";
    print_r($a + $b);
    echo "<br>";
    echo "Union B+A: ";
    print_r($b + $a);
    echo "<br>";

    $a = array("apple", "banana");
    $b = array(1=>"banana", 0=>"apple");
    echo "a==b: ";
    var_dump($a==$b);
    echo "<br> a===b: ";
    var_dump($a===$b);
    echo "<br>";

    // Type Operator - instanceof - Checks whether the object is of given type
    interface MyInterface{}
    class MyClass implements MyInterface{}
    class NotMyClass{}
    class ChildClass extends MyClass{}

    $a = new MyClass;
    $b = new ChildClass;

    echo "MyClass(MyInterface)->ChildClass and NotMyClass<br>MyClass(\$a), ChildClass(\$b)<br>";
    echo " \$a Instance of MyClass: ";
    var_dump($a instanceof MyClass);
    echo "<br> \$a instance of NotMyClass: ";
    var_dump($a instanceof NotMyClass);
    echo "<br> \$a instance of MyInterface: ";
    var_dump($a instanceof MyInterface);
    echo "<br> \$a instance of ChildClass: ";
    var_dump($a instanceof ChildClass);
    echo "<br> \$b instance of MyClass: ";
    var_dump($b instanceof MyClass);
    echo "<br> \$b instance of MyInterface: ";
    var_dump($b instanceof MyInterface);
    echo "<br>";

    // TITLE: Control Structures
    echo "<h3>Control Structures</h3><br>";

    $num1 = 14;

    // IF conditional value ==, >, < ,!= 
    if($num1 == 14){
        echo "num1 is 14<br>";
    }else{
        echo "num1 is not 14<br>";
    }

    // If data type comparison === but also need to be same
    if($num1 === 'a'){
        echo "\$num1 is 'a' and its String Type<br>";
    }elseif ($num1 === 14) {
        echo "\$num1 is 14 and its Number Type<br>";
    }else{
        echo "num1 is of unknown data and type<br>";
    }

    // Switch
    switch ($num1) {
        case 1:
            echo "1st Case: num1 is 1<br>";
            break;
        case 5:
            echo "2nd Case: num1 is 1<br>";
            break;
        case 14:
            echo "3rd Case: num1 is 14<br>";
            break;
        default:
            echo "Default Case: num1 is not 1<br>";
            break;
    }

    // match Conditional

    $guess = 6;
    echo match ($guess) {
        4 => "Guessed Less Than Actual<br>",
        6 => "Guessed Greater Than Actual<br>",
        5 => "Your Guess is Correct<br>",
        default => "Wrong Guess. Please Try Again!!<br>",
    };

    $age = 24;
    // Checked by correct order
    echo match (true) {
        $age>=65 => "Senior<br>",
        $age>=18 => "Adult<br>",
        $age>=12 => "Teen<br>",
        default => "Child<br>",
    };

    // Declare - 
    
    // Ticks are a Statement Trigger where it triggers on every n statements declared
    // declare(ticks = 30);
    // function TickHandler(){
    //     echo "!!!!!!!!!!!!!!!!!!!!Tick Triggered!!!!!!!!!!!!!!!!!!!!!!<br>";
    // }
    // register_tick_function('TickHandler');

    // Encoding - using declare of encoding sets the encoding of the scripts below
    // declare (Encoding = 'ISO-8859-1');

    // TITLE: Function Definition
    echo "<h3>Functions</h3><br>";
    function myFunction(){
        echo "Inside Function<br>";
    }

    // Function Calling
    myFunction();

    // Function with Parameters 
    // - Can also make class as default parameter and call
    // - Default Parameter need to be at the end to prevent few argument error
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

    // functions with variable
    echo "Variable Arguments<br>";
    function VarDisplayFunction(...$numbers){
        foreach ($numbers as $key) {
            echo $key;
        }
    }
    VarDisplayFunction('a','e','i','o','u');
    echo "<br>";

    // Function Variable and Method
    class MyClassWithMethod{
        function myClassFunction($arg){
            echo "Inside MyFunction and The Argument is $arg<br>";
            $myMethodName = 'myMethod';
            $this->$myMethodName();
        }

        static function myMethod(){
            echo "class &lt;MyClassWithMethod&gt;<br>";
        }
    }

    $myClassVar = new MyClassWithMethod;
    $myClassVar->myClassFunction('ARGUMENT');

    // Can only run if static
    $ClassMethodVariable = "MyClassWithMethod::myMethod";
    $ClassMethodVariable();

    // Functions With return reference
    function &ReturnReference(){
        // can access global variable s using global keyword
        global $num1;
        echo "global variable accessed $num1<br>";
        $someRef = &$num1;
        return $someRef;
    }

    $newRef =& ReturnReference();
    echo "Got Num1: $num1 Reference: $newRef <br>";
    $newRef += 5;
    echo "After addition Num1: $num1 Reference: $newRef <br>";

    // Function with return type
    function ReturnRandomInt():int{
        return rand();
    }

    echo "Random Function with int return type returned: ".ReturnRandomInt()."<br>";

    // Anonymous Functions
    $greet = function($name){
        echo "Hello $name<br>";
    };

    $greet("World");
    $greet("PHP");

    // TITLE: Classes and Objects OOP
    echo "<h3>Classes and Objects</h3><br>";

    trait Details{
        public function ClassDetails(){
            echo "<h5>Class&lt;".__CLASS__."&gt;</h5>";
        }
    }

    class SimpleClass{
        // Class Variables or properties
        public $num1 = 15;
        public $num2 = 30;
        public $var1 = <<<EOD
        Hello World!
        EOD;

        // Without Visibility Modifier
        static $var2;
        readonly int $var3;

        public function DisplayDetails(){
            echo "Variables: ".$this->num1.", ".$this->num2."<br>";
        }

        // Test Null Validation Operator
        public function getClass(){
            return (new SimpleClass);
        }
        use Details;
    }
    
    // Inheritance
    class myObject extends SimpleClass{
        function WhatsThis(){
            echo "Child of &lt;SimpleClass&gt;<br>";
            $this->DisplayDetails();
        }
        
        function DisplayDetails(){
            echo "Extended Display Details => ";
            parent::DisplayDetails();
        }
    }
    
    $test = new SimpleClass;
    $test->DisplayDetails();
    $test->ClassDetails();
    var_dump($test instanceof(new myObject));
    echo "<br>";
    
    $TestExt = new myObject;
    $TestExt->DisplayDetails();
    $TestExt->ClassDetails();

    
    class Employee{
        // Typed Variables
        public int $id;
        public ?string $name;

        readonly string $bio;
        
        const COMPANY = "Smart Travels LLC";

        // Constructor of Classes __construct
        public function __construct(int $id, string $name, string $bio){
            $this->id = $id;
            $this->name = $name;

            // Readonly properties of the class can only initialize using constructor and not outside class even if its not initialized
            $this->bio = $bio;
            echo "Employee Constructed<br>";
        }

        // Runs on the end of the file. which destructs the class object created using the 
        function __destruct(){
            //echo "<br>Destructing ".__CLASS__."<br>";
        }
        use Details;
    }
    // can also utilize $this to make function - Setter and getter

    // Access Modifiers - 
        // public 
        // private
        // protected
    
    $employee1 = new Employee(1,"Anear","Hello My name is");
    $employee1->ClassDetails();

    // Abstract Class forces the Child class to Define the Methods
    abstract class Sound{
        abstract public function sound(bool $PoPo);
    }

    class Cars extends Sound{
        public $color;
        public $model;
        public $make;
        public int $year;
        public function __construct(string $make, string $model, int $year, string $color){
            $this->color = $color;
            $this->model = $model;
            $this->year  = $year;
            $this->make  = $make;
        }
        
        final public function CarDetails(){
            echo "The Car is $this->year $this->make $this->model of $this->color Color<br>";
        }

        // Abstract Method Definition
        public function sound(bool $PoPo){
            echo "Cars Sounds Brr<br>";
        }
    
    // TITLE: Date and Time
    echo "<h3>Date And Time</h3><br>";
    
    // Setting Timezone
    date_default_timezone_set('Asia/Kolkata');
    echo date('H:i:s l d/m/Y');

    $timestamp = mktime(15,37,16,10,10,23);
    echo "<br>";
    echo (date('H:i:s l d/m/Y', $timestamp));

    $timestamp2 = strtotime("15th October 2023 13:05");
    echo "<br>";
    echo (date('H:i:s l d/m/Y', $timestamp2));

    // TITLE: Global Variable $_SERVER

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