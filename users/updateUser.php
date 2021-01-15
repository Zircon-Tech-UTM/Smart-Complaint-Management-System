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
    
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE u_userIC=".$id.";";

        $result = mysqli_query($conn, $sql);

        if (!$result){echo "ERROR:  $conn->error";
            header("refresh: 6; location: readUser.php");
        } 

        $row = mysqli_fetch_array($result);

    include("UsersBack/updateUserPro.php");
    include("../navbar/navbar1.php");
     
?>


<!DOCTYPE html>
<html lang="en">
<style>
.error {color: #FF0000;}
.help-block{color:red;}
</style>
<head>
    <title>Update User</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
        <form action="" method="POST">
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
                        <input type="text" name="name" id="fname" class="form-control <?php echo (!empty($usernameErr)) ? 'is-invalid' : ''; ?> " placeholder="Enter Full Name" value="<?php echo $row["name"]; ?>">
                        <span class="help-block"><?php echo $usernameErr;?></span>
                    </div>

                    <div class="col-6">
                        <label for="fic" class="form-label <?php echo (!empty($ICErr)) ? 'is-invalid' : ''; ?>">IC number:</label>
                        <input type="text" name="IC" id="fic" class="form-control  <?php echo (!empty($ICErr)) ? 'is-invalid' : ''; ?>" placeholder="Enter IC Number"value="<?php echo $row["u_userIC"]; ?>">
                        <span class="help-block"required><?php echo $ICErr;?></span>
                    </div>
                </div><br>

              <div class="row">
                <div class="col-6">
                  <label for="position">Position Assigned:</label>
                  <select name="position" id="position" class="form-control <?php echo (!empty($positionBIErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $row["postBI"]; ?>">
                      <option value="" selected>Choose a position</option>
                      <?php 
                        $temps = ["Admin", "PIC Of Room", "Assistant Computer Technician", "Assistant Engineer"];
                        foreach($temps as $temp){
                            if ($row["postBI"] == $temp){
                                echo "<option value='$temp' selected>$temp</option> ";
                            } else {
                                echo "<option value='$temp'>$temp</option> ";
                            }
                        }
                      ?>
                  </select>
                  <span class="help-block"><?php echo $positionBIErr;?></span>
              </div>
                
            </div>
            <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
              <script>
                  $("#position").change(function() 
                  {
                    if ($(this).val() == "PIC") 
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

          <br><div class="row">
            <div class="col-6">
            <label for="grades">Grade:</label>
            <select name ='grades'  class="form-control <?php echo (!empty($gradesErr)) ? 'is-invalid' : ''; ?> " id='grades' >";
              <?php 
                  $sql1="SELECT * from grades";
                  $result1=mysqli_query($conn, $sql1);
                  while ($row1=mysqli_fetch_array($result1))
                  {
                    if($row1['g_gradeID']==$row['u_grade'])
                    {
                        echo"<option selected='selected' value='".$row1['g_gradeID']."'>".$row1['g_gradeID']."</option>";
                    }
                    else
                    {
                        echo"<option value='".$row1['g_gradeID']."'>".$row1['g_gradeID']."</option>";
                    }
                  }
              ?>
            </select>
              <span class="help-block"><?php echo $gradesErr;?></span>
            </div>
            <div class="col-6">
                  <div class="form-label" id="PIC">
                    <label for="roomName" >Room Managed:</label>
                    <?php 
                        $sql2="SELECT * from rooms";
                        $result2=mysqli_query($conn, $sql2);

                        echo"<select name ='nameBI'  class='form-control' id='roomName'>";
                        echo"<option selected disabled>Choose a room</option>";
                        while ($row2=mysqli_fetch_array($result2))
                        {
                            if($row2['PIC']==$row['u_userIC'])
                            {
                                echo"<option selected='selected' value='".$row2['r_roomID']."'>".$row2['r_nameBI']."</option>";
                            }
                            else
                            {
                                echo"<option value='".$row2['r_roomID']."'>".$row2['r_nameBI']."</option>";
                            }
                        }
                        echo"</select>";
                    ?>
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
                  <span class="help-block"><?php echo $contactErr;?></span>
                </div>
            </div>
 </div>
</div><br>
          <input type="submit" text-align:center name="submit" class="btn btn-primary" value="Submit"/>
          <a href="../index.php" class="btn btn-warning">Cancel</a>
</div>     
          
        </form>
    </div>

</body>
</html>

<?php include("../navbar/navbar2.php"); } ?>

