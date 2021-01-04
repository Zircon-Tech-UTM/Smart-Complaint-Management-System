<?php

include ('dbconnect.php');

if(isset($_GET['id']))
{
    $rid = $_GET['id'];
}

$sql = "DELETE FROM rooms
        WHERE r_roomID = '$rid'";
$result = mysqli_query($conn, $sql);

if($result)
{
    header ("Location: roomlist.php");
}
else
{
    echo $conn->error;
}

mysqli_close($conn);

?>