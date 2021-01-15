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
          $passwordErr = "Current pasword is required.";     
      } 
      elseif(strlen(trim($_POST["password"])) < 4)
      {
          $passwordErr = "Password must have at least 4 characters.";
      } 
      else
      {
          $password = trim($_POST["password"]);
      }


      if(empty(trim($_POST["newpassword"])))
      {
          $newpasswordErr = "Pasword is required.";     
      } 
      elseif(strlen(trim($_POST["newpassword"])) < 4)
      {
          $newpasswordErr = "Password must have at least 4 characters.";
      } 
      else
      {
          $newpassword = trim($_POST["newpassword"]);
      }



      if(empty(trim($_POST["confirm_password"])))
      {
          $confirm_passwordErr = "Please confirm password.";     
      } 
      elseif(strlen(trim($_POST["confirm_password"])) < 4)
      {
          $confirm_passwordErr = "Password must have at least 4 characters.";
      } 
      elseif($_POST["newpassword"]!=$_POST["confirm_password"])
      {
           $confirm_passwordErr = "Changes failed. Password is not matching.";
      }
      else
      {
          $confirm_password = trim($_POST["confirm_password"]);
      }



      if(empty($passwordErr)&&empty($confirm_passwordErr)&&empty($newpasswordErr)&&(password_verify($password, $row['pwd'])||($password == $row['pwd'])))
      {
        $IC = $_POST['ic'];
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
              header("location: ../index.php");
            }
            else                    //OtherUsers
            {
              header("location: ../indexB.php");
            }
        } 
        else
        {
            echo "ERROR: $conn->error";
        }

        mysqli_close($conn);
      }
    }
?>