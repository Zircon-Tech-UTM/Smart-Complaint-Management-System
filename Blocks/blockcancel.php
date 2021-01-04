<?php

    include ('dbconnect.php');

    if(isset($_GET['id']))
    {
        $bid = $_GET['id'];
    }

    $sql = "DELETE FROM blocks
            WHERE block_no = '$bid'";
    $result = mysqli_query($conn, $sql);

    if($result)
    {
        header ("Location: blocklist.php");
    }
    else
    {
        echo $conn->error;
    }

    mysqli_close($conn);

?>