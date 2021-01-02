<?php
    
    // define variables and set to empty values
    $username = "";
    $IC = "";
    $password = "";
    $addr = "";
    $positionBI = "";
    $contact = "";
    $room = "";
    $email= "";

    $usernameErr = "";
    $ICErr = "";
    $passwordErr = "";
    $addrErr = "";
    $positionBIErr = "";
    $contactErr = "";
    $roomErr = "";
    $emailErr= "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  
  if (empty($_POST["name"])) {
    $usernameErr = "Name is required";
  } else {
    $username = trim($_POST["name"]);
    // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$username)) {
      $usernameErr = "Only letters and white space allowed";
    }
  }
  
  if (empty($_POST["femail"])) {
    $emailErr = "Email is required";
  } else {
    $email = trim($_POST["femail"]);
    // check if e-mail address is well-formed
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format";
    }
  }

  if (empty($_POST["fcontactnum"])) {
    $contactErr = "Contact number is required";
  } else {
    $contact = trim($_POST["fcontactnum"]);
    // check if contact is well-formed
    if (!preg_match('/^[0-9]{3}-[0-9]{7,8}$/',$contact)) {
      $contactErr = "Correct Format in Digit: XXX-XXXXXXXX";
    }
  }

  if (empty($_POST["ic"])) {
    $ICErr = "IC number is required";
  } else {
    $IC = trim($_POST["ic"]);
    // check if contact is well-formed
    if (!preg_match('/^[0-9]{6}-[0-9]{2}-[0-9]{4}$/',$IC)) {
      $ICErr = "Correct Format in Digit: XXXXXX-XX-XXXX";
    }
  }

   if (empty($_POST["password"])) {
    $passwordErr = "Password is required";
  } else {
    $password = trim($_POST["password"]);
    // check if contact is well-formed
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    if (!$uppercase || !$lowercase || !$number || strlen($password) < 8) {
      $passwordErr = "Password should be at least 8 characters in length and should include at least one upper case letter, one number, and one special character.";
    }
  }

} 
 
    session_start();
    include("dbconfigUser.php");

    $username = $_POST['name'];
    $IC = $_POST['IC'];
    $password = $_POST['password'];
    $addr = $_POST['faddr'];
    $positionBI = $_POST['position'];
    $contact = $_POST['fcontactnum'];
    $room = $_POST['room'];
    $email= $_POST['femail'];

    date_default_timezone_set("Asia/Kuala_Lumpur");
    $rdate= date('Y-m-d H:i:s');  

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


    $sql = "INSERT INTO users (u_userIC, pwd, name, postBI, postBM, address, email, contact, userType, dateRegistered ) VALUES('".$IC."', '".$password."','".$username."','".$positionBI."', '".$positionBM."',' ".$addr."', '".$email."','".$contact."', '".$userType."', '".$rdate."')";

    echo '\n';
    echo $sql;
    echo '\n';
    
    $result = mysqli_query($conn, $sql);

    if($result){
        header("location: ../landingUser.php");
        exit();
    } else{
        echo "ERROR: $conn->error";
    }

    mysqli_close($conn);
?>