<?php
    include("../dbconfig.php");

    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['ic']) != session_id() )
    {
        header('location: ../login/login.php');
    }

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "DELETE FROM users WHERE u_userIC='".$id."';";

        $result = mysqli_query($conn, $sql);

        if ($result)
        {
            header("location: readUser.php?id=".$_SESSION['ic']."");
        } 
        else
        {
            echo "ERROR:  $conn->error";
            header("refresh: 5; location: readUser.php?id=".$_SESSION['ic']."");
        }
    } 
    else 
    {
        echo "ERROR Occur! Will direct back to the same page in 5 seconds";
        header("refresh: 5; location: readUser.php");
    }
?>

