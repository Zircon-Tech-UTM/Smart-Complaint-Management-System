<?php 
	session_start();
	
	include 'db_connect.php';

	// initialize variables
	$assetID = "";
	$nameBI = "";
	$nameBM = "";
	$category = "";
	$description = "";
	$cost = "";
	$amount = "";
	$asset_condition = "";
	$date_purchased = "";
	$id = 0;
	$update = false;

	if (isset($_POST['save'])) {
		header('location : creatAsset.php');
		$assetID = $_POST['assetID'];
		$nameBI = $_POST['nameBI'];
		$nameBM = $_POST['nameBM'];
		$category = $_POST['category'];
		$description = $_POST['description'];
		$cost = $_POST['cost'];
		$amount = $_POST['amount'];
		$asset_condition = $_POST['asset_condition'];
		$date_purchased = $_POST['date_purchased'];

		mysqli_query($conn, "INSERT INTO assets(assetID,nameBI,nameBM,category,description,cost,amount,asset_condition,date_purchased) VALUES('$assetID' ,'$nameBI','$nameBM','$category' ,'$description' ,'$cost' ,'$amount','$asset_condition' ,'$date_purchased')");
		$_SESSION['message'] = "Record saved"; 
		header('location: updateAsset.php');
	
	}

if (isset($_POST['update'])) {
		$assetID = $_POST['assetID'];
		$nameBI = $_POST['nameBI'];
		$nameBM = $_POST['nameBM'];
		$category = $_POST['category'];
		$description = $_POST['description'];
		$cost = $_POST['cost'];
		$amount = $_POST['amount'];
		$asset_condition = $_POST['asset_condition'];
		$date_purchased = $_POST['date_purchased'];

	mysqli_query($conn, "UPDATE assets SET assetID='$assetID' ,nameBI='$nameBI',nameBM='$nameBM',category='$category' ,description='$description' ,cost='$cost' ,amount='$amount',asset_condition='$asset_condition' ,date_purchased='$date_purchased' WHERE assetID=$assetID");
	$_SESSION['message'] = "Asset updated!"; 
	header('location: updateAsset.php');
}

if (isset($_GET['del'])) {
	$assetID = $_GET['del'];
	mysqli_query($conn, "DELETE FROM assets WHERE assetID=$assetID");
	$_SESSION['message'] = "Asset deleted!"; 
	header('location: updateAsset.php');
}
