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

    $sql1 = "SELECT * FROM users WHERE u_userIC = '".$_SESSION['ic']."'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);

    $sql2 = "SELECT * FROM blocks JOIN rooms ON rooms.blok = blocks.block_no AND PIC = '".$_SESSION["ic"]."';";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);

    $sql3 = "SELECT * FROM assets WHERE a_roomID = '".$row2['r_roomID']."'";
    $result3 = mysqli_query($conn, $sql3);

    include("complaintsBack/createPro.php");

    include("../navbar/navbarB1.php");
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language['ZirconTech']; ?></title>
</head>
<style>
    .help-block{    
        color: red;
    }
    img{
        width: 200px;
        height: 200px;
    }
</style>
<body id="page-top">

    <div class="container-fluid">
        <h3 class="text-dark mb-4" style="font-size: 40px;"><?php echo $language['Complaint Form']; ?></h3
        >
        <form action="createComplaint.php" enctype="multipart/form-data" method="POST">

            <div class="col">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold"><?php echo $language['Complaint Detail']; ?></p>
                    </div>

                    <div class="card-body">
                        <input type="hidden" name="u_userIC" id="complainantName" class="form-control form-control-lg" value="<?php echo  $row1['u_userIC']; ?>">

                        <div class="mb-3">
                            <label for="proposedDate" class="form-label <?php echo (!empty($dateErr)) ? 'is-invalid' : ''; ?>"><?php echo $language['Date:']; ?></label>
                            <input type="date" name="date" id="proposedDate" class="form-control form-control-lg" value="<?php echo $date; ?>">
                            <span class="help-block"><?php echo $dateErr;?></span>
                        </div>

                        <div>
                            <label for="blocks" class="form-label"><?php echo $language['Blocks']; ?></label><br>
                            <input type="text" class="form-control <?php echo (!empty($blocksErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $row2['b_nameBI']; ?>" disabled>
                            <input type="hidden" value="<?php echo $row2['block_no']; ?>" name="blocks">
                            <span class="help-block"><?php echo $blocksErr;?></span>
                        </div><br>

                        <div>
                            <label for="rooms" class="form-label"><?php echo $language['Rooms']; ?></label><br>
                            <input type="text" class="form-control <?php echo (!empty($roomsErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $row2['r_nameBI']; ?>" disabled>
                            <input type="hidden" value="<?php echo $row2['r_roomID']; ?>" name="rooms">
                            <span class="help-block"><?php echo $roomsErr;?></span>
                        </div><br>

                        <div>
                            <label for="assets" class="form-label"><?php echo $language['Assets']; ?></label><br>
                            <select class="form-select <?php echo (!empty($assetsErr)) ? 'is-invalid' : ''; ?>" aria-label="Default select example" id="assets" name="assets">
                                <option value="" selected><?php echo $language['Open menu']; ?></option>
                                <?php
                                    while ($row3 = mysqli_fetch_array($result3)){
                                ?>
                                    <option value="<?php echo $row3['a_assetID']; ?>"><?php echo $row3['a_nameBI']; ?></option>
                                <?php
                                    }
                                ?>
                            </select>
                            <span class="help-block"><?php echo $assetsErr;?></span>
                        </div><br>

                        <div class="mb-3">
                            <label for="complainantDetail" class="form-label"><?php echo $language['Detail:']; ?></label>
                            <input type="text" name="detail" id="complainantDetail" class="form-control form-control-lg <?php echo (!empty($detailErr)) ? 'is-invalid' : ''; ?>" placeholder="complainant's detail" value="<?php echo $detail; ?>">
                            <span class="help-block"><?php echo $detailErr;?></span>
                        </div>
            
                        <div class="form-group">
                            <label class="control-label form-label"><?php echo $language['Complaint Image']; ?></label>
                            <input class="input-group" type="file" name="image" onchange="readURL(this);" />
                            <img id="blah" src="#" alt="room image" />
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
            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
            

            
            <input type="submit" class="btn btn-primary" value="<?php echo $language['Submit']; ?>">
            <a href="readComplaint.php" class="btn btn-primary"><?php echo $language['Cancel']; ?></a>
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
    ?>
</body>
</html>

<?php
    include("../navbar/navbar2.php");
?>