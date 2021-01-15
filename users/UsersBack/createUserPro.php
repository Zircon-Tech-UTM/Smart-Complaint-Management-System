<?php

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
  $errMSG = "";

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
    elseif($_POST["password"]!=$_POST["confirm_password"])
    {
      $confirm_passwordErr = "Changes failed. Password is not matching with the left field.";
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

    $imgFile = $_FILES['image']['name'];
    $tmp_dir = $_FILES['image']['tmp_name'];
    $imgSize = $_FILES['image']['size'];


    $upload_dir = 'images/'; // upload directory

    $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension

    // valid image extensions
    $valid_extensions = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    
    // rename uploading image
    $pic = rand(1000,1000000).".".$imgExt;

    $path = $upload_dir.$pic;

    // allow valid image file formats
    if(in_array($imgExt, $valid_extensions)){   
        // Check file size '5MB'
        if($imgSize > 5000000){
            $errMSG = "Sorry, your file is too large.";
        }
    }
    else{
        $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
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


      
          date_default_timezone_set("Asia/Kuala_Lumpur");
          $rdate= date('Y-m-d H:i:s');  

          $path = $path;

        $sql = "INSERT INTO users (u_userIC, pwd, name, postBI, postBM, address, email, contact, userType, dateRegistered, u_grade, u_img_path ) VALUES('".$IC."', '".$password."','".$username."','".$positionBI."', '".$positionBM."',' ".$addr."', '".$email."','".$contact."', '".$userType."', '".$rdate."', '".$grades."', '".$path."')";

        
          $result = mysqli_query($conn, $sql);

          if($result)
          {
              move_uploaded_file($tmp_dir, $upload_dir.$pic);
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
?>