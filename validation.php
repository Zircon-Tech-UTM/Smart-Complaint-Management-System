<?php
    // blocks
    $b_block_no = "";
    $b_nameBI = "";
    $b_nameBM = "";
    $b_loc = "";
    

    $b_block_noErr = "";
    $b_nameBIErr = "";
    $b_nameBMErr = "";
    $b_locErr = "";
    

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{



  if (empty(trim(($_POST["block_no"])))) 
  {
    $b_block_noErr = "Block ID is required";
  } 
  elseif (!preg_match("/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/",$_POST["block_no"])) 
  {
    $b_block_noErr = "Only letters, number and white space are allowed";
  }
  else
  {
    $b_block_no = trim($_POST["block_no"]);
  }




  if (empty(trim(($_POST["nameBI"])))) 
  {
    $b_nameBIErr = "English block name is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nameBI"])) 
  {
    $b_nameBIErr = "Only letters and white space allowed";
  }
  else
  {
    $b_nameBI = trim($_POST["nameBI"]);
  }




  if (empty(trim(($_POST["nameBM"])))) 
  {
    $b_nameBMErr = "Malay block name is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nameBM"])) 
  {
    $b_nameBMErr = "Only letters and white space allowed";
  }
  else
  {
    $b_nameBM = trim($_POST["nameBM"]);
  }

  


  if (empty(($_POST["loc"]))) 
  {
    $b_locErr = "Choose a location.";
  } 
  else
  {
    $b_loc = $_POST["loc"];
  }


  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  //rooms
    $r_roomID = "";
    $r_nameBI = "";
    $r_nameBM = "";
    $r_PIC = "";
    $r_block = "";
    

    $r_roomIDErr = "";
    $r_nameBIErr = "";
    $r_nameBMErr = "";
    $r_PICErr = "";
    $r_blockErr = "";
    

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{



  if (empty(trim(($_POST["roomID"])))) 
  {
    $r_roomIDErr = "Room ID is required";
  } 
  elseif (!preg_match("/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/",$_POST["roomID"])) 
  {
    $r_roomIDErr = "Only letters, number and white space are allowed";
  }
  else
  {
    $r_roomID = trim($_POST["roomID"]);
  }




  if (empty(trim(($_POST["nameBI"])))) 
  {
    $r_roomIDErr = "English room name is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nameBI"])) 
  {
    $r_roomIDErr = "Only letters and white space allowed";
  }
  else
  {
    $r_roomID = trim($_POST["nameBI"]);
  }




  if (empty(trim(($_POST["nameBM"])))) 
  {
    $r_nameBMErr = "Malay block name is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nameBM"])) 
  {
    $r_nameBMErr = "Only letters and white space allowed";
  }
  else
  {
    $r_nameBM = trim($_POST["nameBM"]);
  }

  


  if (empty(($_POST["PIC"]))) 
  {
    $r_PICErr = "Choose a name.";
  } 
  else
  {
    $r_PIC = $_POST["PIC"];
  }



  if (empty(($_POST["block"]))) 
  {
    $r_blockErr = "Choose a block.";
  } 
  else
  {
    $r_block = $_POST["block"];
  }
  



  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  //assets
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

  


  if (empty(($_POST["category"]))) 
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




  ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

  //complaints
    $u_userIC = "";
    $date = "";
    $blocks = "";
    $rooms = "";
    $assets = "";
    $detail = "";
    

    $u_userICErr = "";
    $dateErr = "";
    $blocksErr = "";
    $roomsErr = "";
    $assetsErr = "";
    $detailErr = "";
    

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{



  if (empty(trim(($_POST["u_userIC"])))) 
  {
    $u_userICErr = "IC number is required";
  } 
  elseif (!preg_match('/^[0-9]{12}$/',$_POST["u_userIC"])) 
  {
    $u_userICErr = "Please enter 12 digit without - ";
  }
  else
  {
    $u_userIC = trim($_POST["u_userIC"]);
  }




  if (empty(($_POST["date"]))) 
  {
    $dateErr = "Choose a date.";
  } 
  else
  {
    $date = $_POST["date"];
  }


  if (empty(($_POST["blocks"]))) 
  {
    $blocksErr = "Choose a block.";
  } 
  else
  {
    $blocks = $_POST["blocks"];
  }


  if (empty(($_POST["rooms"]))) 
  {
    $roomsErr = "Choose a room.";
  } 
  else
  {
    $rooms = $_POST["rooms"];
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

  


  if (empty(($_POST["assets"]))) 
  {
    $assetsErr = "Choose an asset.";
  } 
  else
  {
    $assets = $_POST["assets"];
  }


  if (empty(($_POST["detail"]))) 
  {
    $detailErr = "Detail is required.";
  } 
  else
  {
    $detail = $_POST["detail"];
  }
  


?>


    