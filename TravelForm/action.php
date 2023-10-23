<?php
    echo 'Hi '.htmlspecialchars($_POST['name']);
    echo "<br>Your Contact is : ".htmlspecialchars($_POST['contact']);
    $mysqli = mysqli_connect('localhost', 'root', '', 'form', 3307);
    $mysqli->execute_query("
        INSERT INTO `user`(name,contact) values(".htmlspecialchars($_POST['name']).",".htmlspecialchars($_POST['contact'])
    );
?>