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
    $usernameErr = $language['Name is required'];
    } 
    elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])) 
    {
    $usernameErr = $language['Only letters and white space allowed'];
    }
    else
    {
    $username = trim($_POST["name"]);
    }


    if (empty(trim(($_POST["IC"])))) 
    {
    $ICErr = $language['IC number is required'];
    } 
    elseif (!preg_match('/^[0-9]{12}$/',$_POST["IC"])) 
    {
    $ICErr = $language['Please enter 12 digit without - '];
    }
    else
    {
    $IC = trim($_POST["IC"]);
    }

    if(empty(trim($_POST["password"])))
    {
      $passwordErr = $language['Pasword is required.'];     
    } 
    elseif(strlen(trim($_POST["password"])) < 4)
    {
      $passwordErr = $language['Password must have at least 4 characters.'];
    } 
    elseif($_POST["password"]!=$_POST["confirm_password"])
    {
      $confirm_passwordErr = $language['Password is not matching with the left field.'];
    }
    else
    {
      $password = trim($_POST["password"]);
    }


    if(empty(trim($_POST["confirm_password"])))
    {
      $confirm_passwordErr = $language['Please confirm password.'];     
    } 
    elseif(strlen(trim($_POST["confirm_password"])) < 4)
    {
      $confirm_passwordErr = $language['Password must have at least 4 characters.'];
    } 
    elseif($_POST["password"]!=$_POST["confirm_password"])
    {
      $confirm_passwordErr = $language['Password is not matching with the left field.'];
    }
    else
    {
      $confirm_password = trim($_POST["confirm_password"]);
    }


    if (empty(($_POST["position"]))) 
    {
    $positionBIErr = $language['Position is required.'];
    } 
    else
    {
    $positionBI = $_POST["position"];
    }


    if (empty(($_POST["grades"]))) 
    {
    $gradesErr = $language['Grade is required.'];
    } 
    else
    {
    $grades=$_POST["grades"];
    }



    if (empty(trim(($_POST["faddr"])))) 
    {
    $addrErr = $language['Address is required.'];
    } 
    else
    {
    $addr = trim($_POST["faddr"]);
    }


    if (empty($_POST["fcontactnum"])) 
    {
    $contactErr = $language['Contact number is required.'];
    } 
    elseif (!preg_match('/^[0-9]{10,11}$/',$_POST["fcontactnum"])) 
    {
    $contactErr = $language['Please enter correct format in digit. For example 01XXXXXXXX'];
    }
    else
    {
    $contact = trim($_POST["fcontactnum"]);
    }


    if (empty(trim(($_POST["femail"])))) 
    {
    $emailErr = $language['Email is required'];
    } 
    elseif (!filter_var($_POST["femail"], FILTER_VALIDATE_EMAIL)) 
    {
    $emailErr = $language['Invalid email format'];
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
            $errMSG = $language['Sorry, your file is too large.'];
        }
    }
    else{
        $errMSG = $language['Sorry, only JPG, JPEG, PNG & GIF files are allowed.'];  
    }


    if(empty($usernameErr)&&empty($emailErr)&&empty($ICErr)&&empty($contactErr)&&empty($passwordErr)
      &&empty($confirm_passwordErr)&&empty($gradesErr)&&empty($positionBIErr)&&empty($addrErr))
    {
          if($positionBI=="Admin")
          {
              $userType="1";
              $positionBM="Pentadbir";
          }
          elseif($positionBI=="Pentadbir")
          {
              $userType="1";
              $positionBM="Pentadbir";
              $positionBI="Admin";
          }
          else if($positionBI=="PIC Of Room")
          {
              $userType="2";
              $positionBM="PIC Makmal";
          }
          else if($positionBI=="PIC Makmal")
          {
              $userType="2";
              $positionBM="PIC Makmal";
              $positionBI="PIC Of Room";
          }
          else if($positionBI=="Assistant Computer Technician")
          {
              $userType="3";
              $positionBM="Penolong Juruteknik Komputer";
          }
          else if($positionBI=="Penolong Juruteknik Komputer")
          {
              $userType="3";
              $positionBM="Penolong Juruteknik Komputer";
              $positionBI="Assistant Computer Technician";
          }
          else if($positionBI=="Assistant Engineer")
          {
              $userType="4";
              $positionBM="Penolong Jurutera";
          }
          else if($positionBI=="Penolong Jurutera")
          {
              $userType="4";
              $positionBM="Penolong Jurutera";
              $positionBI="Assistant Engineer";
          }
          
          $hashed_password = password_hash($password, PASSWORD_DEFAULT);
      
          date_default_timezone_set("Asia/Kuala_Lumpur");
          $rdate= date('Y-m-d H:i:s');  

          $path = $path;

          if($imgExt)
          {
            $sql = "INSERT INTO users (u_userIC, pwd, name, postBI, postBM, address, email, contact, userType, dateRegistered, u_grade, u_img_path ) VALUES('".$IC."', '".$hashed_password."','".$username."','".$positionBI."', '".$positionBM."',' ".$addr."', '".$email."','".$contact."', '".$userType."', '".$rdate."', '".$grades."', '".$path."')";
          }
          else
          {
            $sql = "INSERT INTO users (u_userIC, pwd, name, postBI, postBM, address, email, contact, userType, dateRegistered, u_grade) VALUES('".$IC."', '".$hashed_password."','".$username."','".$positionBI."', '".$positionBM."',' ".$addr."', '".$email."','".$contact."', '".$userType."', '".$rdate."', '".$grades."')";
          }


          $result = mysqli_query($conn, $sql);

          if($result)
          {
              if($imgExt)
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