<?php

    include ('db_connect.php');

    //Retrieve data from modify form
    $assetID = $_POST['assetID'];
    $nameBI = $_POST['nameBI'];
    $nameBM = $_POST['nameBM'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $amount = $_POST['amount'];
    $asset_condition = $_POST['asset_condition'];
    $date_purchased = $_POST['date_purchased'];

    //insert into database
$sql = "UPDATE assets SET assetID='$assetID' ,nameBI='$nameBI',nameBM='$nameBM',category='$category' ,description='$description' ,cost='$cost' ,amount='$amount',asset_condition='$asset_condition' ,date_purchased='$date_purchased' WHERE assetID= '$assetID'";


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
