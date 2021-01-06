<?php

    require_once("../dbconfig.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }

    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../login/login.php');
    }

    //Retrieve data from modify form
    $r_roomID = $_POST["roomID"];
    $r_nameBI = $_POST["nameBI"];
    $r_nameBM = $_POST["nameBM"];
    $r_PICid = $_POST["PIC"];
    $r_block = $_POST['block'];

        //insert into database
    $sql = "UPDATE rooms
            SET PIC = '$r_PICid', r_nameBI = '$r_nameBI', r_nameBM = '$r_nameBM', blok = '$r_block'
            WHERE r_roomID = '$r_roomID'";

    $result = mysqli_query($conn, $sql);
    if($result)
    {
        header ("Location: roomlist.php");
    }
    else
    {
        echo $conn->error;
    }
    mysqli_close($conn);

?>