<?php
    require_once("..\dbconfig.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../login/login.php');
    }

    if ($_SESSION["userType"] != '1' AND $_SESSION["userType"] != '2'){
        exit();
    }

    if (isset($_GET['id'])){
        $rid = $_GET['id'];
    }

    $sql = "SELECT * FROM rooms
        JOIN blocks
        ON rooms.blok = blocks.block_no
        JOIN users
        ON PIC = u_userIC
        WHERE r_roomID = '".$rid."'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    
    if ($_SESSION['userType'] == '1')
        include("../navbar/navbar1.php");
    else if ($_SESSION['userType'] == '2')
        include("../navbar/navbarB1.php");
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language["Room's Information"];?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>    
</head>
<style>
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
            <h3 class="text-dark mb-4" style="font-size: 40px;"><?php echo $language["Room's Information"];?></h3>
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <img src="<?php echo $row['r_img_path']; ?>" alt="<?php echo $language['no picture avaiable'];?>">
                            <thead style="color: rgb(0,0,0);">
                                <tr>
                                    <th><?php echo $language['Room ID'];?></th>
                                    <th><?php echo $row['r_roomID']; ?></th>
                                </tr>
                            </thead>
                            <tbody style="color: rgb(0,0,0);">
                                <tr></tr>
                                <tr>
                                    <td><strong><?php echo $language["Room's Name"];?></strong></td>
                                        <?php
                                            if ($_SESSION['language'] == 'BI'){
                                                echo "<td>".$row['r_nameBI']."</td>";
                                            }else if ($_SESSION['language'] == 'BM'){
                                                echo "<td>".$row['r_nameBM']."</td>";
                                            }else{
                                                echo "<td>".$row['r_nameBI']."</td>";
                                            }
                                        ?>
                                </tr>
                                <tr></tr>
                                <tr></tr>
                                <tr>
                                    <td><strong><?php echo $language['Located in'];?></strong></td>
                                    <?php
                                            if ($_SESSION['language'] == 'BI'){
                                                echo "<td>".$row['b_nameBI']."</td>";
                                            }else if ($_SESSION['language'] == 'BM'){
                                                echo "<td>".$row['b_nameBM']."</td>";
                                            }else{
                                                echo "<td>".$row['b_nameBI']."</td>";
                                            }
                                        ?>
                                </tr>
                                <tr>
                                    <td><strong><?php echo $language['Assets'] ;?></strong></td>
                                    <td><a href="roomassets.php?id=<?php echo $row["r_roomID"]; ?>"><?php echo $language['CLICK HERE']; ?></a></td>
                                </tr>
                                <tr></tr>
                                <tr>
                                    <td><strong><?php echo $language['PIC Of Room'];?></strong></td>
                                    <td><a href="../users/detailUser.php?id=<?php echo $row["u_userIC"]; ?>"><strong><?php echo $row['name']; ?></strong></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <a href="roommodify.php?id=<?php echo $row["r_roomID"];?>" class="btn btn-warning"><?php echo $language['Edit'];?></a>
            <a href="roomcancel.php?id=<?php echo $row["r_roomID"];?>" class="btn btn-danger" onclick="return confirm('Are you sure to delete this room?')"><?php echo $language['Delete'];?></a>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
<?php include ('../navbar/navbar2.php'); ?>