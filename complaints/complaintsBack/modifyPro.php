<?php
    require_once("dbconfig.php");

    $name = $date = $building = $location = $damage = $detail = $id = "";
    // $image = "";
    $total = 0;


    if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if (isset($_POST["id"])){
            $name = trim($_POST['name']);
            $pdate = $_POST['pdate'];
            $sdate = $_POST['sdate'];
            $building = $_POST['building'];
            $location = $_POST['location'];
            $damage = $_POST['damage'];
            // $image = $_POST['image'];
            $detail = trim($_POST['detail']);
            $total = $_POST['total'];
            $status = $_POST['status'];

            $id = $_POST["id"];

            $sql = "UPDATE complaints SET buildingID=$building, roomID=$location, pDate='$pdate', sDate='$sdate', damage=$damage, detail='$detail', total=$total, status=$status WHERE complaintsID=$id;";

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