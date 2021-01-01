<?php
    
    session_start();
    include("dbconfigUser.php");

    $username = $_POST['name'];
    $IC = $_POST['IC'];
    $password = $_POST['password'];
    $addr = $_POST['faddr'];
    $positionBI = $_POST['position'];
    $contact = $_POST['fcontactnum'];
    $room = $_POST['room'];
    $email= $_POST['femail'];

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $rdate= date('Y-m-d H:i:s');  

    if($positionBI=="Admin")
    {
        $userType="1";
        $positionBM="Pentadbir";
    }
    else if($positionBI=="PIC Of Room")
    {
        $userType="2";
        $positionBM="PIC Makmal";
    }
    else if($positionBI=="Assistant Computer Technician")
    {
        $userType="3";
        $positionBM="Penolong Juruteknik Komputer";
    }
    else
    {
        $userType="4";
        $positionBM="Penolong Jurutera";
    }


    $sql = "INSERT INTO users (u_userIC, pwd, name, postBI, postBM, address, email, contact, userType, dateRegistered ) VALUES('".$IC."', '".$password."','".$username."','".$positionBI."', '".$positionBM."',' ".$addr."', '".$email."','".$contact."', '".$userType."', '".$rdate."')";

    echo '\n';
    echo $sql;
    echo '\n';
    
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location: ../landingUser.php");
        exit();
    } else{
        echo "ERROR: $conn->error";
    }

    mysqli_close($conn);
?>