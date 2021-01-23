<?php

    $gradeID= "";
    $positionBI = "";
    $positionBM = "";
    
    $gradeIDErr= "";
    $positionBIErr = "";
    $positionBMErr = "";
    $sqlErr = "";
    

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

  if (empty(trim(($_POST["gradeID"])))) 
  {
    $gradeIDErr = $language['Grade ID is required'];
  } 
  else
  {
    $gradeID = trim($_POST["gradeID"]);
  }


  if (empty(trim(($_POST["positionBI"])))) 
  {
    $positionBIErr = $language['Position in English is required'];
  } 
  else
  {
    $positionBI = trim($_POST["positionBI"]);
  }


  if (empty(trim(($_POST["positionBM"])))) 
  {
    $positionBMErr = $language['Position in Malay is required'];
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
              $sqlErr = $conn->error;
          }

          // mysqli_close($conn);
    }
}

?>


    
    