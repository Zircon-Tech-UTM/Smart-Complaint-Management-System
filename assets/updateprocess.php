<?php
   // require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
   require_once("../dbconfig.php");   
    $assetID = "";
    $nameBI = "";
    $nameBM = "";
    $category = "";
    $cost = "";
    $date_purchased = "";
    $room = "";


    $assetIDErr = "";
    $nameBIErr = "";
    $nameBMErr = "";
    $categoryErr = "";
    $costErr = "";
    $date_purchasedErr = "";
    $errMSG = "";
    $roomErr = "";
    $sqlErr = "";
    

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        $block = $_POST['blocks'];
        $description=$_POST["description"];

        if (empty(trim(($_POST["assetID"])))) 
        {
        $assetIDErr =  $language['Changes Failed. Asset ID is required']; 
        
        } 
        elseif (!preg_match("/^[A-Za-z0-9 _]*[A-Za-z0-9][A-Za-z0-9 _]*$/",$_POST["assetID"])) 
        {
        $assetIDErr = $language['Changes Failed. Only letters, number and white space are allowed'];
        }
        else
        {
        $assetID = trim($_POST["assetID"]);
        }




        if (empty(trim(($_POST["nameBI"])))) 
        {
        $nameBIErr = $language['Changes Failed. English asset name is required'];
        } 
        elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nameBI"])) 
        {
        $nameBIErr = $language['Changes Failed. Only letters and white space allowed'];
        }
        else
        {
        $nameBI = trim($_POST["nameBI"]);
        }




        if (empty(trim(($_POST["nameBM"])))) 
        {
        $nameBMErr = $language['Changes Failed. Malay asset name is required'];
        } 
        elseif (!preg_match("/^[a-zA-Z-' ]*$/",$_POST["nameBM"])) 
        {
        $nameBMErr = $language['Changes Failed. Only letters and white space allowed'];
        }
        else
        {
        $nameBM = trim($_POST["nameBM"]);
        }




        if (!isset($_POST['category']))
        {
        $categoryErr = $language['Changes Failed. Choose a category.'];
        } 
        else
        {
        $category = $_POST["category"];
        }



        if (empty(trim(($_POST["cost"])))) 
        {
        $costErr = $language['Changes Failed. Cost is required'];"";
        } 
        elseif (!preg_match("/^[0-9]+(\.[0-9]{2})?$/", $_POST["cost"])) 
        {
        $costErr = "Changes Failed. Please enter valid cost.";
        }
        else
        {
        $cost = trim($_POST["cost"]);
        }


        if (empty(($_POST["date_purchased"]))) 
        {
        $date_purchasedErr = "Changes Failed. Choose a date.";
        } 
        else
        {
        $date_purchased = $_POST["date_purchased"];
        }
        // $asset_condition = $_POST['asset_condition'];

        if (empty(($_POST["rooms"]))) 
		{
		$roomErr = "Choose a rooms.";
		} 
		else
		{
		$room = $_POST["rooms"];
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
                $errMSG =  $language['Sorry, your file is too large.'];
            }
        }
        else{
            $errMSG = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";  
        }

        //insert into database
        if(empty($assetIDErr)&&empty($nameBIErr)&&empty($nameBMErr)&&empty($categoryErr)&&empty($costErr)&&empty($asset_conditionErr)&&empty($date_purchasedErr) &&empty($roomErr) )
        {
            $path = $upload_dir.$pic;
            
            if ($imgExt== ""){
                $sql = "UPDATE assets SET a_assetID='$assetID' ,a_nameBI='$nameBI',a_nameBM='$nameBM',a_category='$category' ,description='$description' ,cost='$cost' ,date_purchased='$date_purchased', a_roomID='$room' WHERE a_assetID= '$assetID'";
                $_SESSION["remove"] = "";
            }
            else{
                $sql = "UPDATE assets SET a_assetID='$assetID' ,a_nameBI='$nameBI',a_nameBM='$nameBM',a_category='$category' ,description='$description' ,cost='$cost' ,date_purchased='$date_purchased', a_roomID='$room', a_img_path = '$path' WHERE a_assetID= '$assetID'";
            }
                


            $result = mysqli_query($conn, $sql);
        }

        if($result)
        {
            if ($imgExt){
                unlink($_SESSION["remove"]);
                move_uploaded_file($tmp_dir, $upload_dir.$pic);
            }
            

            ($_SESSION['userType'] == '2')? (header ("location: mainB.php")) : (header ("location: mainA.php?block=$block"));
        }
        else
        {
            $sqlErr = $conn->error;
            ($_SESSION['userType'] == '2')? (header ("refresh: 5; location: mainB.php")) : (header ("refresh: 5; location: mainA.php?block=$block"));
        }
    }

?>
