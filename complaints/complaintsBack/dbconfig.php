<?php
    define("HOST", "localhost");
    define("USER", "root");
    define("PASSWORD", "");
    define("DATABASE", "experiment");

    $conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);

    if(!$conn){
        die("Connection failed: ". $conn->connect_error);
    } 
?>