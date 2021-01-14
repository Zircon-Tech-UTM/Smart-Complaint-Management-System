<?php 
    require_once("../dbconfig.php");

    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['ic']) != session_id() )
    {
        header('location: ../login/login.php');
    }
    
    if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM grades WHERE g_gradeID='".$id."';"; 

        $result = mysqli_query($conn, $sql);

        if (!$result){echo "ERROR:  $conn->error";
            header("refresh: 6; location: readGrade.php");
        } 
    
    $row = mysqli_fetch_array($result);

    include("GradeBack/updateGraPro.php");
    include("../navbar/navbar1.php");
     
?>


<!DOCTYPE html>
<html lang="en">
<style>
.error {color: #FF0000;}
.help-block{color:red;}
</style>
<head>
    <title>Update User Grade</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
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
                        <input type="text" name="gradeID" id="gradeID" class="form-control <?php echo (!empty($gradeIDErr)) ? 'is-invalid' : ''; ?>" placeholder="Enter Grade ID" value="<?php echo $row["g_gradeID"]; ?>">
                        <span class="help-block"><?php echo $gradeIDErr;?></span>
                    </div>
                </div><br>    

          <div class ="row">
              <div class="col-6">
                  <label for="positionBI" class="form-label ">Position:</label>
                  <input type="text" name="positionBI" id="positionBI" class="form-control <?php echo (!empty($positionBIErr)) ? 'is-invalid' : ''; ?>" placeholder="Enter Position in English" value="<?php echo $row["g_postBI"]; ?>">
                  <span class="help-block"><?php echo $positionBIErr;?></span>
              </div>

              <div class="col-6">
                  <label for="positionBM" class="form-label">Jawatan:</label>  
                <input type="text" id="positionBM" placeholder="Enter Position in Malay" name="positionBM" class="form-control <?php echo (!empty($positionBMErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $row["g_postBM"]; ?>">  
                <span class="help-block"><?php echo $positionBMErr;?></span>
              </div>
          </div><br>
        </div>
      </div>
  </div><br>
          <input type="submit"  name="submit" class="btn btn-primary" value="Save">
          <a href="readGrade.php" class="btn btn-primary">Cancel</a>
</div>          
</form>
</body>
</html>
<?php include("../navbar/navbar2.php"); } ?>


