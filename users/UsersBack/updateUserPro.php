<?php
    $username = "";
    $IC = "";
    $positionBI = "";
    $positionBM = "";
    $userType = "";
    $grades= "";
    $addr="";
    $contact = "";
    $email= "";

    $usernameErr = "";
    $ICErr = "";
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
        $usernameErr = $language['Changes failed. Name is required'];
        } 
        elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["name"])) 
        {
        $usernameErr = $language['Changes failed. Only letters and white space allowed'];
        }
        else
        {
        $username = trim($_POST["name"]);
        }


        if (empty(trim(($_POST["IC"])))) 
        {
        $ICErr = $language['Changes failed. IC number is required'];
        } 
        elseif (!preg_match('/^[0-9]{12}$/',$_POST["IC"])) 
        {
        $ICErr = $language['Changes failed. Please enter 12 digit without - '];
        }
        else
        {
        $IC = trim($_POST["IC"]);
        }



        if (empty(($_POST["position"]))) 
        {
        $positionBIErr = $language['Changes failed. Position is required.'];
        } 
        else
        {
        $positionBI = $_POST["position"];
        }


        if (empty(($_POST["grades"]))) 
        {
        $gradesErr = $language['Changes failed. Grade is required.'];
        } 
        else
        {
        $grades=$_POST["grades"];
        }



        if (empty(trim(($_POST["faddr"])))) 
        {
        $addrErr = $language['Changes failed. Address is required.'];
        } 
        else
        {
        $addr = trim($_POST["faddr"]);
        }


        if (empty($_POST["fcontactnum"])) 
        {
        $contactErr = $language['Changes failed. Contact number is required.'];
        } 
        elseif (!preg_match('/^[0-9]{10,11}$/',$_POST["fcontactnum"])) 
        {
        $contactErr = $language['Changes failed. Please enter correct format in digit. For example 01XXXXXXXX'];
        }
        else
        {
        $contact = trim($_POST["fcontactnum"]);
        }


        if (empty(trim(($_POST["femail"])))) 
        {
        $emailErr = $language['Changes failed. Email is required'];
        } 
        elseif (!filter_var($_POST["femail"], FILTER_VALIDATE_EMAIL)) 
        {
        $emailErr = $language['Changes failed. Invalid email format'];
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

        if ($_FILES['image']['name'] == "")
            $errMSG =  $language['No images.']; 


        if(empty($usernameErr)&&empty($emailErr)&&empty($ICErr)&&empty($contactErr)&&empty($passwordErr)
            &&empty($confirm_passwordErr)&&empty($gradesErr)&&empty($positionBIErr)&&empty($addrErr))
        {
           if($positionBI=="Admin")
          {
              $userType="1";
              $positionBM="Pentadbir";
          }
          if($positionBI=="Pentadbir")
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

                date_default_timezone_set("Asia/Kuala_Lumpur");
                $rdate= date('Y-m-d H:i:s');  

                $path = $path;

                if ($imgExt== "")
                {
                    $sql = "UPDATE users
                        SET  u_userIC='".$IC."' ,name='".$username."', postBI='".$positionBI."',postBM='".$positionBM."', address='".$addr."', email='".$email."', contact= '".$contact."',  userType='".$userType."',  u_grade='".$grades."'
                        WHERE u_userIC='".$id."';";
                }
                else{
                    $sql = "UPDATE users
                        SET  u_userIC='".$IC."', name='".$username."', postBI='".$positionBI."',postBM='".$positionBM."', address='".$addr."', email='".$email."', contact= '".$contact."',  userType='".$userType."',  u_grade='".$grades."', u_img_path = '".$path."' 
                        WHERE u_userIC='".$id."';";
                }

                $result = mysqli_query($conn, $sql);
               
                if($result)
                {
                  if($imgExt)
                  {
                      unlink($_SESSION["remove"]);
                      move_uploaded_file($tmp_dir, $upload_dir.$pic);
                  }
                    header("location: readUser.php");
                    exit();
                } 
                else
                {
                    echo "ERROR: $conn->error";
                }
        }
    }
?>