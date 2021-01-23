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
    $gradeIDErr = $language['Changes failed. Grade ID is required'];
  } 
  else
  {
    $gradeID = trim($_POST["gradeID"]);
  }


  if (empty(trim(($_POST["positionBI"])))) 
  {
    $positionBIErr = $language['Changes failed. Position in English is required'];
  } 
  else
  {
    $positionBI = trim($_POST["positionBI"]);
  }


  if (empty(trim(($_POST["positionBM"])))) 
  {
    $positionBMErr = $language['Changes failed. Position in Malay is required'];
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
            $sqlErr = $conn->error;
          }

    }
}


//}
?>


    
    