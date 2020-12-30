<?php
    include("dbconfigUser.php");

    $room=$image=$positionBM=$email=$userType="";
    $no_aduan=0;

    $username = $_POST['name'];
    $adminname = $_POST['fAname'];
    $IC = $_POST['IC'];
    $password = $_POST['password'];
    $addr = $_POST['faddr'];
    $positionBI = $_POST['position'];
    $contact = $_POST['fcontactnum'];
    $room = $_POST['room'];
    $email= $_POST['femail'];
    $rdate = $_POST['rdate'];

    $sql = "UPDATE users
            SET registered_by='$adminname', pwd='$password', name='$username', postBI='$positionBI', address='$addr', email='$email', contact= '$contact', dateRegistered='$rdate',no_aduan='$no_aduan'
            WHERE u_userIC='$IC'";

    echo '\n';
    echo $sql;
    echo '\n';
    
    $result = mysqli_query($conn, $sql);

    if($result)
    {
        header("location: ../landingUser.php");
        exit();
    } 
    else
    {
        echo "ERROR: $conn->error";
    }

    mysqli_close($conn);
?>