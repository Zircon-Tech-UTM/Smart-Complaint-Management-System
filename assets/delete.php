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
