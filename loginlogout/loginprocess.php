<?php
//Start session
session_start();

//connect DB connection
include ("../CRUDusers/UsersBack/dbconfigUser.php");

//Retrieve data from login form
$fid = $_POST['ic'];
$fpwd = $_POST['pwd'];

//Get user based on login credentials
$sql = "SELECT * FROM users
		WHERE u_userIC = '$fid' AND pwd = '$fpwd'";

//Check result
var_dump($result);

//Execute SQL
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

//Check existence of data
$count = mysqli_num_rows($result);


//Check login 
if($count == 1)  //User found
{
	//Set session 
	$_SESSION['u_userIC'] = session_id();// set session id
	$_SESSION['ic'] = $fid;

	if($row['userType']=='1') //Admin
	{
		header('location: ../CRUDusers/landingUser.php');
	}
	else                    //OtherUsers
	{
		header('location: otherUser.php');
	}
}
else             //User not found
{
	echo'User not found';
	//header('location: login.php');
}
mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Complaints Inventory System</title>
</head>
	<body>
		<br><a href ="login.php">Back To Login Page</a>
	</body>
</html>