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

    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
    include("GradeBack/updateGraPro.php");
    include("../navbar/navbar1.php");
     
?>


<!DOCTYPE html>
<html lang="en">
<style>
.help-block{color:red;}
</style>
<head>
    <title>Update User Grade</title>
</head>
<body>
        <form action="updateGrade.php?id=<?php echo $row["g_gradeID"];?>" enctype="multipart/form-data" method="POST">
          
<div class="container-fluid">
    <h3 class="text-dark mb-4 font-weight-bold" style="font-size: 40px; text-align: center;"><?php echo $language['USER GRADE']; ?></h3>
    <div class="col">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold"><?php echo $language['Grade Settings']; ?></p>
            </div>
            <div class="card-body">
                <div class ="row">
                    <div class="col-md-5 col-xl-5 mb-12">
                        <label for="gradeID" class="form-label"><strong><?php echo $language['Grade ID:']; ?></strong></label>
                        <input type="text" name="gradeID" id="gradeID" class="form-control <?php echo (!empty($gradeIDErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter Grade ID']; ?>" value="<?php echo $row["g_gradeID"]; ?>">
                        <span class="help-block"><?php echo $gradeIDErr;?></span>
                    </div>
                </div><br>    

          <div class ="row">
              <div class="col-md-5 col-xl-5 mb-12">
                  <label for="positionBI" class="form-label "><strong>Position:</strong></label>
                  <input type="text" name="positionBI" id="positionBI" class="form-control <?php echo (!empty($positionBIErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter Position in English']; ?>" value="<?php echo $row["g_postBI"]; ?>">
                  <span class="help-block"><?php echo $positionBIErr;?></span>
              </div>

              <div class ="col-md-1 col-xl-1 mb-1"><br></div>
              <div class="col-md-5 col-xl-5 mb-12">
                  <label for="positionBM" class="form-label"><strong>Jawatan:</strong></label>  
                <input type="text" id="positionBM" placeholder="<?php echo $language['Enter Position in Malay']; ?>" name="positionBM" class="form-control <?php echo (!empty($positionBMErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $row["g_postBM"]; ?>">  
                <span class="help-block"><?php echo $positionBMErr;?></span>
              </div>
          </div><br>
        </div>
      </div>
  </div><br>
                    <input type="submit" name="submit" onclick="return confirm('<?php echo $language['Do you want to save the changes?']; ?>')" class="btn btn-primary" value="Save">
                    <input type="reset" name="clear" value="<?php echo $language['Reset']; ?>"class="btn btn-warning"> 
                    <a href="readGrade.php" class="btn btn-danger float-right"><?php echo $language['Cancel']; ?></a> 
</div>          
</form>
</body>
</html>
<?php include("../navbar/navbar2.php"); } ?>


