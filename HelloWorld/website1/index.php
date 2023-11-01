<?php
    // Starting Session
    session_start();

    echo "<h3>Header</h3>";
    // 'require' instead of 'include' makes it wont print anything else without that content
    include __DIR__."/inc/header.php";
    require_once __DIR__."/../vars.php";
?>
    <h1>Home</h1>
    <h2>Header 2</h2>
<?php include "/src/PHPProgram/HelloWorld/website1/inc/footer.php"?>