<?php
    require_once("UsersBack\dbconfigUser.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM users WHERE u_userIC=".$id.";";

        $result = mysqli_query($conn, $sql);

        if ($result){
            header("location: readUser.php");
        } else{
            echo "ERROR:  $conn->error";
            header("refresh: 6; location: readUser.php");
        }

    } else {
        echo "ERROR Occur! Will direct back to the same page in 5 seconds";
        header("refresh: 6; location: readUser.php");
    }
?>