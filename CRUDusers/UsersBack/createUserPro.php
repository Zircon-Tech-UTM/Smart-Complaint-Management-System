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

    $sql = "INSERT INTO users (u_userIC, registered_by, pwd, name, postBI, postBM, address, email, contact, dateRegistered,no_aduan, u_img_path,userType ) VALUES('".$IC."', '".$adminname."', '".$password."','".$username."','".$positionBI."', '".$positionBM."',' ".$addr."', '".$email."','".$contact."', '".$rdate."', ".$no_aduan.",'".$image."', '".$userType."')";

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