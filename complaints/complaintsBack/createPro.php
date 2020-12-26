<?php
    require_once("dbconfig.php");

    $name = $date = $building = $location = $damage = $detail = "";
    // $image = "";
    $total = 0;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $name = trim($_POST['name']);
        $date = $_POST['date'];
        $building = $_POST['building'];
        $location = $_POST['location'];
        $damage = $_POST['damage'];
        // $image = $_POST['image'];
        $detail = trim($_POST['detail']);
        $total = $_POST['total'];

        $date = explode(" ", $date);
        echo $date[0];

        $sql = "INSERT INTO complaints(buildingID, roomID, pDate, damage, detail, total, status) VALUES(".$building.", ".$location.", '".$date[0]."', ".$damage.", '".$detail."', $total, '0');";

        echo '\n';
        echo $sql;
        echo '\n';
        
        $result = mysqli_query($conn, $sql);

        if($result){
            header("location: ../landing.php");
            exit();
        } else{
            echo "ERROR: $conn->error";
        }
    }

    mysqli_close($conn);
?>