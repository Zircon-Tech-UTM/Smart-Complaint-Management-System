
<?php include 'db_connect.php'; ?>
<?php 

$assetID = $_POST['assetID'];
$nameBI = $_POST['nameBI'];
$nameBM = $_POST['nameBM'];
$category = $_POST['category'];
$description = $_POST['description'];
$cost = $_POST['cost'];
$amount = $_POST['amount'];
$asset_condition = $_POST['asset_condition'];
$date_purchased = $_POST['date_purchased'];
//$img_path = $_POST['img_path'];



if(!empty($assetID) || !empty($nameBI) || !empty($nameBM) || !empty($category) || !empty($description) || !empty($cost) || !empty($amount) || !empty($asset_condition) || !empty($date_purchased) ){
	
	
	$SELECT = "SELECT assetID FROM assets WHERE assetID = ? Limit 1";
	$INSERT = "INSERT assets(assetID,nameBI,nameBM,category,description,cost,amount,asset_condition,date_purchased) VALUES(?,?,?,?,?,?,?,?,?)";
	//Prepare statement
	$stmt = $conn->prepare($SELECT);
	$stmt->bind_param("s",$assetID); // s- string
	$stmt->execute();
	$stmt->bind_result($assetID);
	$stmt->store_result();
	$rnum = $stmt->num_rows;

	if($rnum==0){
		$stmt->close();
		$stmt = $conn->prepare($INSERT);
		$stmt->bind_param('sssssiiss',$assetID,$nameBI,$nameBM,$category,$description,$cost,$amount,$asset_condition,$date_purchased);
		$stmt->execute();
		echo "New Record inserted successfully";

	}else {
		echo "The asset id already available";
	}
	$stmt->close();
	$conn->close();
} else{
	echo "All field are required";
	die();
}


 ?>
