<?php
    include("../dbconfig.php");

    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../login/login.php');
    }

    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE u_userIC=".$id.";";

        $result = mysqli_query($conn, $sql);

        if (!$result)
        {
            echo "ERROR:  $conn->error";
            exit();
        } 
        $row = mysqli_fetch_array($result);

    include("changepwdprocess.php");
    include("../navbar/navbar1.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<style>
.error {color: #FF0000;}
.help-block{color:red;}
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container-fluid" style="width:1200px; margin:0 auto; height: 100%; line-height: 2.5em; position:relative; top:25px;">

        <form action="" method="POST">
            <h2>Reset Password: </h2>
    <div class="col">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">User Settings</p>
            </div>
            <div class="card-body">

          <script>
              var check = function() {
                if (document.getElementById('newpassword').value ==
                  document.getElementById('confirm_password').value) {
                    document.getElementById('message').style.color = 'green';
                    document.getElementById('message').innerHTML = '  (matching)';
                } else {
                  document.getElementById('message').style.color = 'red';
                  document.getElementById('message').innerHTML = '  (not matching)';
                }
              }
              function myFunction() 
              {
                  var x = document.getElementById("password");
                  if (x.type === "password") 
                  {
                    x.type = "text";
                  } 
                  else 
                  {
                    x.type = "password";
                  }
                }
              function myFunction1() 
              {
                  var x = document.getElementById("newpassword");
                  if (x.type === "password") 
                  {
                    x.type = "text";
                  } 
                  else 
                  {
                    x.type = "password";
                  }
                }
                function myFunction2() 
              {
                  var x = document.getElementById("confirm_password");
                  if (x.type === "password") 
                  {
                    x.type = "text";
                  } 
                  else 
                  {
                    x.type = "password";
                  }
                }
          </script>

            <div class="mb-3">
                  <label for="pwd" class="form-label ">Current Password:</label>
                  <input type="password" name="password" id="password" class="form-control <?php echo (!empty($passwordErr)) ? 'is-invalid' : ''; ?>" title="Enter at least 4 characters." placeholder="Enter current password" value="<?php echo $password; ?>">
                  <span class="help-block"><?php echo $passwordErr;?></span>
                  <input type="checkbox" onclick="myFunction()"> Show Password
               </div>

          <div class ="row">
              <div class="col-6">
                  <label for="pwd" class="form-label ">New Password:</label>
                  <input type="password" name="newpassword" id="newpassword" class="form-control <?php echo (!empty($passwordErr)) ? 'is-invalid' : ''; ?>" title="Enter at least 4 characters." placeholder="Enter new password" value="<?php echo $newpassword; ?>">
                  <span class="help-block"><?php echo $newpasswordErr;?></span>
                  <input type="checkbox" onclick="myFunction1()"> Show Password
              </div>

              <div class="col-6">
                  <label for="psw-repeat" class="form-label">Re-type Password:<span id='message'></span></label>  
                <input type="password" id="confirm_password" placeholder="Retype Password" name="confirm_password" class="form-control <?php echo (!empty($confirm_passwordErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>"onkeyup='check();'>  
                <span class="help-block"><?php echo $confirm_passwordErr;?></span>
                <input type="checkbox" onclick="myFunction2()"> Show Password
              </div>
          </div><br>

  </div>
</div>
  </div>
            <input type="hidden" value = "<?php echo $id ?>" name="ic">

            <input type="submit" name="submit" class="btn btn-primary" value="Save">
            <input type="reset" name="clear" value="Clear"class="btn btn-warning">
            
        </form>
    </div>
</body>
</html>
<?php include("../navbar/navbar2.php"); }?>
