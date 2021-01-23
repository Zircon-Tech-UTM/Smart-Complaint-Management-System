u<?php
  //Start session
  session_start();

  //connect DB connection
  include ("../dbconfig.php");

  if (isset($_POST["login"])) 
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
                $_SESSION['language'] ="BI";
                $_SESSION['userType'] = $row['userType'];

                //filter
                $_SESSION['position'] = "";

                if($row['userType']=='1') //Admin
                {
                  header("location: ../A.php");
                }
                else if ($row['userType']=='2')        //OtherUsers
                {
                  header("location: ../B.php");
                }
                else if ($row['userType']=='3')
                {
                  header("location: ../C.php");
                }else{
                  header("location: ../D.php");
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
      header("refresh: 5; location: login.php");
    }
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

