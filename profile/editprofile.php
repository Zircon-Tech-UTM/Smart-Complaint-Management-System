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

    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
    include("editprofileprocess.php");
    include("../navbar/navbarB1.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <title><?php echo $language['User Profile']; ?></title> 
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
   <form action="editprofile.php?id=<?php echo $row["u_userIC"];?>" method="POST" enctype="multipart/form-data" >
        <div class="container-fluid">
    <h3 class="text-dark mb-4" style="font-size: 40px;"><?php echo $language['User Profile']; ?></h3>
    <div class="col">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold"><?php echo $language['User Settings']; ?></p>
            </div>
            <div class="card-body">
                <div class ="row">
                    <div class="col-6">
                        <label for="fname" class="form-label"><strong><?php echo $language['Full Name:']; ?></strong></label>
                        <input type="text" name="name" id="fname" class="form-control" placeholder="<?php echo $language['Enter Full Name']; ?>" value="<?php echo $row["name"]; ?>" readonly>
                    </div>

                    <div class="col-6">
                        <label for="fic" class="form-label <?php echo (!empty($ICErr)) ? 'is-invalid' : ''; ?>"><strong><?php echo $language['IC number:']; ?></strong></label>
                        <input type="text" name="IC" id="fic" class="form-control" placeholder="<?php echo $language['Enter IC']; ?>"value="<?php echo $row["u_userIC"]; ?>"readonly>
                    </div>
                </div><br>    

          <div class="form-group">
                    <label for="upload" class="form-label"><strong><?php echo $language['user image']; ?>:</strong></label><br>
                    <input class="form-control" type="file" name="image" onchange="readURL(this);" />
                    <img src="<?php echo "../users/".$row["u_img_path"]; ?>" id="blah" alt="<?php echo $language['user image']; ?>">
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
                      <p class="text-primary m-0 font-weight-bold"><?php echo $language['Contact Settings']; ?></p>
                  </div>
                  <div class="card-body">

            <div class="mb-3">
              <label for="faddr" class="form-label"><strong><?php echo $language['Home Address:']; ?></strong></label>
              <input type="text" name="faddr" id="faddr" class="form-control <?php echo (!empty($addrErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter Home Address']; ?>" value="<?php echo $row["address"]; ?>">
              <span class="help-block"><?php echo $addrErr;?></span>
            </div>

             <div class="row">
                <div class="col-6">
                  <label for="fcontactnum" class="form-label"><strong><?php echo $language['Contact Number:']; ?></strong></label>
                  <input type="text" name="fcontactnum" id="fcontactnum" class="form-control <?php echo (!empty($contactErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter contact number']; ?>"  value="<?php echo $row["contact"]; ?>">
                  <span class="help-block"><?php echo $contactErr;?></span>
                </div>
     
                <div class="col-6">
                  <label for="femail" class="form-label"><strong><?php echo $language['Email Address:']; ?></strong></label>
                  <input type="text" name="femail" id="femail" class="form-control <?php echo (!empty($emailErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Enter email address']; ?>" value="<?php echo $row["email"]; ?>">
                  <span class="help-block"><?php echo $emailErr;?></span>
                </div>
            </div>
 </div>
</div><br>
          <input type="submit" name="submit" class="btn btn-primary" value="<?php echo $language['Save'];?>" onclick="return confirm('<?php echo $language['Do you want to save the changes?']; ?>')"/>
          <input type="reset" name="clear" value="<?php echo $language['Reset'];?>"class="btn btn-warning">

          <a href="javascript:history.go(-1)"  class="btn btn-dark float-right" ><?php echo $language['Back']; ?></a>
</div>     
          
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
      mysqli_close($conn);
    ?>
</body>
</html>

<?php include("../navbar/navbar2.php"); ?>

