<?php 
    include ("../dbconfig.php");
    
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../login/login.php');
    }

    include("UsersBack/createUserPro.php");
    include("../navbar/navbar1.php");
     
?>

  
<!DOCTYPE html>
<html lang="en">
<style>
.error {color: #FF0000;}
.help-block{color:red;}
</style>
<head>
    <title>Create Account</title>
    
</head>
<body id="page-top">
        <form action="" enctype="multipart/form-data" method="POST">
          <!--<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>-->
          
<div class="container-fluid">
    <h3 class="text-dark mb-4" style="font-size: 40px;">User Profile</h3>
    <div class="col">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">User Settings</p>
            </div>
            <div class="card-body">
                <div class ="row">
                    <div class="col-6">
                        <label for="fname" class="form-label">Full Name:</label>
                        <input type="text" name="name" id="fname" class="form-control <?php echo (!empty($usernameErr)) ? 'is-invalid' : ''; ?>" placeholder="Enter Full Name" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $usernameErr;?></span>
                    </div>

                    <div class="col-6">
                        <label for="fic" class="form-label <?php echo (!empty($ICErr)) ? 'is-invalid' : ''; ?>">IC number:</label>
                        <input type="text" name="IC" id="fic" class="form-control <?php echo (!empty($ICErr)) ? 'is-invalid' : ''; ?>" placeholder="Enter IC Number" value="<?php echo $IC; ?>">
                        <span class="help-block"><?php echo $ICErr;?></span>
                    </div>
                </div><br>    

          <script>
              var check = function() {
                if (document.getElementById('password').value ==
                  document.getElementById('confirm_password').value) {
                    document.getElementById('message').style.color = 'green';
                    document.getElementById('message').innerHTML = '  (matching)';
                } else {
                  document.getElementById('message').style.color = 'red';
                  document.getElementById('message').innerHTML = '  (not matching)';
                }
              }
          </script>

          <div class ="row">
              <div class="col-6 needs-validation">
                  <label for="pwd" class="form-label ">Password:</label>
                  <input type="password" name="password" id="password" class="form-control <?php echo (!empty($passwordErr)) ? 'is-invalid' : ''; ?>" title="Enter at least 4 characters." placeholder="Enter password" value="<?php echo $password; ?>">
                  <span class="help-block"><?php echo $passwordErr;?></span>
              </div>

              <div class="col-6">
                  <label for="psw-repeat" class="form-label">Re-type Password:<span id='message'></span></label>  
                <input type="password" id="confirm_password" placeholder="Retype Password" name="confirm_password" class="form-control <?php echo (!empty($confirm_passwordErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>"onkeyup='check();'>  
                <span class="help-block"><?php echo $confirm_passwordErr;?></span>
              </div>
          </div><br>

              <div class="row">
                <div class="col-6">
                  <label for="position" class="form-label">Position Assigned:</label>
                  <select name="position" id="position" class="form-control <?php echo (!empty($positionBIErr)) ? 'is-invalid' : ''; ?>" aria-label="form-select example" value="<?php echo $positionBI; ?>">

                    <?php 
                    if($positionBI)
                    {

                        $temps = ["Admin", "PIC", "Assistant Computer Technician", "Assistant Engineer"];
                        foreach($temps as $temp){
                            if ($positionBI == $temp){
                                echo "<option value='$temp' selected>$temp</option> ";
                            }
                        }
                      
                    }
                    else
                    {
                      ?>
                      <option value=""selected>Choose a position</option>
                      <option value="Admin">Admin</option>
                      <option value="PIC Of Room">PIC Of Room</option> 
                      <option value="Assistant Computer Technician">Assistant Computer Technician</option> 
                      <option value="Assistant Engineer">Assistant Engineer</option>
                    <?php } 
                    ?>
                    
                  </select>
                  <span class="help-block"><?php echo $positionBIErr;?></span>
              </div>
            </div>
              
          
              <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
              <script>
                  $("#position").change(function() 
                  {
                    if ($(this).val() == "PIC Of Room") 
                    {
                      $('#PIC').show();
                      $('#roomName').attr('required', '');
                      $('#roomName').attr('data-error', 'This field is required.');
                    } else 
                    {
                      $('#PIC').hide();
                      $('#roomName').removeAttr('required');
                      $('#roomName').removeAttr('data-error');
                    }
                  });
                  $("#position").trigger("change");
              </script>


        ` <div class="row">
            <div class="col-6">
            <label for="grades">Grade:</label>
                  <select name ='grades'  class="form-control <?php echo (!empty($gradesErr)) ? 'is-invalid' : ''; ?> " id='grades'value="<?php echo $grades; ?>">;
                  <option value="" selected>Choose a grade</option>;
              <?php 
                  $sql="SELECT * from grades";
                  $result=mysqli_query($conn, $sql);
                  while ($row=mysqli_fetch_array($result))
                  {
                    echo"<option value='".$row['g_gradeID']."'>".$row['g_gradeID']."</option>";
                  }

              ?>
               </select>
               <span class="help-block"><?php echo $gradesErr;?></span>
            </div>

            <div class="col-6">
                  <div class="form-label" id="PIC">
                    <label for="roomName" >Room Managed:</label>
                    <select name ='nameBI'  class='form-control' id='roomName'>;
                    <option value="" selected>Choose a room</option>
                    <?php 
                        $sql="SELECT * from rooms";
                        $result=mysqli_query($conn, $sql);

                        while ($row=mysqli_fetch_array($result))
                        {
                          echo"<option value='".$row['r_roomID']."'>".$row['r_nameBI']."</option>";
                        }
                    ?>
                     </select>";
                  </div>
              </div>
          </div><br>

          <label for="upload" class="form-label">Upload Profile Picture:</label><br>
          <input type="file" name="image" id="fileToUpload">
  </div>
</div> 
 <div class="card shadow">
    <div class="card-header py-3">
        <p class="text-primary m-0 font-weight-bold">Contact Settings</p>
    </div>
        <div class="card-body">
            <div class="mb-3">
              <label for="faddr" class="form-label">Home Address:</label>
              <input type="text" name="faddr" id="faddr" class="form-control <?php echo (!empty($addrErr)) ? 'is-invalid' : ''; ?>" placeholder="Enter Home Address"value="<?php echo $addr; ?>">
              <span class="help-block"><?php echo $addrErr;?></span>
            </div>

          <div class="row">
            <div class="col-6">
              <label for="fcontactnum" class="form-label">Contact Number:</label>
              <input type="text" name="fcontactnum" id="fcontactnum" class="form-control  <?php echo (!empty($contactErr)) ? 'is-invalid' : ''; ?>" placeholder="Enter contact number" value="<?php echo $contact; ?>">
              <span class="help-block"><?php echo $contactErr;?></span>
            </div>
 
            <div class="col-6">
              <label for="femail" class="form-label">Email Address:</label>
              <input type="text" name="femail" id="femail" class="form-control <?php echo (!empty($emailErr)) ? 'is-invalid' : ''; ?>" placeholder="Enter email address" value="<?php echo $email; ?>">
              <span class="help-block"><?php echo $emailErr;?></span>
            </div>
          </div>
        </div>
    </div>
  </div>
<a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
<br>
          <input type="submit" text-align:center name="submit" class="btn btn-primary" value="Submit"/>
          <input type="reset" name="clear" value="Clear"class="btn btn-warning">
</div>          
</form>
</body>
</html>
<?php include("../navbar/navbar2.php");?>


