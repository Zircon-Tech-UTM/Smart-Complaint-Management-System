<?php
include ('dbconnect.php');

//Retrieving data from user input
$r_roomID = $_POST["roomID"];
$r_nameBI = $_POST["nameBI"];
$r_nameBM = $_POST["nameBM"];
$r_PICid = $_POST["PICid"];
$r_nameBI = $_POST["nameBI"];
$r_block = $_POST['block'];
$r_loc = $_POST['loc'];

//insert into database
$sql = "INSERT INTO rooms(r_roomID, PIC, r_nameBI, r_nameBM, blok, location)
        VALUES ('$r_roomID', '$r_PICid', '$r_nameBI', '$r_nameBM', '$r_block', '$r_loc')";

$result = mysqli_query($conn, $sql);
if($result)
{
    echo "successful";
}
else
{
    echo $conn->error;
}
mysqli_close($conn);

?>

<!-- Direct user to page that displaylist of rooms-->