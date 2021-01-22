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

    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
    include("UsersBack/createUserPro.php");
    include("../navbar/navbar1.php");
     
?>

  
<!DOCTYPE html>
<html lang="en">
<style>
.help-block{color:red;}
</style>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <title><?php echo $language['New User']; ?></title>
</head>
<body id="page-top">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
          
<div class="container-fluid">
    <h3 class="text-dark mb-4" style="font-size: 40px;"><?php echo $language['User Information']; ?></h3>
    <div class="col">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold"><?php echo $language['User Settings']; ?></p>
            </div>
            <div class="card-body">
                <div class ="row">
                    <div class="col-md-5 col-xl-5 mb-12">
                        <label for="fname" class="form-label"><strong><?php echo $language['Full Name:']; ?></strong></label>
                        <input type="text" name="name" id="fname" class="form-control <?php echo (!empty($usernameErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter Full Name']; ?>" value="<?php echo $username; ?>">
                        <span class="help-block"><?php echo $usernameErr;?></span>
                    </div>

                    <div class ="col-md-1 col-xl-1 mb-1"><br></div>
                    <div class="col-md-5 col-xl-5 mb-12">
                        <label for="fic" class="form-label <?php echo (!empty($ICErr)) ? 'is-invalid' : ''; ?>"><strong><?php echo $language['IC number:']; ?></strong></label>
                        <input type="text" name="IC" id="fic" class="form-control <?php echo (!empty($ICErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter IC']; ?>" value="<?php echo $IC; ?>">
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

              function myFunction1() 
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

          <div class ="row">
              <div class="col-md-5 col-xl-5 mb-12">
                  <label for="pwd" class="form-label "><strong><?php echo $language['Password:']; ?></strong></label>
                  <input type="password" name="password" id="password" class="form-control <?php echo (!empty($passwordErr)) ? 'is-invalid' : ''; ?>" title="Enter at least 4 characters." placeholder="<?php echo $language['Enter Password']; ?>" value="<?php echo $password; ?>">
                  <span class="help-block"><?php echo $passwordErr;?></span>
                  <input type="checkbox" onclick="myFunction1()"><?php echo $language['Show Password:']; ?>
              </div>

              <div class ="col-md-1 col-xl-1 mb-1"><br></div>
              <div class="col-md-5 col-xl-5 mb-12">
                  <label for="psw-repeat" class="form-label"><strong><?php echo $language['Re-type Password']; ?>:</strong><span id='message'></span></label>  
                <input type="password" id="confirm_password" placeholder="<?php echo $language['Re-type Password']; ?>" name="confirm_password" class="form-control <?php echo (!empty($confirm_passwordErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $confirm_password; ?>"onkeyup='check();'>  
                <span class="help-block"><?php echo $confirm_passwordErr;?></span>
                <input type="checkbox" onclick="myFunction2()"> <?php echo $language['Show Password:']; ?>
              </div>
          </div><br>

              <div class="row">
                <div class="col-md-5 col-xl-5 mb-12">
                  <label for="position" class="form-label"><strong><?php echo $language['Position Assigned:']; ?></strong></label>
                  <select name="position" id="position" class="form-control <?php echo (!empty($positionBIErr)) ? 'is-invalid' : ''; ?>" aria-label="form-select example" value="<?php echo $positionBI; ?>">

                    <?php 
                    if($positionBI)
                    {

                        $temps = [$language['Admin'], $language['PIC'], $language['Assistant Computer Technician'], $language['Assistant Engineer']];
                        foreach($temps as $temp){
                            if ($positionBI == $temp){
                                echo "<option value='$temp' selected>$temp</option> ";
                            }
                        }
                      
                    }
                    else
                    {
                      ?>
                      <option value=""selected><?php echo $language['Choose a position']; ?></option>
                      <option value="<?php echo $language['Admin']; ?>"><?php echo $language['Admin']; ?></option>
                      <option value="<?php echo $language['PIC Of Room']; ?>"><?php echo $language['PIC Of Room']; ?></option> 
                      <option value="<?php echo $language['Assistant Computer Technician']; ?>"><?php echo $language['Assistant Computer Technician']; ?></option> 
                      <option value="<?php echo $language['Assistant Engineer']; ?>"><?php echo $language['Assistant Engineer']; ?></option>
                    <?php } 
                    ?>
                    
                  </select>
                  <span class="help-block"><?php echo $positionBIErr;?></span><br>
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

          <div class="row">
            <div class="col-md-5 col-xl-5 mb-12">
            <label for="grades"><strong><?php echo $language['Grade:']; ?></strong></label>
                  <select name ='grades'  class="form-control <?php echo (!empty($gradesErr)) ? 'is-invalid' : ''; ?> " aria-label="form-select example" id='grades'value="<?php echo $grades; ?>">;
                  <option value="" selected><?php echo $language['Choose a grade']; ?></option>;
              <?php 
                  $sql="SELECT * from grades";
                  $result=mysqli_query($conn, $sql);
                  while ($row=mysqli_fetch_array($result))
                  {
                    echo"<option value='".$row['g_gradeID']."'>".$row['g_post'.$_SESSION["language"].'']."(".$row['g_gradeID'].")</option>";
                  }

              ?>
              </select>
              <span class="help-block"><?php echo $gradesErr;?></span>
            </div>

            <!-- <div class ="col-md-1 col-xl-1 mb-1"><br></div>
            <div class="col-md-5 col-xl-5 mb-12">
                  <div class="form-label" id="PIC">
                    <label for="roomName" ><?php echo $language['Room Managed:']; ?></label>
                    <select name ='nameBI'  class='form-control' id='roomName'>;
                    <option value="" selected><?php echo $language['Choose a room']; ?></option>
                    <?php 
                        // $sql="SELECT * from rooms";
                        // $result=mysqli_query($conn, $sql);

                        // while ($row=mysqli_fetch_array($result))
                        // {
                        //   if ($_SESSION['language'] == 'BI'){
                        //       echo"<option value='".$row['r_roomID']."'>".$row['r_nameBI']."</option>";
                        //   }else if ($_SESSION['language'] == 'BM'){
                        //       echo"<option value='".$row['r_roomID']."'>".$row['r_nameBM']."</option>";
                        //   }else{
                        //       echo"<option value='".$row['r_roomID']."'>".$row['r_nameBM']."</option>";
                        //   }
                        // }
                    ?>
                     </select>
                  </div>
              </div>
          </div><br> -->
                          <br><br>
                    <div class="form-group">
                        <label class="control-label"><strong><?php echo $language['user image']; ?></strong></label>
                        <input class="form-control <?php echo (!empty($errMSG)) ? 'is-invalid' : ''; ?>" type="file" name="image" onchange="readURL(this);" />
                        <img id="blah" src="#" alt="<?php echo $language['user image']; ?>" />
                        <span class="help-block"><?php echo $errMSG;?></span>
                    </div>
                    <script>
                      function readURL(input) {
                          if (input.files && input.files[0]) {
                              var reader = new FileReader();

                              reader.onload = function (e) {
                                  $('#blah')
                                      .attr('src', e.target.result)
                                      .width(150)
                                      .height(200);
                              };

                              reader.readAsDataURL(input.files[0]);
                          }
                      }
                    </script>
                </div>
              </div> 
               <div class="card shadow">
                  <div class="card-header py-3">
                      <p class="text-primary m-0 font-weight-bold"><?php echo $language['Contact Settings']; ?></p>
                  </div>
                      <div class="card-body">
                          <div class="mb-3">
                            <label for="faddr" class="form-label"><strong><?php echo $language['Home Address:']; ?></strong></label>
                            <input type="text" name="faddr" id="faddr" class="form-control <?php echo (!empty($addrErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter Home Address']; ?>"value="<?php echo $addr; ?>">
                            <span class="help-block"><?php echo $addrErr;?></span>
                          </div>

                        <div class="row">
                          <div class="col-md-5 col-xl-5 mb-12">
                            <label for="fcontactnum" class="form-label"><strong><?php echo $language['Contact Number:']; ?></strong></label>
                            <input type="text" name="fcontactnum" id="fcontactnum" class="form-control  <?php echo (!empty($contactErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter contact number']; ?>" value="<?php echo $contact; ?>">
                            <span class="help-block"><?php echo $contactErr;?></span>
                          </div>
                          
                          <div class ="col-md-1 col-xl-1 mb-1"><br></div>
                          <div class="col-md-5 col-xl-5 mb-12">
                            <label for="femail" class="form-label"><strong><?php echo $language['Email Address:']; ?></strong></label>
                            <input type="text" name="femail" id="femail" class="form-control <?php echo (!empty($emailErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter email address']; ?>" value="<?php echo $email; ?>">
                            <span class="help-block"><?php echo $emailErr;?></span>
                          </div>
                        </div>
                      </div>
                  </div>
                </div>
          <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
          <br>
          <input type="submit" name="submit" class="btn btn-primary" value="<?php echo $language['Submit']; ?>"/>
          <input type="reset" name="clear" value="<?php echo $language['Clear']; ?>"class="btn btn-warning">
          <a href="readUser.php" class="btn btn-danger float-right"><?php echo $language['Cancel']; ?></a>
</div>          
</form>
</body>
</html>
<?php include("../navbar/navbar2.php");?>


