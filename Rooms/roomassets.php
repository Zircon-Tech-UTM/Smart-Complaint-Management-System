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

    if ($_SESSION["userType"] != '1'){
        exit();
    }

    $rid;
    if(isset($_GET['id']))
    {
        $rid = $_GET['id'];
    }

    $sql = "SELECT * FROM assets
            JOIN rooms
            ON assets.a_roomID = rooms.r_roomID
            WHERE assets.a_roomID = '$rid'";

    $result = mysqli_query($conn, $sql);

    $sql2 = "SELECT * FROM rooms
            WHERE r_roomID = '$rid'";

    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);
    include("../navbar/navbar1.php");
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
    <?php
        if ($_SESSION['language'] == 'BI'){
            echo $language['Assets in'], $row2['r_nameBI'];
        }else if ($_SESSION['language'] == 'BM'){
            echo $language['Assets in'], $row2['r_nameBM'];
        }else{
            echo $language['Assets in'], $row2['r_nameBI'];
        }
        ?>
    </title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>    
</head>
<style>
    img{
        width: 500px;
        height: 500px;
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
            <h3 class="text-dark mb-4" style="font-size: 40px; text-align:center">
            <?php
                if ($_SESSION['language'] == 'BI'){
                    echo $language['Assets in'], $row2['r_nameBI'];
                }else if ($_SESSION['language'] == 'BM'){
                    echo $language['Assets in'], $row2['r_nameBM'];
                }else{
                    echo $language['Assets in'], $row2['r_nameBI'];
                }
            ?>
            </h3>
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead style="color: rgb(0,0,0);">
                                <tr>
                                    <th><?php echo $language['Assets'];?></th>
                                    <th><?php echo $language['BI Name'];?></th>
                                    <th><?php echo $language['BM Name'];?></th>
                                    <th><?php echo $language['Category'];?></th>
                                    <th><?php echo $language['Description'];?></th>
                                </tr>
                            </thead>
                            <tbody style="color: rgb(0,0,0);">
                                <?php
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        echo "<tr>";
                                            echo "<td>".$row['a_assetID']."</td>";
                                            echo "<td><a href='../assets/assetDetail.php?id=".$row['a_assetID']."'>".$row['a_nameBI']."</a></td>";
                                            echo "<td>".$row['a_nameBM']."</td>";

                                            if ($row['a_category'] == '1'){
                                                echo "<td>"."ICT"."</td>";
                                            }else{
                                                if ($_SESSION['language'] == 'BI'){
                                                    echo "<td>"."Non-ICT"."</td>";
                                                }else if ($_SESSION['language'] == 'BM'){
                                                    echo "<td>"."Aset Alih/ Bukan ICT"."</td>";
                                                }else{
                                                    echo "<td>"."Non-ICT"."</td>";
                                                }
                                            }
                                            echo "<td>".$row['description']."</td>";
                                        echo "</tr>";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
<?php include ('../navbar/navbar2.php'); ?>