<?php
    $r_roomID = "";
    $r_nameBI = "";
    $r_nameBM = "";
    $r_PIC = "";
    $r_block = "";
    

    $r_roomIDErr = "";
    $r_nameBIErr = "";
    $r_nameBMErr = "";
    $r_PICErr = "";
    $r_blockErr = "";
    $errMSG = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {



        if (empty(trim(($_POST["roomID"])))) 
        {
            $r_roomIDErr = "Room ID is required";
        } 
        elseif (!preg_match("/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/",$_POST["roomID"])) 
        {
            $r_roomIDErr = "Only letters, number and white space are allowed";
        }
        else
        {
            $r_roomID = trim($_POST["roomID"]);
        }




        if (empty(trim(($_POST["nameBI"])))) 
        {
            $r_nameBIErr = "English room name is required";
        } 
        else
        {
            $r_nameBI = trim($_POST["nameBI"]);
        }




        if (empty(trim(($_POST["nameBM"])))) 
        {
            $r_nameBMErr = "Malay block name is required";
        } 
        else
        {
            $r_nameBM = trim($_POST["nameBM"]);
        }

        


        if (empty(($_POST["PIC"]))) 
        {
            $r_PICErr = "Choose a name.";
        } 
        else
        {
            $r_PIC = $_POST["PIC"];
        }



        if (empty(($_POST["block"]))) 
        {
            $r_blockErr = "Choose a block.";
        } 
        else
        {
            $r_block = $_POST["block"];
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

        if ($_FILES['image']['name'] == "")
            $errMSG = "No images."; 

    
    
        if((empty($r_roomIDErr)&&empty($r_nameBIErr)&&empty($r_nameBMErr)&&empty($r_PICErr)&&empty($r_blockErr)))
        {
            //insert into database
            

            $path = $upload_dir.$pic;

            if ($imgExt== ""){
                $sql = "UPDATE rooms
                        SET PIC = '$r_PIC', r_nameBI = '$r_nameBI', r_nameBM = '$r_nameBM', blok = '$r_block'
                        WHERE r_roomID = '$r_roomID'";
                $_SESSION["remove"] = "";
            }
            else
                $sql = "UPDATE rooms
                        SET PIC = '$r_PIC', r_nameBI = '$r_nameBI', r_nameBM = '$r_nameBM', blok = '$r_block', r_img_path = '$path'
                        WHERE r_roomID = '$r_roomID'";

            $result = mysqli_query($conn, $sql);

            if($result)
            {
                unlink($_SESSION["remove"]);
                move_uploaded_file($tmp_dir, $upload_dir.$pic);
                header ("Location: roomlist.php");
            }
            else
            {
                echo $conn->error;
            }
            mysqli_close($conn);
        }
    
    }
?>