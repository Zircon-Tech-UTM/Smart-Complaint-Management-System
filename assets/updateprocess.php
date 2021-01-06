<?php

    require_once("../dbconfig.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }

    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../login/login.php');
    }

    //Retrieve data from modify form
    $assetID = $_POST['assetID'];
    $nameBI = $_POST['nameBI'];
    $nameBM = $_POST['nameBM'];
    $category = $_POST['category'];
    $description = $_POST['description'];
    $cost = $_POST['cost'];
    $amount = $_POST['amount'];
    // $asset_condition = $_POST['asset_condition'];
    $date_purchased = $_POST['date_purchased'];

    //insert into database
    $sql = "UPDATE assets SET a_assetID='$assetID' ,a_nameBI='$nameBI',a_nameBM='$nameBM',a_category='$category' ,description='$description' ,cost='$cost' ,amount='$amount' ,date_purchased='$date_purchased' WHERE a_assetID= '$assetID'";


    $result = mysqli_query($conn, $sql);
    if($result)
    {
        header ("Location: main.php");
    }
    else
    {
        echo $conn->error;
        header('refresh: 5; location: main.php');
    }
    mysqli_close($conn);

?>
