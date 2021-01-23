<?php
    $b_block_no = "";
    $b_nameBI = "";
    $b_nameBM = "";
    $b_loc = "";
    

    $b_block_noErr = "";
    $b_nameBIErr = "";
    $b_nameBMErr = "";
    $b_locErr = "";
    $sqlErr = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") 
    {
        if (empty(trim(($_POST["block_no"])))) 
        {
            $b_block_noErr = $language["Block ID is required"];
        } 
        else
        {
            $b_block_no = trim($_POST["block_no"]);
        }


        if (empty(trim(($_POST["nameBI"])))) 
        {
            $b_nameBIErr = $language["English block name is required"];
        } 
        else
        {
            $b_nameBI = trim($_POST["nameBI"]);
        }


        if (empty(trim(($_POST["nameBM"])))) 
        {
            $b_nameBMErr = $language["Malay block name is required"];
        } 
        else
        {
            $b_nameBM = trim($_POST["nameBM"]);
        }

    
        if (empty(($_POST["loc"]))) 
        {
            $b_locErr = $language["Choose a location"];
        } 
        else
        {
            $b_loc = $_POST["loc"];
        }

        
        if(empty($b_block_noErr)&&empty($b_nameBIErr)&&empty($b_nameBMErr)&&empty($contactErr)&&empty($b_locErr))
        {
            $sql = "INSERT INTO blocks(block_no, b_nameBI, b_nameBM, location)
                VALUES ('$b_block_no', '$b_nameBI', '$b_nameBM', '$b_loc')";
            $result = mysqli_query($conn, $sql);
            if($result)
            {
                header ("Location: blocklist.php");
            }
            else
            {
                $sqlErr = $conn->error;
            }
            
        }
    }
?>