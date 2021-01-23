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

    if(isset($_GET['id']))
    {
        $bid = $_GET['id'];
    }else if(isset($_POST['id']))
    {
        $bid = $_POST['id'];
    }

    $sql1 = "SELECT * FROM users WHERE u_userIC=".$_SESSION['ic'].";";

    $result1 = mysqli_query($conn, $sql1);

    if (!$result1)
    {
        echo "ERROR:  $conn->error";
        header("refresh: 6; location: readUser.php");
    } 

    $row1 = mysqli_fetch_array($result1);

    $sql = "SELECT * FROM blocks
            WHERE block_no = '$bid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);


    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
    include("blockmodifyprocess.php");
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
    <title><?php echo $language['Edit Block'];?></title>
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
        <h1 class="text m-0 font-weight-bold" style = "text-align: center;"><?php echo $language['EDIT BLOCK'];?></h1><hr>
        <form method="POST" enctype="multipart/form-data" action="blockmodify.php?id=<?php echo $bid; ?>">          
            <div class="container-fluid">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold"><?php echo $language["BLOCK'S DETAILS"];?></p>
                        </div>
                        <div class="card-body">
                            <div class ="row">
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="block_no"><?php echo $language['Block ID'];?></label>
                                    <input type="text" class="form-control <?php echo (!empty($b_block_noErr)) ? 'is-invalid' : ''; ?>" id="block_no" placeholder="Enter block ID" name="block" value = "<?php echo $row['block_no'];?>"disabled>
                                    <span class="help-block"><?php echo $b_block_noErr;?></span>
                                </div>
                                <input type="hidden" class="form-control" id="block_no" placeholder="Enter block ID" name="block" value = "<?php echo $row['block_no'];?>">

                                <div class ="col-md-1 col-xl-1 mb-1"><br></div>
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="location"><?php echo $language['Location'];?></label>
                                    <select name = 'loc' class="form-select <?php echo (!empty($b_locErr)) ? 'is-invalid' : ''; ?>" aria-label="Default select example">
                                    <option selected>Location</option>
                                        <?php
                                        $array = ['1','2', '3'];
                                        foreach($array as $arr)
                                        {
                                            if($arr == $row['location'])
                                            {
                                                echo"<option selected = 'selected' value=".$arr.">";
                                                if($arr == '1')
                                                {
                                                    echo $language['Hostel'];
                                                }
                                                else if($arr == '2')
                                                {
                                                    echo $language['College'];
                                                }
                                                else if($arr == '3')
                                                {
                                                    echo $language['Others'];
                                                }
                                                echo "</option>";
                                            }
                                            else
                                            {
                                                echo"<option value=".$arr.">";
                                                if($arr == '1')
                                                {
                                                    echo $language['Hostel'];
                                                }
                                                else if($arr == '2')
                                                {
                                                    echo $language['College'];
                                                }
                                                else if($arr == '3')
                                                {
                                                    echo $language['Others'];
                                                }
                                                echo "</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                    <span class="help-block"><?php echo$b_locErr;?></span>             
                                </div>
                            </div>
                            <br>
                            <div class ="row">
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="name"><?php echo $language['Block Name(English)'];?></label>
                                    <input type="text" class="form-control <?php echo (!empty($b_nameBIErr)) ? 'is-invalid' : ''; ?>" id="nameBI" placeholder="Enter name in English" name="nameBI" value = "<?php echo $row['b_nameBI'];?>">
                                    <span class="help-block"><?php echo $b_nameBIErr;?></span>
                                </div>
                                <div class ="col-md-1 col-xl-1 mb-1"><br></div>
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="nama"><?php echo $language['Block Name(Malay)'];?></label>
                                    <input type="text" class="form-control <?php echo (!empty($b_nameBMErr)) ? 'is-invalid' : ''; ?>" id="nameBM" placeholder="Enter name in Malay" name="nameBM" value = "<?php echo $row['b_nameBM'];?>">
                                    <span class="help-block"><?php echo $b_nameBMErr;?></span>
                                </div>
                            </div>
                            <br>
                        </div><br>    
                    </div>                        
                    <input type="submit" text-align:center name="submit" onclick="return confirm('<?php echo $language['Do you want to save the changes?']; ?>')" class="btn btn-primary" value="<?php echo $language['Save'];?>"/>
                    <input type="reset" name="clear" value="<?php echo $language['Reset'];?>"class="btn btn-warning"> 
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