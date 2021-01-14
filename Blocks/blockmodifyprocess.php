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



  if (empty(trim(($_POST["block"])))) 
  {
    $b_block_noErr = "Changes Failed. Block ID is required";
  } 
  elseif (!preg_match("/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/",$_POST["block"])) 
  {
    $b_block_noErr = "Changes Failed. Only letters, number and white space are allowed";
  }
  else
  {
    $b_block_no = trim($_POST["block"]);
  }




  if (empty(trim(($_POST["nameBI"])))) 
  {
    $b_nameBIErr = "Changes Failed. English block name is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nameBI"])) 
  {
    $b_nameBIErr = "Changes Failed. Only letters and white space allowed";
  }
  else
  {
    $b_nameBI = trim($_POST["nameBI"]);
  }




  if (empty(trim(($_POST["nameBM"])))) 
  {
    $b_nameBMErr = "Changes Failed. Malay block name is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nameBM"])) 
  {
    $b_nameBMErr = "Changes Failed. Only letters and white space allowed";
  }
  else
  {
    $b_nameBM = trim($_POST["nameBM"]);
  }

  


  if (empty(($_POST["loc"]))) 
  {
    $b_locErr = "Changes Failed. Choose a location.";
  } 
  else
  {
    $b_loc = $_POST["loc"];
  }

    
    if(empty($b_block_noErr)&&empty($b_nameBIErr)&&empty($b_nameBMErr)&&empty($contactErr)&&empty($b_locErr))
    {
         $sql = "UPDATE blocks
            SET b_nameBI = '$b_nameBI', b_nameBM = '$b_nameBM', location = '$b_loc'
            WHERE block_no = '$b_block_no'";
        $result = mysqli_query($conn, $sql);
        if($result)
        {
            header ("Location: blocklist.php");
        }
        else
        {
            echo $conn->error;
        }
        mysqli_close($conn);
    }
}
 
?>