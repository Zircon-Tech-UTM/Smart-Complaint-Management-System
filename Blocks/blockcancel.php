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

    $bid;
    
    if(isset($_GET['id']))
    {
        $bid = $_GET['id'];
    }

    $sql = "DELETE FROM blocks
            WHERE block_no = '$bid'";

    $result = mysqli_query($conn, $sql);

    if($result)
    {
        header ("Location: blocklist.php");
    }
    else
    {
        echo $conn->error;
    }

    mysqli_close($conn);

?>