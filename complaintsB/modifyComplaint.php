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

    $id  = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
        $sql = "SELECT * FROM complaints, rooms, blocks 
                WHERE complaints.c_roomID = rooms.r_roomID 
                AND rooms.blok = blocks.block_no  
                AND compID=".$id.";";

        $result = mysqli_query($conn, $sql);

        if (!$result){echo "ERROR:  $conn->error";
            header("refresh: 5; location: readComplaint.php");
        } 

        $row = mysqli_fetch_array($result);

        if (isset($row["c_img_path"]))
            $_SESSION["remove"] = $row["c_img_path"];

        $sql2 = "SELECT * FROM blocks;";
        $result2 = mysqli_query($conn, $sql2);


        
        $sql4 = "SELECT * FROM assets WHERE a_roomID = '".$row['r_roomID']."';";
        $result4 = mysqli_query($conn, $sql4);
        

        include("complaintsBack/modifyPro.php");
        include("../navbar/navbarB1.php");
        require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language['ZirconTech']; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 
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
<body>
<div class="container">
        <h3 class="text-dark mb-4" style="font-size: 40px;"><?php echo $language['Complaint Form']; ?></h3>

        <form action="modifyComplaint.php?id=<?php echo $id; ?>" enctype="multipart/form-data" method="POST">

            <div class="col">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold"><?php echo $language['Complaint Detail']; ?></p>
                    </div>

                    <div class="card-body">

                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="hidden" name="u_userIC" id="complainantName" class="form-control form-control-lg" value="<?php echo $row['u_userIC']; ?>">

                        <?php
                            $datetime = strtotime($row['proposedDate']);
                            $new_date = date('Y-m-d', $datetime);
                        ?>

                        <div class="mb-3">
                            <label for="proposedDate" class="form-label <?php echo (!empty($dateErr)) ? 'is-invalid' : ''; ?>"><strong><?php echo $language['Date']; ?></strong></label>
                            <input type="date" name="date" id="proposedDate" class="form-control form-control-lg" value="<?php echo $new_date; ?>">
                            <span class="help-block"><?php echo $dateErr;?></span>
                        </div>

                        <div>
                            <label for="blocks" class="form-label"><strong><?php echo $language['Blocks']; ?></strong></label><br>
                            <input type="text" class="form-control <?php echo (!empty($blocksErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $row['b_nameBI']; ?>" disabled>
                            <input type="hidden" value="<?php echo $row['block_no']; ?>" name="blocks">
                            <span class="help-block"><?php echo $blocksErr;?></span>
                        </div><br>

                        <div>
                            <label for="rooms" class="form-label"><strong><?php echo $language['Rooms']; ?></strong></label><br>
                            <input type="text" class="form-control <?php echo (!empty($roomsErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $row['r_nameBI']; ?>" disabled>
                            <input type="hidden" value="<?php echo $row['r_roomID']; ?>" name="rooms">
                            <span class="help-block"><?php echo $roomsErr;?></span>
                        </div><br>


                        <div>
                            <label for="assets" class="form-label"><strong><?php echo $language['Assets']; ?></strong></label><br>
                            <select class="form-select <?php echo (!empty($assetsErr)) ? 'is-invalid' : ''; ?>" aria-label="Default select example" id="assets"  name="assets">
                            <option value="" selected>Open this select menu</option>
                                <?php
                                    while ($row4 = mysqli_fetch_array($result4)){
                                        if ($row4['a_assetID'] == $row['c_assetID']){
                                ?>
                                        <option selected value="<?php echo $row4['a_assetID']; ?>"><?php echo $row4['a_nameBI']; ?></option>
                                <?php
                                        }else{
                                ?>
                                        <option value="<?php echo $row4['a_assetID']; ?>"><?php echo $row4['a_nameBI']; ?></option>
                                <?php            
                                        }
                                    }
                                ?>
                            </select>
                            <span class="help-block"><?php echo $assetsErr;?></span>
                        </div><br>


                        <div class="mb-3">
                            <label for="complainantDetail" class="form-label"><strong><?php echo $language['Detail']; ?></strong></label>
                            <input type="text" name="detail" id="complainantDetail" class="form-control form-control-lg <?php echo (!empty($detailErr)) ? 'is-invalid' : ''; ?>" placeholder="complainant's detail" value="<?php echo $row['detail']; ?>">
                            <span class="help-block"><?php echo $detailErr;?></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label form-label"><strong><?php echo $language['Complaint Image']; ?></strong></label>
                            <input class="form-control" type="file" name="image" onchange="readURL(this);" />
                            <img id="blah" src="<?php echo "../complaints/".$row['c_img_path'];?>" alt="<?php echo $language['complaint image']; ?>" />
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

                        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

                        <input type="submit" text-align:center name="submit" onclick="return confirm('<?php echo $language['Do you want to save the changes?']; ?>')" class="btn btn-primary" value="<?php echo $language['Save']; ?>"/>
                        <input type="reset" name="clear" value="<?php echo $language['Reset']; ?>"class="btn btn-warning"> 
                        <a href="readComplaint.php" class="btn btn-danger float-right" "><?php echo $language['Cancel']; ?></a>
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





</body>
</html>
