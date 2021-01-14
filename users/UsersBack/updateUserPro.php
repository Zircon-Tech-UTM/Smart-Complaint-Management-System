<?php
    // include("../../dbconfig.php");
    // if(!session_id())//if session_id is not found
    // {
    //     session_start();
    // }
    
    // if(isset($_SESSION['ic']) != session_id() )
    // {
    //     header('location: ../../login/login.php');
    // }
// if(isset($_GET['id']))
// {
//     $id = $_GET['id'];
//     $sql = "SELECT * FROM users WHERE u_userIC=".$id.";";

//     $result = mysqli_query($conn, $sql);

//     if (!$result){echo "ERROR:  $conn->error";
//         header("refresh: 6; location: readUser.php");
//     } 

//     $row = mysqli_fetch_array($result);
    
    
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
        $usernameErr = "Changes failed. Name is required";
      } 
      elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])) 
      {
        $usernameErr = "Changes failed. Only letters and white space allowed";
      }
      else
      {
        $username = trim($_POST["name"]);
      }


      if (empty(trim(($_POST["IC"])))) 
      {
        $ICErr = "Changes failed. IC number is required";
      } 
      elseif (!preg_match('/^[0-9]{12}$/',$_POST["IC"])) 
      {
        $ICErr = "Changes failed. Please enter 12 digit without - ";
      }
      else
      {
        $IC = trim($_POST["IC"]);
      }


      if(empty(trim($_POST["password"])))
      {
          $passwordErr = "Changes failed. Pasword is required.";     
      } 
      elseif(strlen(trim($_POST["password"])) < 4)
      {
          $passwordErr = "Changes failed. Password must have at least 4 characters.";
      } 
      else
      {
          $password = trim($_POST["password"]);
      }


      if(empty(trim($_POST["confirm_password"])))
      {
          $confirm_passwordErr = "Changes failed. Please confirm password.";     
      } 
      elseif(strlen(trim($_POST["confirm_password"])) < 4)
      {
          $confirm_passwordErr = "Changes failed. Password must have at least 4 characters.";
      } 
      elseif($_POST["password"]!=$_POST["confirm_password"])
      {
           $confirm_passwordErr = "Changes failed. Password is not matching with the left field.";
      }
      else
      {
          $confirm_password = trim($_POST["confirm_password"]);
      }



      // $pos1="Admin";
      // $pos2="PIC";
      // $pos3="Assistant";

      if (empty(($_POST["position"]))) 
      {
        $positionBIErr = "Changes failed. Position is required.";
      } 
      // elseif ((strpos($_POST["position"], $pos1)!=false)||(strpos($_POST["position"], $pos2)!=false)||(strpos($_POST["position"], $pos3)!=false)) 
      // {
      //   $positionBIErr = "Please choose a position";
      // }
      else
      {
        $positionBI = $_POST["position"];
      }


      if (empty(($_POST["grades"]))) 
      {
        $gradesErr = "Changes failed. Grade is required.";
      } 
      // elseif(preg_match('/[A-Za-z].*[0-9]/', $_POST["grades"]))
      // {
      //   $grades=$_POST["grades"];
      // }
      else
      {
        $grades=$_POST["grades"];
      }



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
        $contactErr = "Please enter correct format in digit without -";
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


              
                  // date_default_timezone_set("Asia/Kuala_Lumpur");
                  // $rdate= date('Y-m-d H:i:s');  

                  $sql = "UPDATE users
                    SET  u_userIC='".$IC."' ,pwd='".$password."', name='".$username."', postBI='".$positionBI."',postBM='".$positionBM."', address='".$addr."', email='".$email."', contact= '".$contact."',  userType='".$userType."',  u_grade='".$grades."' 
                    WHERE u_userIC='".$id."';";

                 
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
// }
?>


    


