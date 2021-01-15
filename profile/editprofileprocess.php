<?php

    $password = "";
    $confirm_password = "";
    $addr = "";
    $contact = "";
    $email= "";

    $passwordErr = "";
    $confirm_passwordErr = "";
    $addrErr = "";
    $contactErr = "";
    $emailErr= "";
    $sqlErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {

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
        if ($_FILES['image']['name'] == "")
        $errMSG = "No images."; 

        if(empty($emailErr)&&empty($contactErr)&&empty($passwordErr)
                &&empty($confirm_passwordErr)&&empty($addrErr))
        {
            
            if ($imgExt== "")
                $sql = "UPDATE users
                    SET  pwd='".$password."',address='".$addr."', email='".$email."', contact= '".$contact."'
                    WHERE u_userIC='".$_SESSION["ic"]."'";
            else
                $sql = "UPDATE users
                    SET  pwd='".$password."',address='".$addr."', email='".$email."', contact= '".$contact."', u_img_path = '".$path."'
                    WHERE u_userIC='".$_SESSION["ic"]."'";
            
            $result = mysqli_query($conn, $sql);

            echo $sql;

            if($result)
            {
                move_uploaded_file($tmp_dir, "../users/".$upload_dir.$pic);
                unlink($_SESSION["remove"]);

                if ($_SESSION['userType'] == '2')
                    header("location: ../B.php");
                else if ($_SESSION['userType'] == '3')
                    header("location: ../C.php");
                else    
                    header("location: ../D.php");
            } 
            else
            {
                $sqlErr = $conn->error;
            }

            mysqli_close($conn);

        }
    }
?>