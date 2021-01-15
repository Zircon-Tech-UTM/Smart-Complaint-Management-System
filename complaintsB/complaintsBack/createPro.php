<?php
    require_once("../../dbconfig.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../../login/login.php');
    }

    $name = $date = $blocks = $rooms = $assets = $detail = "";
    // $image = "";

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $u_userIC = trim($_POST['u_userIC']);
        $date = $_POST['date'];
        $blocks = $_POST['blocks'];
        $rooms = $_POST['rooms'];
        $assets = $_POST['assets'];
        // $image = $_POST['image'];
        $detail = trim($_POST['detail']);
        // $total = $_POST['total'];


        $sql = "INSERT INTO complaints(c_userIC, c_assetID, c_roomID, c_status, proposedDate, detail) VALUES('".$u_userIC."', '".$assets."', '".$rooms."', '1', '".$date."', '".$detail."');";

        echo '\n';
        echo $sql;
        echo '\n';
        
        $result = mysqli_query($conn, $sql);

        if($result){
            header("location: ../readComplaint.php");
            exit();
        } else{
            echo "ERROR: $conn->error";
        }
    }

    mysqli_close($conn);
?>