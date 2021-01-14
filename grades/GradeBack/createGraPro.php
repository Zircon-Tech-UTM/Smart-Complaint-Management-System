
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
    $gradeIDErr = "Grade ID is required";
  } 
  elseif (!preg_match("/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/",$_POST["gradeID"])) 
  {
    $gradeIDErr = "Only letters, number and white space are allowed";
  }
  else
  {
    $gradeID = trim($_POST["gradeID"]);
  }


  if (empty(trim(($_POST["positionBI"])))) 
  {
    $positionBIErr = "Position in English is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["positionBI"])) 
  {
    $positionBIErr = "Only letters and white space allowed";
  }
  else
  {
    $positionBI = trim($_POST["positionBI"]);
  }


  if (empty(trim(($_POST["positionBM"])))) 
  {
    $positionBMErr = "Position in Malay is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["positionBM"])) 
  {
    $positionBMErr = "Only letters and white space allowed";
  }
  else
  {
    $positionBM = trim($_POST["positionBM"]);
  }

    if(empty($gradeIDErr)&&empty($positionBIErr)&&empty($positionBMErr))
    {
        
         $sql = "INSERT INTO grades (g_gradeID, g_postBI, g_postBM) VALUES('".$gradeID."', '".$positionBI."','".$positionBM."')";

         
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

?>


    
    