<?php 
	// require_once("../dbconfig.php");
	// if(!session_id())//if session_id is not found
	// {
	// 	session_start();
	// }
	
	// if(isset($_SESSION['u_userIC']) != session_id() )
	// {
	// 	header('location: ../login/login.php');
	// }

	// $description = $_POST['description'];
	// $asset_condition = $_POST['asset_condition'];
	//$img_path = $_POST['img_path'];

	$assetID = "";
    $nameBI = "";
    $nameBM = "";
    $category = "";
    $cost = "";
    $amount = "";
    $date_purchased = "";
    

    $assetIDErr = "";
    $nameBIErr = "";
    $nameBMErr = "";
    $categoryErr = "";
    $costErr = "";
    $amountErr = "";
    $date_purchasedErr = "";
    

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{



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

	if(empty($assetIDErr)&&empty($nameBIErr)&&empty($nameBMErr)&&empty($categoryErr)&&empty($descriptionErr)&&empty($costErr)&&empty($amountErr)&&empty($asset_conditionErr)&&empty($date_purchasedErr) ){
		
		
		$SELECT = "SELECT a_assetID FROM assets WHERE a_assetID = ? Limit 1";
		$INSERT = "INSERT assets(a_assetID,a_nameBI,a_nameBM,a_category,description,cost,amount,date_purchased) VALUES(?,?,?,?,?,?,?,?)";
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
			$stmt->bind_param('sssssiis',$assetID,$nameBI,$nameBM,$category,$description,$cost,$amount,$date_purchased);
			$stmt->execute();
			echo "New Record inserted successfully";
			header('location: main.php');

		}else {
			echo "The asset id already available";
			header('refresh: 5; location: main.php');
		}
		$stmt->close();
		$conn->close();
	} 
}

 ?>
