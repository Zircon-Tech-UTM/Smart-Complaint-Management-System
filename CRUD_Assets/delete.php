<?php

include ('db_connect.php');

if(isset($_GET['assetID']))
{
    $assetID = $_GET['assetID'];
}

$sql =  "DELETE FROM assets WHERE assetID=$assetID";
$result = mysqli_query($conn, $sql);

if($result)
{
    header ("Location: main.php");
}
else
{
    echo $conn->error;
}

mysqli_close($conn);

?>
