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

        if(empty($sdateErr)&&empty($statusErr)&&empty($actionErr))
        {
            $sql = "UPDATE complaints SET setledDate='$sdate', c_status='$status', action_desc='$action' WHERE compID = '$id'  AND followedBy = '$u_userIC';";
            
            $result = mysqli_query($conn, $sql);

            if($result)
            {   
                header("location: acceptedComplaints.php");
                exit();
            } 
            else
            {
                $sqlErr = $conn->error;
            }
        }
        
    }

    mysqli_close($conn);
?>