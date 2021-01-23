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

    if ($_SESSION["userType"] != '1'){
        exit();
    }

    $sql1 = "SELECT * FROM users WHERE u_userIC=".$_SESSION['ic'].";";

    $result1 = mysqli_query($conn, $sql1);

    if (!$result1)
    {
        echo "ERROR:  $conn->error";
        header("refresh: 6; location: readUser.php");
    } 

    $row1 = mysqli_fetch_array($result1);

    
    
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
    include("createblockprocess.php");
    include ('..\navbar\navbar1.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
<style>
/* The message box is shown when the user clicks on the password field */
#error {
  display:none;
  background: #f1f1f1;
  color: #000;
  position: relative;
  padding: 20px;
  margin-top: 10px;
}

#error p {
  padding: 10px 35px;
  font-size: 18px;
}

/* Add a green text color and a checkmark when the requirements are right */
.valid {
  color: green;
}

.valid:before {
  position: relative;
  left: -35px;
  content: "✔";
}

/* Add a red text color and an "x" when the requirements are wrong */
.invalid {
  color: red;
}

.invalid:before {
  position: relative;
  left: -35px;
  content: "✖";
}

  .help-block{
        color: red;
    }
</style>
    <meta charset="UTF-8">
    <title><?php echo $language['New Block'];?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>    
</head>
<body>
    <script>
        $('.lang').click(function(){

                    $.ajax({
                        type: 'POST',
                        url: 'testing.php',
                        success: function(data) {
                            alert(data);
                        }
                    });
        });
    </script>
    <div class="container">
        <h1 class="text m-0 font-weight-bold" style = "text-align: center;"><?php echo $language["title"];?></h1><hr>
        <form method="POST" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">          
            <div class="container-fluid">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold"><?php echo $language["BLOCK'S DETAILS"];?></p>
                        </div>
                        <div class="card-body">
                            <div class ="row">
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="block_no"><strong><?php echo $language['Block ID'];?></strong></label>
                                    <input type="text" class="form-control <?php echo (!empty($b_block_noErr)) ? 'is-invalid' : ''; ?>" id="block_no" placeholder="Enter block ID" name="block_no">
                                    <span class="help-block"><?php echo $b_block_noErr;?></span>
                                </div>
                                <div class ="col-md-1 col-xl-1 mb-1"><br></div>
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="location"><strong><?php echo $language['Location'];?></strong></label><br>
                                    <select name = 'loc' class="form-control <?php echo (!empty($b_locErr)) ? 'is-invalid' : ''; ?>" aria-label="Disabled select example">
                                        <option selected disabled>Location</option>";
                                        <option value="1"><?php echo $language['Hostel'];?></option>
                                        <option value="2"><?php echo $language['College'];?></option>
                                        <option value="3"><?php echo $language['Others'];?></option>
                                    </select> 
                                    <span class="help-block"><?php echo$b_locErr;?></span>            
                                </div>
                            </div>
                            <br>
                            <div class ="row">
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="name"><strong><?php echo $language['Block Name(English)'];?></strong></label>
                                    <input type="text" class="form-control <?php echo (!empty($b_nameBIErr)) ? 'is-invalid' : ''; ?>" id="nameBI" placeholder="Enter name in English" name="nameBI">
                                    <span class="help-block"><?php echo $b_nameBIErr;?></span>
                                </div>

                                <div class ="col-md-1 col-xl-1 mb-1"><br></div>
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="nama"><strong><?php echo $language['Block Name(Malay)'];?></strong></label>
                                    <input type="text" class="form-control <?php echo (!empty($b_nameBMErr)) ? 'is-invalid' : ''; ?>" id="nameBM" placeholder="Enter name in Malay" name="nameBM">
                                    <span class="help-block"><?php echo $b_nameBMErr;?></span>
                                </div>
                            </div>
                            <br>
                        </div><br>    
                    </div>                        
                    <input type="submit" text-align:center name="submit" class="btn btn-primary" value="<?php echo $language['Submit'];?>"/>
                    <input type="reset" name="clear" value="<?php echo $language['Clear'];?>"class="btn btn-warning">       
                    <a href="blocklist.php" class="btn btn-danger float-right"><?php echo $language['Cancel'];?></a>       
                </div>                    
            </div>                 
        </form>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    <br>
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
<?php include ('..\navbar\navbar2.php');?>