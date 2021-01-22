<?php
  //Start session
  session_start();

  //connect DB connection
  include ("../dbconfig.php");

  $fid = $_POST['ic'];

  $sql = "SELECT * FROM users
      WHERE u_userIC = '$fid'";

  //Check result
  // var_dump($result);

  //Execute SQL
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);

  //Check existence of data
  $count = mysqli_num_rows($result);


  //Check ic 
  if($count == 1)  //User found
  {
    //Set session 
    $_SESSION['u_userIC'] = session_id();// set session id
    $_SESSION['ic'] = $fid;
    $_SESSION['language'] ="BM";
    $_SESSION['userType'] = $row['userType'];

    header("location: changepwd.php?id=".$fid."");
  }
  else             //User not found
  {
    $sqlErr = 'User not found';
    //header('location: login.php');
  }
  mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Complaints Inventory System</title>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
	<body>
    <br><h1><?php echo $sqlErr; ?></h1>
		<br><a href ="login.php">Back To Login Page</a>
	</body>
</html>