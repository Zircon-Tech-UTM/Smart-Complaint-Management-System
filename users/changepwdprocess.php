<?php
    
    $IC = "";
    $password = "";
    $newpassword = "";
    $confirm_password = "";

    $ICErr = "";
    $passwordErr = "";
    $newpasswordErr = "";
    $confirm_passwordErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      if(empty(trim($_POST["password"])))
      {
          $passwordErr = $language['Current pasword is required'];   
      } 
      elseif(strlen(trim($_POST["password"])) < 4)
      {
          $passwordErr = $language['Password must have at least 4 characters'];
      } 
      else
      {
          $password = trim($_POST["password"]);
      }


      if(empty(trim($_POST["newpassword"])))
      {
          $newpasswordErr = $language['Pasword is required.'];   
      } 
      elseif(strlen(trim($_POST["newpassword"])) < 4)
      {
          $newpasswordErr = $language['Password must have at least 4 characters'];
      } 
      else
      {
          $newpassword = trim($_POST["newpassword"]);
      }



      if(empty(trim($_POST["confirm_password"])))
      {
          $confirm_passwordErr = $language['Please confirm password'];
      }
      elseif(strlen(trim($_POST["confirm_password"])) < 4)
      {
          $confirm_passwordErr = $language['Password must have at least 4 characters'];
      } 
      elseif($_POST["newpassword"]!=$_POST["confirm_password"])
      {
           $confirm_passwordErr = $language['Changes failed. Password is not matching'];
      }
      else
      {
          $confirm_password = trim($_POST["confirm_password"]);
      }

      $IC = $_POST['ic'];

      if (!password_verify($password, $row['pwd'])) 
      {
        echo '<script>alert("Current password incorrect. Try again.")</script>';
      }

      if(empty($passwordErr)&&empty($confirm_passwordErr)&&empty($newpasswordErr)&&((password_verify($password, $row['pwd']))||$password== $row['pwd']))
      {
        
        $hashed_password = password_hash($newpassword, PASSWORD_DEFAULT);

        $sql = "UPDATE users
                SET  pwd='".$hashed_password."'
                WHERE u_userIC=".$IC."";

        echo '\n';
        echo $sql;
        echo '\n';
        
        $result = mysqli_query($conn, $sql);

        if($result)
        {
            if($row['userType']=='1') //Admin
            {
              header("location: ../A.php");
            }
            else if ($row['userType']=='2')        //OtherUsers
            {
              header("location: ../B.php");
            }
            else if ($row['userType']=='3')
            {
              header("location: ../C.php");
            }else{
              header("location: ../D.php");
            }
        } 
        else
        {
            echo "ERROR: $conn->error";
        }

        mysqli_close($conn);
      }
      else
      {
          echo '<script>alert("Error occurs. Try again.")</script>';
      }

    }
?>