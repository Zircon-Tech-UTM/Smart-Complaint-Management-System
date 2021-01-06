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

    $name = $date = $building = $location = $damage = $detail = $id = "";
    // $image = "";


    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["id"])){
            $u_userIC = trim($_POST['u_userIC']);
            $date = $_POST['date'];
            $blocks = $_POST['blocks'];
            $rooms = $_POST['rooms'];
            $assets = $_POST['assets'];
            // $image = $_POST['image'];
            $detail = trim($_POST['detail']);

            $id = $_POST["id"];

            $sql = "UPDATE complaints SET c_assetID='$assets', c_roomID='$rooms', proposedDate='$date', detail='$detail' WHERE compID='$id';";

            echo $sql;

            $result = mysqli_query($conn, $sql);

            if($result){
                header("location: ../landing.php");
                exit();
            } else{
                echo "ERROR: $conn->error";
            }

        }else {
            echo "Some Kind of Error occurs!";
            header("Refresh: 5; location: ../modifyComplaint.php");
        }
    }
    mysqli_close($conn);
?>