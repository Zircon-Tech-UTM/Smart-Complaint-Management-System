<?php

    include ('dbconnect.php');

    //Retrieve data from modify form
    $r_roomID = $_POST["roomID"];
    $r_nameBI = $_POST["nameBI"];
    $r_nameBM = $_POST["nameBM"];
    $r_PICid = $_POST["PICid"];
    $r_nameBI = $_POST["nameBI"];
    $r_block = $_POST['block'];
    $r_loc = $_POST['loc'];

    //insert into database
$sql = "UPDATE rooms
        SET PIC = '$r_PICid', r_nameBI = '$r_nameBI', r_nameBM = '$r_nameBM', blok = '$r_block', location = '$r_loc'
        WHERE r_roomID = '$r_roomID'";

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