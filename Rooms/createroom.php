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

    include ("createroomprocess.php");
    include ('..\navbar\navbar1.php');
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
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

    img{
        width: 200px;
        height: 200px;
    }
</style>
    <meta charset="UTF-8">
    <title><?php echo $language['CREATE A NEW ROOM'];?></title>
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
        <h1 class="text m-0 font-weight-bold" style = "text-align: center;"><?php echo $language['CREATE A NEW ROOM'];?></h1><hr>
        <form method="POST" enctype="multipart/form-data" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">          
            <div class="container-fluid">
                <div class="col">
                    <div class="card shadow mb-3">
                        <div class="card-header py-3">
                            <p class="text-primary m-0 font-weight-bold"><?php echo $language["ROOM'S DETAILS"];?></p>
                        </div>
                        <div class="card-body">
                            <div class ="row">
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="roomID"><strong><?php echo $language['Room ID'];?></strong></label>
                                    <input type="text" class="form-control <?php echo (!empty($r_roomIDErr)) ? 'is-invalid' : ''; ?>" id="roomID" placeholder="Enter room ID" name="roomID">
                                    <span class="help-block"><?php echo $r_roomIDErr;?></span>
                                </div>
                                <div class ="col-md-1 col-xl-1 mb-1"><br></div>
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="formFile" class="form-label"><strong><?php echo $language["Room's Image"];?></strong></label>
                                    <input class="form-control" type="file" name="image" onchange="readURL(this);" />
                                    <img id="blah" src="#" alt="<?php echo $language["Room's Image"];?>" />
                                    <span class="help-block"><?php echo $errMSG;?></span>
                                </div>
                            </div>
                            <br>
                            <div class ="row">
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="name"><strong><?php echo $language["Room's Name(English)"];?></strong></label>
                                    <input type="text" class="form-control <?php echo (!empty($r_nameBIErr)) ? 'is-invalid' : ''; ?>" id="nameBI" placeholder="Enter name in English" name="nameBI">
                                    <span class="help-block"><?php echo $r_nameBIErr;?></span>
                                </div>
                                <div class ="col-md-1 col-xl-1 mb-1"><br></div>
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="nama"><strong><?php echo $language["Room's Name(Malay)"];?></strong></label>
                                    <input type="text" class="form-control <?php echo (!empty($r_nameBMErr)) ? 'is-invalid' : ''; ?>" id="nameBM" placeholder="Enter name in Malay" name="nameBM">
                                    <span class="help-block"><?php echo $r_nameBMErr;?></span>
                                </div>
                            </div>
                            <br>
                            <div class ="row">
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="PIC"><strong><?php echo $language['PIC Of Room'];?></strong></label>
                                    <select name='PIC' class='form-control <?php echo (!empty($r_PICErr)) ? 'is-invalid' : ''; ?>' id='PIC' value="<?php echo $r_PIC; ?>">
                                    <option selected disabled>PIC's name</option>
                                    <?php 
                                        $sql = "SELECT * FROM users 
                                                LEFT OUTER JOIN rooms 
                                                ON (users.u_userIC = rooms.PIC) 
                                                WHERE userType = '2' 
                                                AND (rooms.PIC IS NULL)";
                                        $result = mysqli_query($conn, $sql);
                                        while($row = mysqli_fetch_array($result))
                                        {
                                                echo"<option value='".$row['u_userIC']."'>".$row['name']."</option>";
                                        }
                                    ?>
                                    </select>
                                    <span class="help-block"><?php echo $r_PICErr; ?></span>
                                </div>
                                <div class ="col-md-1 col-xl-1 mb-1"><br></div>
                                <div class="col-md-5 col-xl-5 mb-12">
                                    <label for="sel1"><strong><?php echo $language['Blocks'];?></strong></label>
                                    <select name='block' class="form-control <?php echo (!empty($r_blockErr)) ? 'is-invalid' : ''; ?>" id='sel1' value ="<?php echo $r_block; ?>">
                                    <option selected disabled>Block</option>";
                                    <?php
                                        $sql = "SELECT * FROM blocks";
                                        $result = mysqli_query($conn, $sql);
                                        
                                        while($row = mysqli_fetch_array($result))
                                        {
                                            if ($_SESSION['language'] == 'BI'){
                                                echo"<option value='".$row['block_no']."'>".$row['b_nameBI']."</option>";
                                            }else if ($_SESSION['language'] == 'BM'){
                                                echo"<option value='".$row['block_no']."'>".$row['b_nameBM']."</option>";
                                            }else{
                                                echo"<option value='".$row['block_no']."'>".$row['b_nameBI']."</option>";
                                            }
                                        }
                                    ?>
                                    </select>
                                    <span class="help-block"><?php echo $r_blockErr;?></span>
                                </div>
                            </div>
                            <br>
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
                    <input type="submit" text-align:center name="submit" class="btn btn-primary" value="<?php echo $language['Submit'];?>"/>
                    <input type="reset" name="clear" value="<?php echo $language['Clear'];?>"class="btn btn-warning">   
                    <a href="roomlist.php" class="btn btn-danger float-right"><?php echo $language['Cancel'];?></a>         
                    
                </div>  <br>                  
            </div>                 
        </form>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
<?php include ('..\navbar\navbar2.php');?>