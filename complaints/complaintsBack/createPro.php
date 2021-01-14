<?php
    // require_once("../../dbconfig.php");
    // if(!session_id())//if session_id is not found
    // {
    //     session_start();
    // }
    
    // if(isset($_SESSION['u_userIC']) != session_id() )
    // {
    //     header('location: ../../login/login.php');
    // }

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
        $u_userIC = trim($_POST['u_userIC']);

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
  

        // $image = $_POST['image'];
        // $total = $_POST['total'];

        if(empty($dateErr)&&empty($blocksErr)&&empty($roomsErr)&&empty($assetsErr)&&empty($detailErr))
        {
            $sql = "INSERT INTO complaints(c_userIC, c_assetID, c_roomID, c_status, proposedDate, detail) VALUES('".$u_userIC."', '".$assets."', '".$rooms."', '1', '".$date."', '".$detail."');";

            echo '\n';
            echo $sql;
            echo '\n';
            
            $result = mysqli_query($conn, $sql);

            if($result)
            {
                header("location: ../landing.php");
                exit();
            } 
            else
            {
                echo "ERROR: $conn->error";
            }
        }
        
    }

    mysqli_close($conn);

?>