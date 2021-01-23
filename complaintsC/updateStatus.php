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

    $id = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");

    $sql = "SELECT * FROM complaints, rooms, blocks, assets, status, categories 
            WHERE complaints.c_roomID = rooms.r_roomID 
            AND rooms.blok = blocks.block_no 
            AND complaints.c_assetID = assets.a_assetID
            AND complaints.c_status = status.s_statusID
            AND assets.a_category = categories.catID
            AND compID=".$id.";";

    $result = mysqli_query($conn, $sql);

    if (!$result){
        echo "ERROR:  $conn->error";
        header("refresh: 5; location: allComplaint.php");
    } 

    $row = mysqli_fetch_array($result);

    if (isset($row["action_path"]))
        $_SESSION["remove"] = $row["action_path"];

    $pDate = explode(" ", $row["proposedDate"]);
    $sDate = explode(" ", $row["setledDate"]);
    

    $sql4 = "SELECT * FROM status WHERE s_statusID <> '1';";
    $result4 = mysqli_query($conn, $sql4);

    include("complaintsBack\updatePro.php");
    if ($_SESSION["userType"] == '3'){
        include("../navbar/navbarC.php");
      }elseif ($_SESSION["userType"] == '4'){
        include("../navbar/navbarD.php");
      }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language['Update Complaint Status'];?></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
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

        <div class="container-fluid float-left">
            <h3 class="text-dark mb-4" style="font-size: 40px;"><strong><?php echo $language['Complaint Information'];?></strong></h3>

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">

                            <img src="<?php echo "../complaints/".$row["c_img_path"];?>" alt="complaint image"><br><br>

                            <thead style="color: rgb(0,0,0);">
                                <tr>
                                    <th><?php echo $language['Complaint ID'];?></th>
                                    <th><?php echo $row["compID"];?></th>
                                
                                </tr>
                            </thead>
                            <tbody style="color: rgb(0,0,0);">
                                <tr></tr>
                                <tr>
                                    <td><strong><?php echo $language['Assets'];?></strong></td>
                                    <td><?php 
                                        if ($_SESSION['language'] == 'BI'){
                                            echo $row["a_nameBI"];?></td>
                                        <?php
                                        }else if ($_SESSION['language'] == 'BM'){
                                            echo $row["a_nameBM"];?></td>
                                        <?php
                                        }else{
                                            echo $row["a_nameBI"].'</td>';
                                        }?>
                                </tr>
                                <tr></tr>
                                <tr></tr>
                                <tr>
                                    <td><strong><?php echo $language['Blocks'];?></strong></td>
                                    <td><?php 
                                        if ($_SESSION['language'] == 'BI'){
                                            echo $row["b_nameBI"];?></td>
                                        <?php
                                        }else if ($_SESSION['language'] == 'BM'){
                                            echo $row["b_nameBM"];?></td>
                                        <?php
                                        }else{
                                            echo $row["b_nameBI"].'</td>';
                                        }?>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $language['Rooms'];?></strong></td>
                                    <td><?php 
                                        if ($_SESSION['language'] == 'BI'){
                                            echo $row["r_nameBI"];?></td>
                                        <?php
                                        }else if ($_SESSION['language'] == 'BM'){
                                            echo $row["r_nameBM"];?></td>
                                        <?php
                                        }else{
                                            echo $row["r_nameBI"].'</td>';
                                        }?>
                                </tr>

                                <tr>
                                    <td><strong><?php echo $language['Proposed Date:'];?></strong></td>
                                    <td><?php echo $pDate[0];?></td>
                                </tr>

                                <tr>
                                    <td><strong><?php echo  $language['Settled Date:'];?></strong></td>
                                    <td><?php if(empty($sDate[0])){echo "-";} else {echo $sDate[0];}?></td>
                                </tr>

                                <tr>
                                    <td><strong><?php echo $language['Status'];?></strong></td>
                                    <td><?php 
                                        if ($_SESSION['language'] == 'BI'){
                                            echo $row["s_nameBI"];?></td>
                                        <?php
                                        }else if ($_SESSION['language'] == 'BM'){
                                            echo $row["s_nameBM"];?></td>
                                        <?php
                                        }else{
                                            echo $row["s_nameBI"].'</td>';
                                        }?>
                                </tr>

                                <tr>
                                    <td><strong><?php echo $language['Description'];?></strong></td>
                                    <td><?php echo $row["detail"];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <hr>


        <div class="container-fluid float-left">        <br><br>
            <h4 class="text-dark mb-4" style="font-size: 40px;"><strong><?php echo $language['Update Complaint Status'];?></strong></h4>

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">

                        <form action="updateStatus.php?id=<?php echo $_GET["id"]; ?>" enctype="multipart/form-data" method="POST">
                            <input type="hidden" name="id" value="<?php echo $row['compID']; ?>">

                            <input type="hidden" name="u_userIC" id="complainantName" class="form-control form-control-lg" value="<?php echo $row['followedBy']; ?>">

                            <div class="mb-3">
                                <label for="settledDate" class="form-label"><?php echo $language['Settled Date:']?></label>
                                <input type="date" name="sdate" id="settledDate" class="form-control form-control-lg <?php echo (!empty($sdateErr)) ? 'is-invalid' : ''; ?>" value="<?php echo $sDate[0]; ?>">
                                <span class="help-block"><?php echo $sdateErr;?></span>
                            </div>

                            <div>
                                <label for="status" class="form-label"><?php echo $language['Status'];?></label>
                                <select class="form-select <?php echo (!empty($statusErr)) ? 'is-invalid' : ''; ?>" aria-label="Default select example" id="status"  name="status">
                                <option><?php echo $language['Open this select menu'];?></option>
                                    <?php
                                        while ($row4 = mysqli_fetch_array($result4)){
                                            if ($row4['s_statusID'] == $row['c_status']){
                                                if ($_SESSION['language'] == 'BI'){
                                                    echo '<option selected value="'.$row4['s_statusID'].'">'.$row4['s_nameBI'].'</option>';
                                                }else if ($_SESSION['language'] == 'BM'){
                                                    echo '<option selected value="'.$row4['s_statusID'].'">'.$row4['s_nameBM'].'</option>';
                                                }else{
                                                    echo '<option selected value="'.$row4['s_statusID'].'">'.$row4['s_nameBI'].'</option>';
                                                }
                                            }else{
                                                if ($_SESSION['language'] == 'BI'){
                                                    echo '<option value="'.$row4['s_statusID'].'">'.$row4['s_nameBI'].'</option>';
                                                }else if ($_SESSION['language'] == 'BM'){
                                                    echo '<option value="'.$row4['s_statusID'].'">'.$row4['s_nameBM'].'</option>';
                                                }else{
                                                    echo '<option value="'.$row4['s_statusID'].'">'.$row4['s_nameBI'].'</option>';
                                                }
                                            }
                                        }
                                    ?>
                                </select>
                                <span class="help-block"><?php echo $statusErr;?></span>
                            </div>

                            <div class="mb-3">
                                <label for="actionDetail" class="form-label"><?php echo $language['Action'];?></label>
                                <input type="text" name="action" id="actionDetail" class="form-control form-control-lg <?php echo (!empty($actionErr)) ? 'is-invalid' : ''; ?>" placeholder="<?php echo $language['Action'];?>" value="<?php echo isset($row['action_desc'])? $row['action_desc']: ""; ?>">
                                <span class="help-block"><?php echo $actionErr;?></span>
                            </div>

                            <div class="form-group">
                                <label class="control-label form-label"><strong><?php echo $language['File']; ?></strong></label>
                                <input class="form-control" type="file" name="image" onchange="readURL(this);" />
                                <img id="blah" src="<?php echo $row['action_path'];?>" alt="<?php echo $language["File"]; ?>" />
                                <?php 
                                    $a = $row["action_path"];

                                    if (strpos($a, 'pdf') !== false) {
                                        echo "<a href='".$row['action_path']."' target='_blank' >'".$language["File"]."'</a>";
                                    }
                                ?>
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

                            <input type="submit" class="btn btn-primary" onclick="return confirm('<?php echo $language['Do you want to save the chnages?']; ?>')" value="<?php echo $language['Submit'];?>">
                            <input type="reset" class="btn btn-warning" value="<?php echo $language['Reset'];?>">
                            <a href="acceptedComplaints.php" class="btn btn-danger float-right"><?php echo $language['Cancel'];?></a>
                        </form>

                    </div>
                </div>
            </div><br>
        </div>

        
    </div>
</body>
</html>

<?php
    include("../navbar/navbar2.php");
?>