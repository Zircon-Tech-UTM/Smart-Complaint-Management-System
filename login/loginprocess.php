<?php
  //Start session
  session_start();

  //connect DB connection
  include ("../dbconfig.php");

  if (isset($_POST["login"])) {
    $sql="SELECT * from users 
          where (u_userIC = '".$_POST["ic"]."'
          and pwd = '".$_POST["pwd"]."')";
    $result= mysqli_query($conn, $sql);

    $user=mysqli_fetch_array($result);

    if($user)
    {
        if(!empty($_POST["remember"]))
        {
          setcookie("member_ic",$_POST["ic"], time()+(10*365*24*60*60));
          setcookie("member_pwd",$_POST["pwd"], time()+(10*365*24*60*60));
        }
        else
        {
          if (isset($_COOKIE["member_ic"])) {
            setcookie("member_ic","");
          }
          if (isset($_COOKIE["member_pwd"])) {
            setcookie("member_pwd","");
          }
        }
        header("location: login.php");
    }
    else
    {
      $message="Invalid Login";
    }



  $fid = $_POST['ic'];
  $fpwd = $_POST['pwd'];


   if (!empty($fid) || !empty($fpwd)) 
   {
        $sql = "SELECT * FROM users WHERE u_userIC = '$fid'";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1)
        {
          while ($row = mysqli_fetch_assoc($result)) 
          {
            if (password_verify($fpwd, $row['pwd'])||($fpwd == $row['pwd'])) 
            {
                //Set session 
                $_SESSION['u_userIC'] = session_id();// set session id
                $_SESSION['ic'] = $fid;

                if($row['userType']=='1') //Admin
                {
                  header("location: ../index.php");
                }
                else                    //OtherUsers
                {
                  header("location: ../indexB.php");
                }
            }
            else
            {
                echo "IC number or Password is invalid";
            }    
          }
        }
        else
        {
          echo "No user found on this IC number.";
        } 
    }
    else
    {
      echo'User not found. Please enter correct IC number and password.';
      header("refresh: 2; location: login.php");
    }
  }






  // $isPasswordCorrect = password_verify($fpwd,$user["pwd"]);

  // //Get user based on login credentials
  // if($isPasswordCorrect)
  // $sql = "SELECT * FROM users
  //     WHERE u_userIC = '$fid' AND pwd = '$fpwd'";

  // //Check result
  // var_dump($result);

  // //Execute SQL
  // $result = mysqli_query($conn, $sql);
  // $row = mysqli_fetch_array($result);

  // //Check existence of data
  // $count = mysqli_num_rows($result);


  // //Check login 
  // if($count == 1)  //User found
  // {
  //   //Set session 
  //   $_SESSION['u_userIC'] = session_id();// set session id
  //   $_SESSION['ic'] = $fid;

  //   if($row['userType']=='1') //Admin
  //   {
  //     header("location: ../index.php");
  //   }
  //   else                    //OtherUsers
  //   {
  //     header("location: ../indexB.php");
  //   }
  // }
  // else             //User not found
  // {
  //   echo'User not found. Please enter correct IC number and password.';
  //   header("refresh: 2; location: login.php");
  // }
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