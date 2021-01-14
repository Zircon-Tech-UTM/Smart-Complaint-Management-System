<?php 
    include ("../dbconfig.php");
    
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['ic']) != session_id() )
    {
        header('location: ../login/login.php');
    }

    include("GradeBack/createGraPro.php");
    include("../navbar/navbar1.php");
     
?>

  
<!DOCTYPE html>
<html lang="en">
<style>
.error {color: #FF0000;}
.help-block{color:red;}
</style>
<head>
    <title>Create Grade</title>
    
</head>
<body>
        <form action="" enctype="multipart/form-data" method="POST">
          <!--<?php //echo htmlspecialchars($_SERVER["PHP_SELF"]);?>-->
          
<div class="container-fluid">
    <h3 class="text-dark mb-4" style="font-size: 40px;">User Grade</h3>
    <div class="col">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold">Grade Settings</p>
            </div>
            <div class="card-body">
                <div class ="row">
                    <div class="col-6">
                        <label for="gradeID" class="form-label">Grade ID:</label>
                        <input type="text" name="gradeID" id="gradeID" class="form-control <?php echo (!empty($gradeIDErr)) ? 'is-invalid' : ''; ?>" placeholder="Enter Grade ID" value="<?php echo $gradeID; ?>">
                        <span class="help-block"><?php echo $gradeIDErr;?></span>
                    </div>
                </div><br>    

          <div class ="row">
              <div class="col-6">
                  <label for="positionBI" class="form-label ">Position:</label>
                  <input type="text" name="positionBI" id="positionBI" class="form-control <?php echo (!empty($positionBIErr)) ? 'is-invalid' : ''; ?>" placeholder="Enter Position in English" value="<?php echo $positionBI; ?>">
                  <span class="help-block"><?php echo $positionBIErr;?></span>
              </div>

              <div class="col-6">
                  <label for="positionBM" class="form-label">Jawatan:</label>  
                <input type="text" id="positionBM" placeholder="Enter Position in Malay" name="positionBM" class="form-control <?php echo (!empty($positionBMErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $positionBM; ?>">  
                <span class="help-block"><?php echo $positionBMErr;?></span>
              </div>
          </div><br>
        </div>
      </div>
  </div><br>
          <input type="submit" text-align:center name="submit" class="btn btn-primary" value="Submit"/>
          <input type="reset" name="clear" value="Clear"class="btn btn-warning">
</div>          
</form>
</body>
</html>
<?php include("../navbar/navbar2.php");?>


