<?php
    $servername =   'localhost';
    $username   =   'root';
    $password   =   '';
    $dbname     =   'kolej_vokasional_perdagangan';

    $conn       =   mysqli_connect($servername, $username, $password, "$dbname");
    if($conn === false)
    {
        die("ERROR: Could not connect. " .mysqli_connect_error());
    }
