<?php

    // define('DB_SERVER', 'localhost');
    // define('DB_USERNAME', 'mtnemcmy_admin');
    // define('DB_PASSWORD', '3PVZ%&+$-u@M');
    // define('DB_NAME', 'mtnemcmy_aqoonjire');

    define('DB_SERVER', 'localhost');
    define('DB_USERNAME', 'root');
    define('DB_PASSWORD', 'root');
    define('DB_NAME', 'wadani');

    /* Attempt to connect to MySQL database */
    $conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    $connection2 = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
    // Check connection
    if(mysqli_connect_error()){
        die("ERROR: Could not connect. " . mysqli_connect_error());
    }
?>