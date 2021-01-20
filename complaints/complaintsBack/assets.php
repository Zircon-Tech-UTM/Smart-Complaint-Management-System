<?php
    require_once("../../dbconfig.php");
    $rooms;

    if (isset($_GET['rooms'])){
        $rooms = $_GET['rooms'];
    }

    $sql = "SELECT * FROM assets WHERE a_roomID = '$rooms'";

    $result = mysqli_query($conn, $sql);

    $assets = array();
    while($asset = mysqli_fetch_assoc($result)){
        $assets[] = $asset;
    }

    echo json_encode($assets);

?>