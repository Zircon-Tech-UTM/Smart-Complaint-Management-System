<?php
    // if(!session_id())//if session_id is not found
    // {
    //     session_start();
    // }
    
    // if(isset($_SESSION['ic']) != session_id() )
    // {
    //     header('location: ../login/login.php');
    // }
    // include("../dbconfig.php");

    // $password = "";
    // $confirm_password = "";
    $addr = "";
    $contact = "";
    $email= "";

    // $passwordErr = "";
    // $confirm_passwordErr = "";
    $addrErr = "";
    $contactErr = "";
    $emailErr= "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {

      // if(empty(trim($_POST["password"])))
      // {
      //     $passwordErr = "Changes failed. Pasword is required.";     
      // } 
      // elseif(strlen(trim($_POST["password"])) < 4)
      // {
      //     $passwordErr = "Changes failed. Password must have at least 4 characters.";
      // } 
      // else
      // {
      //     $password = trim($_POST["password"]);
      // }



      // if(empty(trim($_POST["confirm_password"])))
      // {
      //     $confirm_passwordErr = "Changes failed. Please confirm password.";     
      // } 
      // elseif(strlen(trim($_POST["confirm_password"])) < 4)
      // {
      //     $confirm_passwordErr = "Changes failed. Password must have at least 4 characters.";
      // } 
      // elseif($_POST["password"]!=$_POST["confirm_password"])
      // {
      //      $confirm_passwordErr = "Changes failed. Password is not matching with the left field.";
      // }
      // else
      // {
      //     $confirm_password = trim($_POST["confirm_password"]);
      // }


      if (empty(trim(($_POST["faddr"])))) 
      {
        $addrErr = "Changes failed. Address is required";
      } 
      else
      {
        $addr = trim($_POST["faddr"]);
      }


      if (empty($_POST["fcontactnum"])) 
      {
        $contactErr = "Changes failed. Contact number is required";
      } 
      elseif (!preg_match('/^[0-9]{10,11}$/',$_POST["fcontactnum"])) 
      {
        $contactErr = "Changes failed. Please enter correct format in digit without - and without +60 ";
      }
      else
      {
        $contact = trim($_POST["fcontactnum"]);
      }


      if (empty(trim(($_POST["femail"])))) 
      {
        $emailErr = "Changes failed. Email is required";
      } 
      elseif (!filter_var($_POST["femail"], FILTER_VALIDATE_EMAIL)) 
      {
        $emailErr = "Changes failed. Invalid email format";
      }
      else
      {
        $email = trim($_POST["femail"]);
      }

      if(empty($emailErr)&&empty($contactErr)&&empty($addrErr))
      {
        $sql = "UPDATE users
            SET  address='".$addr."', email='".$email."', contact= '".$contact."'
            WHERE u_userIC=".$id."";

        echo '\n';
        echo $sql;
        echo '\n';
        
        $result = mysqli_query($conn, $sql);


        if($result)
        {
            header("location: ../indexB.php");
        } 
        else
        {
            echo "ERROR: $conn->error";
        }

        mysqli_close($conn);

      }
}

?>