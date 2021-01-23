<?php
    $r_roomID = "";
    $r_nameBI = "";
    $r_nameBM = "";
    $r_PIC = "";
    $r_PIC2 = "";
    $r_PIC3 = "";
    $r_block = "";


    $r_roomIDErr = "";
    $r_nameBIErr = "";
    $r_nameBMErr = "";
    $r_PICErr = "";
    $r_PIC2Err = "";
    $r_PIC3Err = "";
    $r_blockErr = "";
    $errMSG = ""; //for image
    $sqlErr = "";
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {


        if (empty(trim(($_POST["roomID"])))) 
        {
            $r_roomIDErr = $language['Room ID is required'];
        }
        else
        {
            $r_roomID = trim($_POST["roomID"]);
        }




        if (empty(trim(($_POST["nameBI"])))) 
        {
            $r_nameBIErr = $language['English room name is required.'];
        } 
        else
        {
            $r_nameBI = trim($_POST["nameBI"]);
        }




        if (empty(trim(($_POST["nameBM"])))) 
        {
            $r_nameBMErr = $language['Malay room name is required.'];
        } 
        else
        {
            $r_nameBM = trim($_POST["nameBM"]);
        }

        


        if (empty($_POST["PIC"])) 
        {
            $r_PICErr = $language['Choose a name.'];
        } 
        else
        {
            $r_PIC = $_POST["PIC"];
        }



        if (empty(($_POST["block"]))) 
        {
            $r_blockErr = $language['Choose a block.'];
        } 
        else
        {
            $r_block = $_POST["block"];
        }


        if (empty(($_POST["PIC2"]))) 
        {
            $r_PIC2Err = $language['Choose a name.'];
        } 
        else
        {
            $r_PIC2 = $_POST["PIC2"];
        }

        if (empty(($_POST["PIC3"]))) 
        {
            $r_PIC3Err = $language['Choose a name.'];
        } 
        else
        {
            $r_PIC3 = $_POST["PIC3"];
        }

        if ($_POST["PIC3"] == $_POST["PIC2"] or $_POST["PIC3"] == $_POST["PIC"])
            $r_PIC3Err = $language['You cannot assign 1 PIC to 2 positions.'];
        if ($_POST["PIC2"] == $_POST["PIC"] or $_POST["PIC2"] == $_POST["PIC3"])
            $r_PIC2Err = $language['You cannot assign 1 PIC to 2 positions.'];

        if ($_POST["PIC"] == $_POST["PIC2"] or $_POST["PIC"] == $_POST["PIC3"])
            $r_PICErr = $language['You cannot assign 1 PIC to 2 positions.'];

        if(empty($_POST["PIC3"]))
        {
            $r_PIC3Err = "";
        }
        if(empty($_POST["PIC2"]))
        {
            $r_PIC2Err = "";
        }
        if(empty($_POST["PIC"]))
        {
            $r_PICErr = "";
        }

        if (empty($_POST["PIC"])) 
        {
            $r_PICErr = $language['Choose a name.'];
        } 
        else
        {
            $r_PIC = $_POST["PIC"];
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
                $errMSG =$language['Sorry, your file is too large.'];  
            }
        }
        else{
            $errMSG = $language['Sorry, only JPG, JPEG, PNG & GIF files are allowed.'];  
        }
    
    
        if(empty($r_roomIDErr)&&empty($r_nameBIErr)&&empty($r_nameBMErr)&&empty($r_PICErr)&&empty($r_PIC2Err)&&empty($r_PIC3Err)&&empty($r_blockErr))
        {
            //insert into database
            $path = $upload_dir.$pic;

            if ($imgExt == ""){
                $sql = "INSERT INTO rooms(r_roomID, PIC, PIC2, PIC3, r_nameBI, r_nameBM, blok)
                VALUES ('$r_roomID', '$r_PIC', '$r_PIC2','$r_PIC3', '$r_nameBI', '$r_nameBM', '$r_block')";

                if ($r_PIC2 == "")
                    $sql = "INSERT INTO rooms(r_roomID, PIC, PIC2, PIC3, r_nameBI, r_nameBM, blok) VALUES ('$r_roomID', '$r_PIC', NULL,'$r_PIC3', '$r_nameBI', '$r_nameBM', '$r_block')";
                if ($r_PIC3 == "")
                    $sql = "INSERT INTO rooms(r_roomID, PIC, PIC2, PIC3, r_nameBI, r_nameBM, blok) VALUES ('$r_roomID', '$r_PIC', '$r_PIC2',NULL, '$r_nameBI', '$r_nameBM', '$r_block')";
                if ($r_PIC2 == "" AND $r_PIC3 == "")
                    $sql = "INSERT INTO rooms(r_roomID, PIC, PIC2, PIC3, r_nameBI, r_nameBM, blok) VALUES ('$r_roomID', '$r_PIC', NULL,NULL, '$r_nameBI', '$r_nameBM', '$r_block')";
                
            }else{
                $sql = "INSERT INTO rooms(r_roomID, PIC, PIC2, PIC3, r_nameBI, r_nameBM, blok, r_img_path)
                VALUES ('$r_roomID', '$r_PIC', '$r_PIC2','$r_PIC3', '$r_nameBI', '$r_nameBM', '$r_block', '$path')";

                if ($r_PIC2 == "")
                    $sql = "INSERT INTO rooms(r_roomID, PIC, PIC2, PIC3, r_nameBI, r_nameBM, blok, r_img_path) VALUES ('$r_roomID', '$r_PIC', NULL,'$r_PIC3', '$r_nameBI', '$r_nameBM', '$r_block', '$path')";
                if ($r_PIC3 == "")
                    $sql = "INSERT INTO rooms(r_roomID, PIC, PIC2, PIC3, r_nameBI, r_nameBM, blok, r_img_path) VALUES ('$r_roomID', '$r_PIC', '$r_PIC2',NULL, '$r_nameBI', '$r_nameBM', '$r_block', '$path')";
                if ($r_PIC2 == "" AND $r_PIC3 == "")
                    $sql = "INSERT INTO rooms(r_roomID, PIC, PIC2, PIC3, r_nameBI, r_nameBM, blok, r_img_path) VALUES ('$r_roomID', '$r_PIC', NULL,NULL, '$r_nameBI', '$r_nameBM', '$r_block', '$path')";
            }
            

            $result = mysqli_query($conn, $sql);

            if($result)
            {
                if ($imgExt)
                    move_uploaded_file($tmp_dir, $upload_dir.$pic);
                header ("Location: roomlist.php");
            }
            else
            {
                $sqlErr = $conn->error;
                // $sqlErr = $_POST["PIC"];
            }
        }
    
    }
    // if(isset($errMSG))
    //     exit();
?>

<!-- Direct user to page that displaylist of rooms-->