<?php
    require_once("../dbconfig.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../login/login.php');
    }

    //Retrieving data from user input
    $r_roomID = $_POST["roomID"];
    $r_nameBI = $_POST["nameBI"];
    $r_nameBM = $_POST["nameBM"];
    $r_PIC = $_POST["PIC"];
    $r_nameBI = $_POST["nameBI"];
    $r_block = $_POST['block'];

    //insert into database
    $sql = "INSERT INTO rooms(r_roomID, PIC, r_nameBI, r_nameBM, blok)
            VALUES ('$r_roomID', '$r_PIC', '$r_nameBI', '$r_nameBM', '$r_block')";

    $result = mysqli_query($conn, $sql);
    if($result)
    {
        header ("Location: roomlist.php");
    }
    else
    {
        echo $conn->error;
    }
    mysqli_close($conn);

?>

<!-- Direct user to page that displaylist of rooms-->