<?php
    
    $IC = "";
    $password = "";
    $confirm_password = "";

    $ICErr = "";
    $passwordErr = "";
    $confirm_passwordErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
      if(empty(trim($_POST["password"])))
      {
          $passwordErr = "Pasword is required.";     
      } 
      elseif(strlen(trim($_POST["password"])) < 4)
      {
          $passwordErr = "Password must have at least 4 characters.";
      } 
      else
      {
          $password = trim($_POST["password"]);
      }


      if(empty(trim($_POST["confirm_password"])))
      {
          $confirm_passwordErr = "Please confirm password.";     
      } 
      elseif(strlen(trim($_POST["confirm_password"])) < 4)
      {
          $confirm_passwordErr = "Password must have at least 4 characters.";
      } 
      elseif($_POST["password"]!=$_POST["confirm_password"])
      {
           $confirm_passwordErr = "Changes failed. Password is not matching with the left field.";
      }
      else
      {
          $confirm_password = trim($_POST["confirm_password"]);
      }

      if(empty($passwordErr)&&empty($confirm_passwordErr))
      {
        $IC = $_POST['ic'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "UPDATE users
                SET  pwd='".$hashed_password."'
                WHERE u_userIC=".$IC."";

        echo $sql;
        
        $result = mysqli_query($conn, $sql);

        if($result)
        {
            header("location: login.php");
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