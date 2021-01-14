<?php

    // require_once("../dbconfig.php");
    // if(!session_id())//if session_id is not found
    // {
    //     session_start();
    // }

    // if(isset($_SESSION['u_userIC']) != session_id() )
    // {
    //     header('location: ../login/login.php');
    // }

    //Retrieve data from modify form
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

  $description=$_POST["description"];

  if (empty(trim(($_POST["assetID"])))) 
  {
    $assetIDErr = "Changes Failed. Asset ID is required";
  } 
  elseif (!preg_match("/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/",$_POST["assetID"])) 
  {
    $assetIDErr = "Changes Failed. Only letters, number and white space are allowed";
  }
  else
  {
    $assetID = trim($_POST["assetID"]);
  }




  if (empty(trim(($_POST["nameBI"])))) 
  {
    $nameBIErr = "Changes Failed. English asset name is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nameBI"])) 
  {
    $nameBIErr = "Changes Failed. Only letters and white space allowed";
  }
  else
  {
    $nameBI = trim($_POST["nameBI"]);
  }




  if (empty(trim(($_POST["nameBM"])))) 
  {
    $nameBMErr = "Changes Failed. Malay asset name is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nameBM"])) 
  {
    $nameBMErr = "Changes Failed. Only letters and white space allowed";
  }
  else
  {
    $nameBM = trim($_POST["nameBM"]);
  }

  


  if (!isset($_POST['category']))
  {
    $categoryErr = "Changes Failed. Choose a category.";
  } 
  else
  {
    $category = $_POST["category"];
  }



  if (empty(trim(($_POST["cost"])))) 
  {
    $costErr = "Changes Failed. Cost is required";
  } 
  elseif (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $_POST["cost"])) 
  {
    $costErr = "Changes Failed. Please enter valid cost.";
  }
  else
  {
    $cost = trim($_POST["cost"]);
  }



  if (empty(trim(($_POST["amount"])))) 
  {
    $amountErr = "Changes Failed. Amount is required";
  } 
  elseif (!preg_match("/^[0-9]+$/", $_POST["amount"])) 
  {
    $amountErr = "Changes Failed. Please enter valid amount.";
  }
  else
  {
    $amount = trim($_POST["amount"]);
  }
  


  if (empty(($_POST["date_purchased"]))) 
  {
    $date_purchasedErr = "Changes Failed. Choose a date.";
  } 
  else
  {
    $date_purchased = $_POST["date_purchased"];
  }
    // $asset_condition = $_POST['asset_condition'];
   
    //insert into database
  if(empty($assetIDErr)&&empty($nameBIErr)&&empty($nameBMErr)&&empty($categoryErr)&&empty($costErr)&&empty($amountErr)&&empty($asset_conditionErr)&&empty($date_purchasedErr) )
  {
        $sql = "UPDATE assets SET a_assetID='$assetID' ,a_nameBI='$nameBI',a_nameBM='$nameBM',a_category='$category' ,description='$description' ,cost='$cost' ,amount='$amount' ,date_purchased='$date_purchased' WHERE a_assetID= '$assetID'";


        $result = mysqli_query($conn, $sql);
  }
    
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
}
?>
