<?php

    $gradeID= "";
    $positionBI = "";
    $positionBM = "";
    
    $gradeIDErr= "";
    $positionBIErr = "";
    $positionBMErr = "";
    

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

  if (empty(trim(($_POST["gradeID"])))) 
  {
    $gradeIDErr = "Changes failed. Grade ID is required";
  } 
  elseif (!preg_match("/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/",$_POST["gradeID"])) 
  {
    $gradeIDErr = "Changes failed. Only letters, number and white space are allowed";
  }
  else
  {
    $gradeID = trim($_POST["gradeID"]);
  }


  if (empty(trim(($_POST["positionBI"])))) 
  {
    $positionBIErr = "Changes failed. Position in English is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["positionBI"])) 
  {
    $positionBIErr = "Changes failed. Only letters and white space allowed";
  }
  else
  {
    $positionBI = trim($_POST["positionBI"]);
  }


  if (empty(trim(($_POST["positionBM"])))) 
  {
    $positionBMErr = "Changes failed. Position in Malay is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["positionBM"])) 
  {
    $positionBMErr = "Changes failed. Only letters and white space allowed";
  }
  else
  {
    $positionBM = trim($_POST["positionBM"]);
  }

    if(empty($gradeIDErr)&&empty($positionBIErr)&&empty($positionBMErr))
    {
         $sql = "UPDATE grades
                  SET g_gradeID='".$gradeID."', g_postBI='".$positionBI."', g_postBM= '".$positionBM."'
                  WHERE g_gradeID='".$id."';";
         
          $result = mysqli_query($conn, $sql);

          if($result)
          {
              header("location: readGrade.php");
              exit();
          } 
          else
          {
              echo "ERROR: $conn->error";
          }

          mysqli_close($conn);
    }
}


//}
?>


    
    