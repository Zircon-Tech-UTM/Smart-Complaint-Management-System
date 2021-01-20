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

    if ($_SESSION["userType"] != '1'){
        exit();
    }

    if(isset($_GET['id']))
    {
        $rid = $_GET['id'];
    }

    if ($_SESSION["userType"] != '1'){
        exit();
    }

    $sql = "SELECT * FROM rooms
    WHERE r_roomID = '$rid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    unlink($row["r_img_path"]);

    $sql = "DELETE FROM rooms
            WHERE r_roomID = '$rid'";
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