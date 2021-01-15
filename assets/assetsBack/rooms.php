<?php
    require_once("../../dbconfig.php");
    $blocks;

    if (isset($_GET['blocks'])){
        $blocks = $_GET['blocks'];
    }

    $sql = "SELECT * FROM rooms WHERE blok = '$blocks'";

    $result = mysqli_query($conn, $sql);

    $rooms = array();
    while($room = mysqli_fetch_assoc($result)){
        $rooms[] = $room;
    }

    echo json_encode($rooms);

?>