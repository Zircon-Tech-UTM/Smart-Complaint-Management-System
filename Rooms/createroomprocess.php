<?php
    // require_once("../dbconfig.php");
    // if(!session_id())//if session_id is not found
    // {
    //     session_start();
    // }
    
    // if(isset($_SESSION['ic']) != session_id() )
    // {
    //     header('location: ../login/login.php');
    // }

    //Retrieving data from user input
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
    $r_nameBIErr = "English room name is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nameBI"])) 
  {
    $r_nameBIErr = "Only letters and white space allowed";
  }
  else
  {
    $r_nameBI = trim($_POST["nameBI"]);
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
  
  
 if(empty($r_roomIDErr)&&empty($r_nameBIErr)&&empty($r_nameBMErr)&&empty($r_PICErr)&&empty($r_blockErr))
 {
     //insert into database
    $sql = "INSERT INTO rooms(r_roomID, PIC, r_nameBI, r_nameBM, blok)
            VALUES ('$r_roomID', '$r_PIC', '$r_nameBI', '$r_nameBM', '$r_block')";

    $result = mysqli_query($conn, $sql);
    if($result)
    {
        header ("Location: roomlist.php");
    }
    else
    {
        echo $conn->error;
    }
    mysqli_close($conn);
 }
   
}
?>

<!-- Direct user to page that displaylist of rooms-->