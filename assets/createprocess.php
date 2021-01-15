<?php 
	$assetID = "";
	$nameBI = "";
	$nameBM = "";
	$category = "";
	$cost = "";
	$amount = "";
	$date_purchased = "";
	$room = "";


	$assetIDErr = "";
	$nameBIErr = "";
	$nameBMErr = "";
	$categoryErr = "";
	$costErr = "";
	$amountErr = "";
	$date_purchasedErr = "";
	$errMSG = "";
	$roomErr = "";


	if ($_SERVER["REQUEST_METHOD"] == "POST") 
	{
		$block = $_POST['blocks'];
		$description=$_POST["description"];

		if (empty(trim(($_POST["assetID"])))) 
		{
		$assetIDErr = "Asset ID is required";
		} 
		elseif (!preg_match("/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/",$_POST["assetID"])) 
		{
		$assetIDErr = "Only letters, number and white space are allowed";
		}
		else
		{
		$assetID = trim($_POST["assetID"]);
		}




		if (empty(trim(($_POST["nameBI"])))) 
		{
		$nameBIErr = "English asset name is required";
		} 
		elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nameBI"])) 
		{
		$nameBIErr = "Only letters and white space allowed";
		}
		else
		{
		$nameBI = trim($_POST["nameBI"]);
		}




		if (empty(trim(($_POST["nameBM"])))) 
		{
		$nameBMErr = "Malay asset name is required";
		} 
		elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nameBM"])) 
		{
		$nameBMErr = "Only letters and white space allowed";
		}
		else
		{
		$nameBM = trim($_POST["nameBM"]);
		}




		if (!isset($_POST['category']))
		{
		$categoryErr = "Choose a category.";
		} 
		else
		{
		$category = $_POST["category"];
		}



		if (empty(trim(($_POST["cost"])))) 
		{
		$costErr = "Cost is required";
		} 
		elseif (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $_POST["cost"])) 
		{
		$costErr = "Please enter valid cost.";
		}
		else
		{
		$cost = trim($_POST["cost"]);
		}



		if (empty(trim(($_POST["amount"])))) 
		{
		$amountErr = "Amount is required";
		} 
		elseif (!preg_match("/^[0-9]+$/", $_POST["amount"])) 
		{
		$amountErr = "Please enter valid amount.";
		}
		else
		{
		$amount = trim($_POST["amount"]);
		}



		if (empty(($_POST["date_purchased"]))) 
		{
		$date_purchasedErr = "Choose a date.";
		} 
		else
		{
		$date_purchased = $_POST["date_purchased"];
		}

		if (empty(($_POST["rooms"]))) 
		{
		$roomErr = "Choose a rooms.";
		} 
		else
		{
		$room = $_POST["rooms"];
		}


		$imgFile = $_FILES['image']['name'];
		$tmp_dir = $_FILES['image']['tmp_name'];
		$imgSize = $_FILES['image']['size'];


		$upload_dir = 'images/'; // upload directory

		$imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

		// valid image extensions
		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
		
		// rename uploading image
		$pic = rand(1000,1000000).".".$imgExt;
		
		$path = $upload_dir.$pic;

		// allow valid image file formats
		if(in_array($imgExt, $valid_extensions)){   
			// Check file size '5MB'
			if($imgSize > 5000000){
				$errMSG = "Sorry, your file is too large.";
			}
		}
		else{
			$errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
		}

		if(empty($assetIDErr)&&empty($nameBIErr)&&empty($nameBMErr)&&empty($categoryErr)&&empty($costErr)&&empty($amountErr)&&empty($asset_conditionErr)&&empty($date_purchasedErr) &&empty($roomErr) ){
			
			
			$SELECT = "SELECT a_assetID FROM assets WHERE a_assetID = ? Limit 1";
			$INSERT = "INSERT assets(a_assetID,a_nameBI,a_nameBM,a_category,description,cost,amount,date_purchased,a_roomID, a_img_path) VALUES(?,?,?,?,?,?,?,?,?,?)";
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
				$stmt->bind_param('sssssiisss',$assetID,$nameBI,$nameBM,$category,$description,$cost,$amount,$date_purchased, $room, $path);
				$stmt->execute();
				move_uploaded_file($tmp_dir, $upload_dir.$pic);
				// echo "New Record inserted successfully";
				($_SESSION['userType'] == '2')? (header ("location: mainB.php")) : (header ("location: mainA.php?block=$block"));

			}else {
				echo "The asset id already available";
				($_SESSION['userType'] == '2')? (header ("refresh: 5; location: mainB.php")) : (header ("refresh: 5; location: mainA.php?block=$block"));
			}
			$stmt->close();
			$conn->close();
		} 
	}

?>
