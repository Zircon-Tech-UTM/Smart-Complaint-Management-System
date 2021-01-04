<?php
    include ('dbconnect.php');

    $b_block_no = $_POST['block_no'];
    $b_nameBI = $_POST['nameBI'];
    $b_nameBM = $_POST['nameBM'];
    $b_loc = $_POST['loc'];

    $sql = "INSERT INTO blocks(block_no, b_nameBI, b_nameBM, location)
            VALUES ('$b_block_no', '$b_nameBI', '$b_nameBM', '$b_loc')";
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
?>