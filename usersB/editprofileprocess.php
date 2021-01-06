<?php
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../login/login.php');
    }
    include("../dbconfig.php");

    $IC = $_POST['IC'];
    $password = $_POST['password'];
    $addr = $_POST['faddr'];
    $contact = $_POST['fcontactnum'];
    $email= $_POST['femail'];

    $sql = "UPDATE users
            SET  pwd='".$password."',address='".$addr."', email='".$email."', contact= '".$contact."'
            WHERE u_userIC=".$IC."";

    echo '\n';
    echo $sql;
    echo '\n';
    
    $result = mysqli_query($conn, $sql);

    if($result)
    {
        header("location: landing.php?id=".$IC."");
    } 
    else
    {
        echo "ERROR: $conn->error";
    }

    mysqli_close($conn);
?>