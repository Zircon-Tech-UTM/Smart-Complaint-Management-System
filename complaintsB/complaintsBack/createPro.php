<?php
    $u_userIC = "";
    $date = "";
    $blocks = "";
    $rooms = "";
    $assets = "";
    $detail = "";


    $u_userICErr = "";
    $dateErr = "";
    $blocksErr = "";
    $roomsErr = "";
    $assetsErr = "";
    $detailErr = "";
    $errMSG = "";
    $sqlErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $u_userIC = trim($_POST['u_userIC']);

        if (empty(($_POST["date"]))) 
        {
            $dateErr = "Choose a date.";
        } 
        else
        {
            $date = $_POST["date"];
        }


        if (empty(($_POST["blocks"]))) 
        {
            $blocksErr = "Choose a block.";
        } 
        else
        {
            $blocks = $_POST["blocks"];
        }


        if (empty(($_POST["rooms"]))) 
        {
            $roomsErr = "Choose a room.";
        } 
        else
        {
            $rooms = $_POST["rooms"];
        }


        if (empty(($_POST["assets"]))) 
        {
            $assetsErr = "Choose an asset.";
        } 
        else
        {
            $assets = $_POST["assets"];
        }


        if (empty(($_POST["detail"]))) 
        {
            $detailErr = "Detail is required.";
        } 
        else
        {
            $detail = $_POST["detail"];
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
        

        // $image = $_POST['image'];
        // $total = $_POST['total'];

        if(empty($dateErr)&&empty($blocksErr)&&empty($roomsErr)&&empty($assetsErr)&&empty($detailErr))
        {
            $path = $upload_dir.$pic;

            $sql = "INSERT INTO complaints(c_userIC, c_assetID, c_roomID, c_status, proposedDate, detail, c_img_path) VALUES('".$u_userIC."', '".$assets."', '".$rooms."', '1', '".$date."', '".$detail."', '".$path."');";

            echo '\n';
            echo $sql;
            echo '\n';
            
            $result = mysqli_query($conn, $sql);

            if($result)
            {
                move_uploaded_file($tmp_dir, "../complaints/".$upload_dir.$pic);
                header("location: readComplaint.php");
                exit();
            } 
            else
            {
                $sqlErr = $conn->error;
            }
        }
        
    }
?>