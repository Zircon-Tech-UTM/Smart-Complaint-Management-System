<?php
//Start session
session_start();

//connect DB connection
include ("../CRUDusers/UsersBack/dbconfigUser");

//Retrieve data from login form
$fid = $_POST['ic'];

//Get user based on login credentials
$sql = "SELECT * FROM users
    WHERE u_userIC = '$fid'";

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

  header('location: forgotpwdFinal.php?id="$fid"');
}
else             //User not found
{
  echo'User not found';
  //header('location: login.php');
}
mysqli_close($conn);
?>
