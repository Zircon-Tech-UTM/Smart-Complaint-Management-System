<?php
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../loginlogout/login.php');
    }
    include("dbconfigUser.php");

    $username = $_POST['name'];
    $IC = $_POST['IC'];
    $password = $_POST['password'];
    $addr = $_POST['faddr'];
    $positionBI = $_POST['position'];
    $contact = $_POST['fcontactnum'];
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

    $sql = "UPDATE users
            SET  pwd='".$password."', name='".$username."', postBI='".$positionBI."',postBM='".$positionBM."', address='".$addr."', email='".$email."', contact= '".$contact."', dateRegistered='".$rdate."', userType='".$userType."'
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