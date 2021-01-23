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

    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");

    include("GradeBack/createGraPro.php");

    include("../navbar/navbar1.php");
     
?>

  
<!DOCTYPE html>
<html lang="en">
<style>
.help-block{color:red;}
</style>
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <title style="text-align: center;"><?php echo $language['Create Grade']; ?></title>
    
</head>
<body>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" enctype="multipart/form-data" method="POST">
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
                        <input type="text" name="gradeID" id="gradeID" class="form-control <?php echo (!empty($gradeIDErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter Grade ID']; ?>" value="<?php echo $gradeID; ?>">
                        <span class="help-block"><?php echo $gradeIDErr;?></span>
                    </div>
                </div><br>    

          <div class ="row">
              <div class="col-md-5 col-xl-5 mb-12">
                  <label for="positionBI" class="form-label "><strong>Position:</strong></label>
                  <input type="text" name="positionBI" id="positionBI" class="form-control <?php echo (!empty($positionBIErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter Position in English']; ?>" value="<?php echo $positionBI; ?>">
                  <span class="help-block"><?php echo $positionBIErr;?></span>
              </div>

              <div class ="col-md-1 col-xl-1 mb-1"><br></div>
              <div class="col-md-5 col-xl-5 mb-12">
                  <label for="positionBM" class="form-label"><strong>Jawatan:</strong></label>  
                <input type="text" id="positionBM" placeholder="<?php echo $language['Enter Position in Malay']; ?>" name="positionBM" class="form-control <?php echo (!empty($positionBMErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $positionBM; ?>">  
                <span class="help-block"><?php echo $positionBMErr;?></span>
              </div>
          </div><br>
        </div>
      </div>
  </div><br>
          <input type="submit" text-align:center name="submit" class="btn btn-primary" value="<?php echo $language['Submit']; ?>"/>
          <input type="reset" name="clear" value="<?php echo $language['Clear']; ?>"class="btn btn-warning">
          <a href="readGrade.php" class="btn btn-danger float-right"><?php echo $language['Cancel']; ?></a>
</div>          
</form>
</body>
</html>
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
<?php include("../navbar/navbar2.php");?>


