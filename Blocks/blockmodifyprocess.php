<?php

    include ('dbconnect.php');

    //Retrieve data from modify form
    $b_block_no = $_POST["block"];
    $b_nameBI = $_POST["nameBI"];
    $b_nameBM = $_POST["nameBM"];
    $b_loc = $_POST["loc"];

    //insert into database
    $sql = "UPDATE blocks
            SET b_nameBI = '$b_nameBI', b_nameBM = '$b_nameBM', location = '$b_loc'
            WHERE block_no = '$b_block_no'";

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