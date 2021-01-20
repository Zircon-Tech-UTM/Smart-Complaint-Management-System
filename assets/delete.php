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

    if (($_SESSION["userType"] != '1') and ($_SESSION["userType"] != '2')){
        echo $_SESSION["userType"];
        exit();
    }

    if(isset($_GET['assetID']))
    {
        $assetID = $_GET['assetID'];
    }

    $sql = "SELECT * FROM assets
    WHERE a_assetID = '$assetID'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

    unlink($row["a_img_path"]);

    $sql =  "DELETE FROM assets WHERE a_assetID='$assetID'";
    $result = mysqli_query($conn, $sql);

    if($result)
    {
        ($_SESSION['userType'] == '2')? (header ("location: mainB.php")) : (header ("location: mainA.php?block=$block"));
    }
    else
    {
        echo $conn->error;
    }

    mysqli_close($conn);

?>
