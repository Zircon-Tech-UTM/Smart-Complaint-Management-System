<?php
    $id = "";
    $sdate = "";
    $status = "";
    $action = "";
    $u_userIC = "";


    $sdateErr = "";
    $statusErr = "";
    $actionErr = "";
    $sqlErr = "";
    $errMSG = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $id = trim($_POST['id']);
        $u_userIC = trim($_POST['u_userIC']);

        if (empty(($_POST["sdate"]))) 
        {
            $sdateErr = "Choose a date.";
        } 
        else
        {
            $sdate = $_POST["sdate"];
        }


        if (empty(($_POST["status"]))) 
        {
            $statusErr = "Choose a status.";
        } 
        else
        {
            $status = $_POST["status"];
        }


        if ((empty($_POST["action"]))) 
        {
            $actionErr = "Please write down the action taken.";
        } 
        else
        {
            $action = $_POST["action"];
        }

        $imgFile = $_FILES['image']['name'];
        $tmp_dir = $_FILES['image']['tmp_name'];
        $imgSize = $_FILES['image']['size'];
    
    
        $upload_dir = 'images/'; // upload directory
    
        $imgExt = strtolower(pathinfo($imgFile, PATHINFO_EXTENSION)); // get image extension
    
        // valid image extensions
        $valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'pdf'); // valid extensions
        
        // rename uploading image
        $pic = rand(1000,1000000).".".$imgExt;
    
        // allow valid image file formats
        if(in_array($imgExt, $valid_extensions)){   
            // Check file size '5MB'
            if($imgSize > 5000000){
                $errMSG = "Sorry, your file is too large.";
            }
        }
        else{
            $errMSG = "Sorry, only JPG, JPEG, PNG, GIF, PDF files are allowed.";  
        }

        if(empty($sdateErr)&&empty($statusErr)&&empty($actionErr))
        {
            $path = $upload_dir.$pic;
            if ($imgExt== ""){
                $sql = "UPDATE complaints SET setledDate='$sdate', c_status='$status', action_desc='$action' WHERE compID = '$id'  AND followedBy = '$u_userIC';";
            }else{
                $sql = "UPDATE complaints SET setledDate='$sdate', c_status='$status', action_desc='$action', action_path='$path' WHERE compID = '$id'  AND followedBy = '$u_userIC';";
            }

            
            $result = mysqli_query($conn, $sql);

            if($result)
            {   
                if($imgExt)
                    unlink($_SESSION["remove"]);
                move_uploaded_file($tmp_dir, $upload_dir.$pic);
                header("location: acceptedComplaints.php");
                exit();
            } 
            else
            {
                $sqlErr = $conn->error;
            }
        }
        
    }
?>