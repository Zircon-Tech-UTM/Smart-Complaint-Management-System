<?php
    require_once("complaintsBack\dbconfig.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "DELETE FROM complaints WHERE complaintsID=".$id.";";

        $result = mysqli_query($conn, $sql);

        if ($result){
            header("location: readComplaint.php");
        } else{
            echo "ERROR:  $conn->error";
            header("refresh: 6; location: readComplaint.php");
        }

    } else {
        echo "ERROR Occur! Will direct back to the same page in 5 seconds";
        header("refresh: 6; location: readComplaint.php");
    }
?>