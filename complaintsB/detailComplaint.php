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
    include("../navbar/navbarB1.php");//yc add
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM complaints, rooms, blocks, assets, status, users 
                WHERE complaints.c_roomID = rooms.r_roomID 
                AND rooms.blok = blocks.block_no AND complaints.c_assetID = assets.a_assetID AND complaints.c_status = status.s_statusID AND complaints.c_userIC = users.u_userIC
                AND compID=".$id.";";

        $result = mysqli_query($conn, $sql);

        if ($result){
            $row = mysqli_fetch_array($result);

            $pDate = explode(" ", $row["proposedDate"]);
            $sDate = explode(" ", $row["setledDate"]);
        
        
?>          


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language['Zircon Tech']; ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<style>
    img{
        width: 200px;
        height: 200px;
    }
</style>
<body>
    <div class="container">
    <div class="container-fluid float-left">
            <h3 class="text-dark mb-4" style="font-size: 40px;"><strong><?php echo $language['Complaint Information']; ?></strong></h3>

            <div class="card shadow">
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">

                        <table class="table my-0" id="dataTable">

                            <img src="<?php echo $row["c_img_path"];?>" class="img-thumbnail" alt="<?php echo $language["complaint image"]; ?>"><br><br>

                            <thead style="color: rgb(0,0,0);">
                                <tr>
                                    <th><?php echo $language['Complaint ID']; ?></th>
                                    <th><?php echo $row["compID"];?></th>
                                
                                </tr>
                            </thead>
                            <tbody style="color: rgb(0,0,0);">
                                <tr>
                                    <td><strong><?php echo $language['Proposed By']; ?></strong></td>
                                    <td><a href="../profile/editprofile.php?id=<?php echo $row["c_userIC"]; ?>"><?php echo $row["name"];?></a></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $language['Assets']; ?></strong></td>
                                    <td><a href="../assets/assetDetail.php?id=<?php echo $row["c_assetID"]; ?>"><?php echo $row["a_nameBI"];?></a></td>
                                </tr>
                                <tr></tr>
                                <tr></tr>
                                <tr>
                                    <td><strong><?php echo $language['Building']; ?></strong></td>
                                    <td><?php echo $row["b_nameBI"];?></td>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $language['Room']; ?></strong></td>
                                    <td><a href="../complaintsB/roomdetail.php?id=<?php echo $row["c_roomID"]; ?>"><?php echo $row["r_nameBI"];?></a></td>
                                </tr>

                                <tr>
                                    <td><strong><?php echo $language['Proposed Date']; ?></strong></td>
                                    <td><?php echo $pDate[0];?></td>
                                </tr>

                                <tr>
                                    <td><strong><?php echo $language['Settled Date']; ?></strong></td>
                                    <td><?php if(empty($sDate[0])){echo "-";} else {echo $sDate[0];}?></td>
                                </tr>

                                <tr>
                                    <td><strong><?php echo $language['Status']; ?></strong></td>
                                    <td><?php echo $row["s_nameBI"];?></td>
                                </tr>

                                <tr>
                                    <td><strong><?php echo $language['Detail']; ?></strong></td>
                                    <td><?php echo $row["detail"];?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><br>

            <a href="modifyComplaint.php?id=<?php echo $id; ?>" class="btn btn-warning"><?php echo $language['Edit']; ?></a>
            <a href="deleteComplaint.php?id=<?php echo $id; ?>" onclick="return confirm('<?php echo $language['Are you sure to delete this complaint?']; ?>')" class="btn btn-danger"><?php echo $language['Delete']; ?></a>
            <a href="#" class="btn btn-dark float-right" onclick="history.go(-1)"><?php echo $language['Back']; ?></a>
            <br><br>
        </div>
    </div>
</body>
</html>



<?php
        } else{
            echo "ERROR:  $conn->error";
            header("refresh: 6; location: readComplaint.php");
        }

    } else {
        echo "ERROR Occur! Will direct back to the same page in 5 seconds";
        header("refresh: 5; location: readComplaint.php");
    }
    include("../navbar/navbar2.php");
    mysqli_close($conn);
?>