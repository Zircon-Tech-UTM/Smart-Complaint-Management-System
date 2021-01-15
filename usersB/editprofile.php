<?php 
    include("../dbconfig.php");

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

        if (!$result)
        {
          echo "ERROR:  $conn->error";
          exit();
        } 

        $row = mysqli_fetch_array($result);

    include("editprofileprocess.php");
    include("../navbar/navbarB1.php");
    
?>

<!DOCTYPE html>
<html lang="en">
<style>
.error {color: #FF0000;}
.help-block{color:red;}
</style>
<head>
    <title>User Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
   <form action="" method="POST">
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
                  <span class="help-block"><?php echo $emailErr;?></span>
                </div>
            </div>
 </div>
</div><br>
          <input type="submit" text-align:center name="submit" class="btn btn-primary" value="Save"/>
          <a href="../indexB.php" class="btn btn-warning">Cancel</a>
</div>     
          
        </form>
    </div>

</body>
</html>

<?php include("../navbar/navbar2.php"); } ?>

