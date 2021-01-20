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

    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
    include("UsersBack/updateUserPro.php");
    include("../navbar/navbar1.php");
     
?>

<!DOCTYPE html>
<html lang="en">
<style>
.help-block{color:red;}
</style>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <title><?php echo $language['Update User']; ?></title>
</head>
<body>
        <form action="updateUser.php?id=<?php echo $row["u_userIC"];?>"  enctype="multipart/form-data"  method="POST">
          
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
                        <label for="fname" class="form-label"><?php echo $language['Full Name:']; ?></label>
                        <input type="text" name="name" id="fname" class="form-control <?php echo (!empty($usernameErr)) ? 'is-invalid' : ''; ?> " placeholder="<?php echo $language['Enter Full Name']; ?>" value="<?php echo $row["name"]; ?>">
                        <span class="help-block"><?php echo $usernameErr;?></span>
                    </div>

                    <div class ="col-md-1 col-xl-1 mb-1"><br></div>
                    <div class="col-md-5 col-xl-5 mb-12">
                        <label for="fic" class="form-label <?php echo (!empty($ICErr)) ? 'is-invalid' : ''; ?>"><?php echo $language['IC number:']; ?></label>
                        <input type="text" name="IC" id="fic" class="form-control  <?php echo (!empty($ICErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter IC']; ?>"value="<?php echo $row["u_userIC"]; ?>">
                        <span class="help-block"required><?php echo $ICErr;?></span>
                    </div>
                </div><br>

              <div class="row">
                <div class="col-md-5 col-xl-5 mb-12">
                  <label for="position"><?php echo $language['Position Assigned:']; ?></label>
                  <select name="position" id="position" class="form-control <?php echo (!empty($positionBIErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $row["postBI"]; ?>">
                      <option value="" selected><?php echo $language['Choose a position']; ?></option>
                      <?php 
                        $temps = [$language['Admin'], $language['PIC'], $language['Assistant Computer Technician'], $language['Assistant Engineer']];
                        foreach($temps as $temp){
                            if ($row["postBI"] == $temp){
                                echo "<option value='$temp' selected>$temp</option> ";
                            }if ($row["postBM"] == $temp){
                                echo "<option value='$temp' selected>$temp</option> ";
                            }
                            else {
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
            <div class="col-md-5 col-xl-5 mb-12">
            <label for="grades"><?php echo $language['Grade:']; ?></label>
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

            <!-- <div class ="col-md-1 col-xl-1 mb-1"><br></div>
            <div class="col-md-5 col-xl-5 mb-12">
                  <div class="form-label" id="PIC">
                    <label for="roomName"><?php echo $language['Room Managed:']; ?></label>
                    <select name ='nameBI'  class='form-control' id='roomName'>;
                      <option selected disabled> <?php echo $language['Choose a room'] ?></option>;
                    <?php 
                        // $sql2="SELECT * from rooms";
                        // $result2=mysqli_query($conn, $sql2);
                        
                        // while ($row2=mysqli_fetch_array($result2))
                        // {
                        //     if($row2['PIC']==$row['u_userIC'])
                        //     {
                        //         echo"<option selected='selected' value='".$row2['r_roomID']."'>".$row2['r_nameBI']."</option>";
                        //     }
                        //     else
                        //     {
                        //         echo"<option value='".$row2['r_roomID']."'>".$row2['r_nameBI']."</option>";
                        //     }
                        // }
                    ?>
                  </select>
                  </div>
              </div>
          </div><br> -->

                <!-- <div class="form-group">
                    <label class="control-label"><?php echo $language['user image']; ?></label>
                    <input class="input-group <?php echo (!empty($errMSG)) ? 'is-invalid' : ''; ?>" type="file" name="image" onchange="readURL(this);" />
                    <img id="blah" src="<?php echo $row["u_img_path"];?>" alt="<?php echo $language['user image']; ?>" />
                    <span class="help-block"><?php echo $errMSG;?></span>
                </div> -->
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
              <label for="faddr" class="form-label"><?php echo $language['Home Address:']; ?></label>
              <input type="text" name="faddr" id="faddr" class="form-control <?php echo (!empty($addrErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter Home Address']; ?>" value="<?php echo $row["address"]; ?>">
              <span class="help-block"><?php echo $addrErr;?></span>
            </div>

             <div class="row">
                <div class="col-md-5 col-xl-5 mb-12">
                  <label for="fcontactnum" class="form-label"><?php echo $language['Contact Number:']; ?></label>
                  <input type="text" name="fcontactnum" id="fcontactnum" class="form-control <?php echo (!empty($contactErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter contact number']; ?>"  value="<?php echo $row["contact"]; ?>">
                  <span class="help-block"><?php echo $contactErr;?></span>
                </div>
                
                <div class ="col-md-1 col-xl-1 mb-1"><br></div>
                <div class="col-md-5 col-xl-5 mb-12">
                  <label for="femail" class="form-label"><?php echo $language['Email Address:']; ?></label>
                  <input type="text" name="femail" id="femail" class="form-control <?php echo (!empty($emailErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter email address']; ?>"value="<?php echo $row["email"]; ?>">
                  <span class="help-block"><?php echo $contactErr;?></span>
                </div>
            </div>
 </div>
</div><br>

</div>     
          <input type="submit" name="submit" class="btn btn-primary" value="<?php echo $language['Submit']; ?>"/>
          <input type="reset" name="clear" value="<?php echo $language['Clear']; ?>"class="btn btn-warning">
          <a href="readUser.php" class="btn btn-danger float-right"><?php echo $language['Cancel']; ?></a>
        </form>
    </div>

</body>
</html>

<?php include("../navbar/navbar2.php"); } ?>

