<?php
    // include("../../dbconfig.php");
    // if(!session_id())//if session_id is not found
    // {
    //     session_start();
    // }
    
    // if(isset($_SESSION['ic']) != session_id() )
    // {
    //     header('location: ../login/login.php');
    // }
    // if(isset($_GET['id']))
    // {
    //     $id1 = $_GET['id'];
    //     $sql1 = "SELECT * FROM users WHERE u_userIC=".$id1.";";

    //     $result1 = mysqli_query($conn, $sql1);

    //     if (!$result1){echo "ERROR:  $conn->error";
    //         header("refresh: 6; location: readUser.php");
    //     } 

    //     $row1 = mysqli_fetch_array($result1);
    
    
    // define variables and set to empty values


    $username = "";
    $IC = "";
    $password = "";
    $confirm_password = "";
    $positionBI = "";
    $grades= "";
    $addr="";
    $contact = "";
    $email= "";

    $usernameErr = "";
    $ICErr = "";
    $passwordErr = "";
    $confirm_passwordErr = "";
    $positionBIErr = "";
    $gradesErr = "";
    $addrErr="";
    $contactErr = "";
    $emailErr= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{

  if (empty(trim(($_POST["name"])))) 
  {
    $usernameErr = "Name is required";
  } 
  elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])) 
  {
    $usernameErr = "Only letters and white space allowed";
  }
  else
  {
    $username = trim($_POST["name"]);
  }
  

  if (empty(trim(($_POST["IC"])))) 
  {
    $ICErr = "IC number is required";
  } 
  elseif (!preg_match('/^[0-9]{12}$/',$_POST["IC"])) 
  {
    $ICErr = "Please enter 12 digit without - ";
  }
  else
  {
    $IC = trim($_POST["IC"]);
  }

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


  if (empty(($_POST["position"]))) 
  {
    $positionBIErr = "Position is required.";
  } 
  else
  {
    $positionBI = $_POST["position"];
  }


  if (empty(($_POST["grades"]))) 
  {
    $gradesErr = "Grade is required.";
  } 
  else
  {
    $grades=$_POST["grades"];
  }
  


  if (empty(trim(($_POST["faddr"])))) 
  {
    $addrErr = "Address is required";
  } 
  else
  {
    $addr = trim($_POST["faddr"]);
  }


  if (empty($_POST["fcontactnum"])) 
  {
    $contactErr = "Contact number is required";
  } 
  elseif (!preg_match('/^[0-9]{10,11}$/',$_POST["fcontactnum"])) 
  {
    $contactErr = "Please enter correct format in digit without -";
  }
  else
  {
    $contact = trim($_POST["fcontactnum"]);
  }


  if (empty(trim(($_POST["femail"])))) 
  {
    $emailErr = "Email is required";
  } 
  elseif (!filter_var($_POST["femail"], FILTER_VALIDATE_EMAIL)) 
  {
    $emailErr = "Invalid email format";
  }
  else
  {
    $email = trim($_POST["femail"]);
  }


    if(empty($usernameErr)&&empty($emailErr)&&empty($ICErr)&&empty($contactErr)&&empty($passwordErr)
      &&empty($confirm_passwordErr)&&empty($gradesErr)&&empty($positionBIErr)&&empty($addrErr))
    {
          if($positionBI=="Admin")
          {
              $userType="1";
              $positionBM="Pentadbir";
          }
          else if($positionBI=="PIC Of Room")
          {
              $userType="2";
              $positionBM="PIC Makmal";
          }
          else if($positionBI=="Assistant Computer Technician")
          {
              $userType="3";
              $positionBM="Penolong Juruteknik Komputer";
          }
          else
          {
              $userType="4";
              $positionBM="Penolong Jurutera";
          }

          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      
          date_default_timezone_set("Asia/Kuala_Lumpur");
          $rdate= date('Y-m-d H:i:s');  

         $sql = "INSERT INTO users (u_userIC, pwd, name, postBI, postBM, address, email, contact, userType, dateRegistered, u_grade ) VALUES('".$IC."', '".$hashed_password."','".$username."','".$positionBI."', '".$positionBM."',' ".$addr."', '".$email."','".$contact."', '".$userType."', '".$rdate."', '".$grades."');";
              
          $result = mysqli_query($conn, $sql);

          if($result)
          {
              header("location: readUser.php");
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


    
    