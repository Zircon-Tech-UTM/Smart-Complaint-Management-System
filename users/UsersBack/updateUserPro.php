<?php
    include("../../dbconfig.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['ic']) != session_id() )
    {
        header('location: ../../login/login.php');
    }
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE u_userIC=".$id.";";

        $result = mysqli_query($conn, $sql);

        if (!$result){echo "ERROR:  $conn->error";
            header("refresh: 6; location: readUser.php");
        } 

        $row = mysqli_fetch_array($result);
    
    
    // define variables and set to empty values
    $username = $_POST['name'];
    $IC = $_POST['IC'];
    $password = $_POST['password'];
    $addr = $_POST['faddr'];
    $positionBI = $_POST['position'];
    $contact = $_POST['fcontactnum'];
    $email= $_POST['femail'];
    $grades= $_POST['grades'];

    $usernameErr = "";
    $ICErr = "";
    $passwordErr = "";
    $contactErr = "";
    $emailErr= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
  
  if (empty($_POST["name"])) 
  {
    $usernameErr = "Name is required";
  } 
  else 
  {
    $username = trim($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) 
    {
      $usernameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["femail"])) 
  {
    $emailErr = "Email is required";
  } 
  else 
  {
    $email = trim($_POST["femail"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["fcontactnum"])) 
  {
    $contactErr = "Contact number is required";
  } 
  else 
  {
    $contact = trim($_POST["fcontactnum"]);
    // check if contact is well-formed
    if (!preg_match('/^[0-9]{10,11}$/',$contact)) 
    {
      $contactErr = "Please enter correct format in digit without -";
    }
  }

  if (empty($_POST["ic"])) 
  {
    $ICErr = "IC number is required";
  } 
  else 
  {
    $IC = trim($_POST["ic"]);
    // check if contact is well-formed
    if (!preg_match('/^[0-9]{12}/',$IC)) 
    {
      $ICErr = "Correct Format in 12 digit without - ";
    }
  }

  if (empty($_POST["password"])) 
   {
    $passwordErr = "Password is required";
  } 
  else 
  {
    $password = trim($_POST["password"]);
    // check if contact is well-formed
    if (strlen($password) < 4) 
    {
      $passwordErr = "Password should be at least 4 characters in length.";
    }
  }
if($positionBI=="Admin")
    {
        $userType="1";
        $positionBM="Pentadbir";
    }
    else if($positionBI=="PIC Of Room")
    {
        $userType="2";
        $positionBM="PIC Makmal";
    }
    else if($positionBI=="Assistant Computer Technician")
    {
        $userType="3";
        $positionBM="Penolong Juruteknik Komputer";
    }
    else
    {
        $userType="4";
        $positionBM="Penolong Jurutera";
    }

     

    $sql = "UPDATE users
            SET  pwd='".$password."', name='".$username."', postBI='".$positionBI."',postBM='".$positionBM."', address='".$addr."', email='".$email."', contact= '".$contact."',  userType='".$userType."',  u_grade='".$grades."'
            WHERE u_userIC='$IC';";

   
    echo '\n';
    echo $sql;
    echo '\n';
    
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location: ../readUser.php?id=".$_SESSION['ic']."");
        exit();
    } else{
        echo "ERROR: $conn->error";
    }

    mysqli_close($conn);
}

}
?>


    


