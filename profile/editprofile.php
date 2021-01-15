<?php 
    require_once("../dbconfig.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../login/login.php');
    }

    if ($_SESSION["userType"] == '1'){
      exit();
    }

    $id ="";
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
    }else if (isset($_POST['id'])){
      $id = $_POST['id'];
    }

    // if ($_SESSION["ic"] != $id){
    //   exit();
    // }

    $sql = "SELECT * FROM users WHERE u_userIC='".$id."';";

    $result = mysqli_query($conn, $sql);

    if (!$result)
    {
      echo "ERROR:  $conn->error";
      exit();
    } 
    $row = mysqli_fetch_array($result);
    if (isset($row["u_img_path"]))
      $_SESSION["remove"] = $row["u_img_path"];

    include("editprofileprocess.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
</head>
<style>
  img{
    width: 200px;
    height: 200px;
  }
  .help-block{
    color: red;
  }
</style>
<body>
    <div class="container">

    <form action="editprofile.php?id=<?php echo $id; ?>" enctype="multipart/form-data" method="POST">
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
                            <input type="text" name="name" id="fname" class="form-control" placeholder="Enter Full Name" value="<?php echo $row["name"]; ?>" readonly>
                        </div>

                        <div class="col-6">
                            <label for="fic" class="form-label <?php echo (!empty($ICErr)) ? 'is-invalid' : ''; ?>">IC number:</label>
                            <input type="text" name="IC" id="fic" class="form-control" placeholder="Enter IC Number"value="<?php echo $row["u_userIC"]; ?>"readonly>
                            <input type="hidden" name="id" value="<?php echo $row["u_userIC"]; ?>">
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
                          <input type="password" name="password" id="password" class="form-control <?php echo (!empty($passwordErr)) ? 'is-invalid' : ''; ?>" title="Enter at least 4 characters." placeholder="Enter password" value="<?php echo $row["pwd"]; ?>" >
                          <span class="help-block"><?php echo $passwordErr;?></span>
                      </div>

                      <div class="col-6">
                          <label for="psw-repeat" class="form-label">Re-type Password:<span id='message'></span></label>  
                          <input type="password" id="confirm_password" placeholder="Retype Password" name="confirm_password" class="form-control  <?php echo (!empty($confirm_passwordErr)) ? 'is-invalid' : ''; ?>" onkeyup='check();'value="<?php echo $row["pwd"]; ?>">
                          <span class="help-block"><?php echo $confirm_passwordErr;?></span>  
                      </div>
                  </div><br>

                  <div class="form-group">
                    <label for="upload" class="form-label">Upate Profile Picture:</label><br>
                    <input class="input-group" type="file" name="image" onchange="readURL(this);" />
                    Current Image: <img src="<?php echo "../users/".$row["u_img_path"]; ?>" id="blah" alt="current picture">
                  </div><br>
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
                    <p class="text-primary m-0 font-weight-bold">Contact Settings</p>
                </div>
                <div class="card-body">

                  <div class="mb-3">
                    <label for="faddr" class="form-label">Home Address:</label>
                    <input type="text" name="faddr" id="faddr" class="form-control <?php echo (!empty($addrErr)) ? 'is-invalid' : ''; ?>" placeholder="Enter Home Address" value="<?php echo $row["address"]; ?>">
                    <span class="help-block"><?php echo $addrErr;?></span>
                  </div>

                  <div class="row">
                      <div class="col-6">
                        <label for="fcontactnum" class="form-label">Contact Number:</label>
                        <input type="text" name="fcontactnum" id="fcontactnum" class="form-control <?php echo (!empty($contactErr)) ? 'is-invalid' : ''; ?>" placeholder="Enter contact number"  value="<?php echo $row["contact"]; ?>">
                        <span class="help-block"><?php echo $contactErr;?></span>
                      </div>
                
                      <div class="col-6">
                        <label for="femail" class="form-label">Email Address:</label>
                        <input type="text" name="femail" id="femail" class="form-control <?php echo (!empty($emailErr)) ? 'is-invalid' : ''; ?>" placeholder="Enter email address"value="<?php echo $row["email"]; ?>">
                        <span class="help-block"><?php echo $emailErr;?></span>
                      </div>
                  </div>
                </div>
            </div><br>
                      
            <input type="submit" name="submit" class="btn btn-primary" value="Save" onclick="return confirm('Do you want to save the changes?')"/>

            <a href="javascript:history.go(-1)"  class="btn btn-info" >Cancel</a>
          
    </form>
        
    </div>

    <?php 

      if (!empty($sqlErr)){
    ?>
      <script>
        let error = "<?php echo $sqlErr; ?>";
        alert(error);

      </script>
    <?php
      }
    ?>
</body>
</html>

