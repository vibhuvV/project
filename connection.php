<?php
    $server = "localhost";
    $username = "root";
    $password = "toor";
    $database = "pms";

    $conn = new mysqli($server, $username, $password, $database);

    if($conn->connect_error){
        die("Can't establish connection: " .$conn->connect_error);
    }
    session_start();    
?>