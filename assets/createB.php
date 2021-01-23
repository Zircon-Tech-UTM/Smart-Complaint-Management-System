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
    <title><?php echo $language['Create']; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 

</head>
<style>
.error {color: #FF0000;}
.help-block{color:red;}
img{width: 200px; height: 200px;}
</style>
<body id="page-top">
    <div class="container-fluid">
    <h3 class="text-dark mb-4 " style="font-size: 40px;"><?php echo $language['Asset Information']; ?></h3>
    <div class="col">
        <div class="card shadow mb-3">
            <div class="card-header py-3">
                <p class="text-primary m-0 font-weight-bold"><?php echo $language['Assets Settings']; ?></p>
            </div>
                <div class="card-body">
                  <form action="createB.php" enctype="multipart/form-data" method="POST">

                    <div class="form-group">
                      <label for="AsssetID"><strong><?php echo $language['Asset ID']; ?></strong></label>
                      <input type="text" class="form-control <?php echo (!empty($assetIDErr)) ? 'is-invalid' : ''; ?>" id="AsssetID" placeholder="<?php echo $language['Enter Asset ID']; ?>" name="assetID" value="<?php echo $assetID; ?>">
                      <span class="help-block"><?php echo $assetIDErr;?></span>
                    </div>

                  <div class="row">
                    <div class="col-md-5 col-xl-5 mb-12">
                        <div class="form-group">
                          <label for="BI_Name"><strong><?php echo $language['BI Name']; ?></strong></label>
                          <input type="text" class="form-control <?php echo (!empty($nameBIErr)) ? 'is-invalid' : ''; ?>" id="BI_Name" placeholder="<?php echo $language['Enter name in BI']; ?>" name="nameBI" value="<?php echo $nameBI; ?>">
                          <span class="help-block"><?php echo $nameBIErr;?></span>
                        </div>
                    </div>

                      <div class ="col-md-1 col-xl-1 mb-1"></div>
                        <div class="col-md-5 col-xl-5 mb-12">
                          <div class="form-group">
                            <label for="BM_Name"><strong><?php echo $language['BM Name']; ?></strong></label>
                            <input type="text" class="form-control <?php echo (!empty($nameBMErr)) ? 'is-invalid' : ''; ?>" id="BM_Name" placeholder="<?php echo $language['Enter name in BM']; ?>" name="nameBM" value="<?php echo $nameBM; ?>">
                            <span class="help-block"><?php echo $nameBMErr;?></span>
                          </div>
                        </div>
                  </div>

                  <div class="row">
                    <div class="col-md-5 col-xl-5 mb-12">
                    <div>
                        <label for="blocks" class="form-label"><strong><?php echo $language['Blocks']; ?></strong></label><br>
                            <input type="text" class="form-control" value="<?php echo $row2['b_nameBI']; ?>" disabled>
                            <input type="hidden" value="<?php echo $row2['block_no']; ?>" name="blocks">
                    </div>
                    </div>

                    <div class ="col-md-1 col-xl-1 mb-1"><br></div>
                    <div class="col-md-5 col-xl-5 mb-12">
                    <div>
                        <label for="rooms" class="form-label"><strong><?php echo $language['Rooms']; ?></strong></label><br>
                            <input type="text" class="form-control <?php echo (!empty($roomErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $row2['r_nameBI']; ?>" disabled>
                            <input type="hidden" value="<?php echo $row2['r_roomID']; ?>" name="rooms">
                            <span class="help-block"><?php echo $roomErr;?></span>
                    </div>
                    </div>
                  </div><br>

                   
                    <label><strong><?php echo $language['Category']; ?></strong></label>
                    <div class="radio ">
                    <?php
                            $array2 =['1','2'];

                            foreach($array2 as $arr2){
                                if($arr2 == $category){
                                    echo "<label><input type='radio' name='category' value=".$arr2." checked >";
                                    if($arr2=='1'){
                                        echo  $language['ICT'];
                                        echo "</input></label>";
                                    }
                                    else{
                                        echo $language['Non-ICT'];
                                        echo "</input></label>";
                                    }
                                    echo "<br>";
                                }else {
                                    echo "<label><input type='radio' name='category' value=".$arr2." >";
                                    if($arr2=='1'){
                                      echo  $language['ICT'];
                                        echo "</input></label>";
                                    }
                                    else{
                                      echo $language['Non-ICT'];

                                        echo "</input></label>";
                                    }
                                    echo "<br>";
                                }  

                                } // end of foreach()
                            ?>
                            <span class="help-block"><?php echo $categoryErr;?></span>
                    </div><br>

                    <div class="form-group">
                      <label for="Description"><strong><?php echo $language['Description']; ?></strong></label>
                      <textarea  class="form-control" rows="5" id="Description" placeholder="<?php echo $language['Enter description']; ?> " name="description" ></textarea>
                    </div>
                    
                  <div class="row">
                    <div class="col-md-5 col-xl-5 mb-12">
                      <div class="form-group">
                        <label for="Cost"><strong><?php echo $language['Cost']; ?></strong></label>
                        <input type="text" class="form-control <?php echo (!empty($costErr)) ? 'is-invalid' : ''; ?>" id="Cost" placeholder="<?php echo $language['Enter cost']; ?>" name="cost" value="<?php echo $cost; ?>">
                        <span class="help-block"><?php echo $costErr;?></span>
                      </div>
                    </div>

                    <div class ="col-md-1 col-xl-1 mb-1"></div>
                  </div>

                    <div class="form-group">
                      <label for="Date_Purchased"><strong><?php echo $language['Date Purchased']; ?></strong></label>
                      <input type="date" class="form-control <?php echo (!empty($date_purchasedErr)) ? 'is-invalid' : ''; ?>" id="Date_Purchased" name="date_purchased" max="<?php echo date("Y-m-d"); ?>" >
                      <span class="help-block"><?php echo $date_purchasedErr;?></span>
                    </div>

                    <div class="form-group">
                        <label class="control-label"><strong><?php echo $language['Asset Image']; ?></strong></label>
                        <input class="form-control" type="file" name="image" onchange="readURL(this);" />
                        <img id="blah" src="#" alt="<?php echo $language['Asset Image']; ?>" />
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

                    <button type="submit"  class="btn btn-primary" value="Submit" name=""><?php echo $language['Submit']; ?></button>
                    <button type="reset" name="clear" value="Clear"class="btn btn-warning"><?php echo $language['Clear']; ?></button>
                    <a href="mainB.php" class="btn btn-danger float-right"><?php echo $language['Cancel']; ?></a>
              </div>    
                  </form>
    </div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

</body>
</html>
<?php include("../navbar/navbar2.php");?>
