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

    if ($_SESSION["userType"] != '2'){
        exit();
    }

    $sql1 = "SELECT * FROM rooms WHERE PIC = '".$_SESSION["ic"]."';";
    $results1 = mysqli_query($conn, $sql1); 
    $row1 = mysqli_fetch_array($results1);

    $sql2 = "SELECT * FROM blocks JOIN rooms ON rooms.blok = blocks.block_no AND PIC = '".$_SESSION["ic"]."';";
    $result2 = mysqli_query($conn, $sql2);

    $row2 = mysqli_fetch_array($result2);

    include("createprocess.php");
    include("../navbar/navbarB1.php");
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language['Create']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>
<style>
.error {color: #FF0000;}
.help-block{color:red;}
</style>
<body>
<body id="page-top">
    <div class="container-fluid">
    <h3 class="text-dark mb-4" style="font-size: 40px;"><?php echo $language['Asset Information']; ?></h3>
    <div class="col">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold"><?php echo $language['Assets Settings']; ?></p>
            </div>
                <div class="card-body">
                <form action="createB.php" enctype="multipart/form-data" method="POST">

                    <div class="form-group">
                        <label for="AsssetID"><?php echo $language['Asset ID']; ?></label>
                        <input type="text" class="form-control <?php echo (!empty($assetIDErr)) ? 'is-invalid' : ''; ?>" id="AsssetID" placeholder="<?php echo $language['Enter AssetID']; ?>" name="assetID" value="<?php echo $assetID; ?>">
                        <span class="help-block"><?php echo $assetIDErr;?></span>
                    </div>

                  <div class="row">
                    <div class="col-md-5 col-xl-5 mb-12">
                    <div class="form-group">
                        <label for="BI_Name"><?php echo $language['BI Name']; ?></label>
                        <input type="text" class="form-control <?php echo (!empty($nameBIErr)) ? 'is-invalid' : ''; ?>" id="BI_Name" placeholder="<?php echo $language['Enter name in BI']; ?>" name="nameBI" value="<?php echo $nameBI; ?>">
                        <span class="help-block"><?php echo $nameBIErr;?></span>
                    </div>
                    </div>
                    
                    <div class ="col-md-1 col-xl-1 mb-1"></div>
                    <div class="col-md-5 col-xl-5 mb-12">
                    <div class="form-group">
                        <label for="BM_Name"><?php echo $language['BM Name']; ?></label>
                        <input type="text" class="form-control <?php echo (!empty($nameBMErr)) ? 'is-invalid' : ''; ?>" id="BM_Name" placeholder="<?php echo $language['Enter name in BM']; ?>" name="nameBM" value="<?php echo $nameBM; ?>">
                        <span class="help-block"><?php echo $nameBMErr;?></span>
                    </div>
                    </div><br>
                  </div>

                  <div class="row">
                    <div class="col-md-5 col-xl-5 mb-12">
                    <div>
                        <label for="blocks" class="form-label"><?php echo $language['Blocks']; ?></label><br>
                            <input type="text" class="form-control" value="<?php echo $row2['b_nameBI']; ?>" disabled>
                            <input type="hidden" value="<?php echo $row2['block_no']; ?>" name="blocks">
                    </div>
                    </div>

                    <div class ="col-md-1 col-xl-1 mb-1"><br></div>
                    <div class="col-md-5 col-xl-5 mb-12">
                    <div>
                        <label for="rooms" class="form-label"><?php echo $language['Rooms']; ?></label><br>
                            <input type="text" class="form-control <?php echo (!empty($roomErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $row2['r_nameBI']; ?>" disabled>
                            <input type="hidden" value="<?php echo $row2['r_roomID']; ?>" name="rooms">
                            <span class="help-block"><?php echo $roomErr;?></span>
                    </div>
                    </div>
                  </div><br>

                    <label><?php echo $language['Category']; ?></label>
                    <div class="radio">
                        <label><input type="radio" name="category" value="1" ><?php echo $language['ICT']; ?></label>
                    <!-- </div>
                    <div class="radio"> -->
                        <label><input type="radio" name="category" value="2" ><?php echo $language['Non-ICT']; ?></label>
                        <span class="help-block"><?php echo $categoryErr;?></span>
                    </div><br>

                    <div class="form-group">
                        <label for="Description"><?php echo $language['Description']; ?></label>
                        <textarea  class="form-control" rows="5" id="Description" placeholder="<?php echo $language['Enter description']; ?> " name="description" ></textarea>
                    </div>
                    
                  <div class="row">
                    <div class="col-md-5 col-xl-5 mb-12">
                        <div class="form-group">
                        <label for="Cost"><?php echo $language['Cost']; ?></label>
                        <input type="text" class="form-control <?php echo (!empty($costErr)) ? 'is-invalid' : ''; ?>" id="Cost" placeholder="<?php echo $language['Enter cost']; ?>" name="cost" value="<?php echo $cost; ?>">
                        <span class="help-block"><?php echo $costErr;?></span>
                        </div>
                    </div>

                    <div class ="col-md-1 col-xl-1 mb-1"></div>
                    <div class="col-md-5 col-xl-5 mb-12">
                    <div class="form-group">
                        <label for="Amount"><?php echo $language['Amount']; ?> </label>
                        <input type="text" class="form-control <?php echo (!empty($amountErr)) ? 'is-invalid' : ''; ?>" id="Amount " placeholder="<?php echo $language['Enter amount']; ?> " name="amount" value="<?php echo $amount; ?>">
                        <span class="help-block"><?php echo $amountErr;?></span>
                    </div>
                    </div><br>
                  </div>

                    <div class="form-group">
                        <label for="Date_Purchased"><?php echo $language['Date purchased']; ?></label>
                        <input type="date" class="form-control" id="Date_Purchased" name="date_purchased" >
                        <span class="help-block"><?php echo $date_purchasedErr;?></span>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><?php echo $language['Asset Image']; ?></label>
                        <input class="input-group" type="file" name="image" onchange="readURL(this);" />
                        <img id="blah" src="#" alt="<?php echo $language['asset image']; ?>" />
                        <span class="help-block"><?php echo $errMSG;?></span>
                    </div>
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
              </div>

                    <button type="submit"  class="btn btn-success" value="Submit" name=""><?php echo $language['Submit']; ?></button>
                    <button type="reset" name="clear" value="Clear"class="btn btn-warning"><?php echo $language['Clear']; ?></button>
              </div>    
                  </form>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

</body>
</html>
<?php include("../navbar/navbar2.php");?>
