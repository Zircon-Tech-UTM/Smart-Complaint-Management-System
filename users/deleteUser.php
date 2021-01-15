<?php
    include("../dbconfig.php");

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
        $id = $_GET['id'];

        $sql = "SELECT * FROM users WHERE u_userIC=".$id.";";
        $result = mysqli_query($conn, $sql);
        $row = mysqli_fetch_array($result);
        unlink($row["u_img_path"]);


        $sql = "DELETE FROM users WHERE u_userIC='".$id."';";

        $result = mysqli_query($conn, $sql);

        if ($result)
        {
            header("location: readUser.php");
        } 
        else
        {
            echo "ERROR:  $conn->error";
            header("refresh: 5; location: readUser.php");
        }

    } 
    else 
    {
        echo "ERROR Occur! Will direct back to the same page in 5 seconds";
        header("refresh: 5; location: readUser.php");
    }
?>

