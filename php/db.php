<?php
    $db_host = "localhost";
    $db_username = "root";
    $db_password = "root";
    $db_name = "betterland";

    

    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    $conn -> set_charset("utf8");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn -> connect_error);
    }

    $GLOBALS['connection'] = $conn;

?>