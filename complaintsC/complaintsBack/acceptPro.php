<?php
    require_once("../../dbconfig.php");
    date_default_timezone_set("Asia/Kuala_Lumpur");

    $date = date('Y-m-d h:i:s', time());
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../../login/login.php');
    }

    if (isset($_GET['comp_id'])){
        echo $_GET['comp_id'];
        $comp_id = $_GET['comp_id'];

        $sql = "UPDATE complaints SET followedBy = '".$_SESSION['ic']."', c_status=2, setledDate='$date' WHERE compID = '".$comp_id."';";

        $result = mysqli_query($conn, $sql);

        if($result){
            header("location: ../allComplaints.php");
            exit();
        } else{
            echo "ERROR: $conn->error";
        }
    }

?>