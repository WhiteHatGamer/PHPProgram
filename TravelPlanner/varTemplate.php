<?php

    // Database Credentials
    $Host = '';
    $UserName = '';
    $Password = '';
    $port = 0;
    $Database = '';

    // Table Names inside the DB
    $UserTable = '';
    $NoteTable = '';

    // Connect to database using Credentials
    try {
        $Mysqli = new mysqli($Host, $UserName,  $Password, $Database, $port);
    } catch (Exception $th) {
        echo "ERROR 500 <br><br>Server Error";
        exit;
    }
?>