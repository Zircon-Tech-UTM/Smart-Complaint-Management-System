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

    $bid ='';
    if(isset($_GET['id']))
    {
        $bid = $_GET['id'];
    }

    $sql = "SELECT * FROM rooms
            LEFT JOIN blocks
            ON blocks.block_no = rooms.blok
            JOIN users
            ON PIC = u_userIC
            WHERE blok = '$bid'";
    $result = mysqli_query($conn, $sql);

    $sql2 = "SELECT * FROM rooms
            JOIN blocks
            ON blok = block_no
            WHERE blok = '$bid'";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);

    $sql3 = "SELECT * FROM blocks WHERE block_no = '$bid'";
    $result3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($result3);

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
            echo $language['Rooms in'], $row3['b_nameBI'];
        }else if ($_SESSION['language'] == 'BM'){
            echo $language['Rooms in'], $row3['b_nameBM'];
        }else{
            echo $language['Rooms in'], $row3['b_nameBI'];
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
            <h3 class="text m-0 font-weight-bold" style="font-size: 40px;text-align: center;">
                <?php
                    if ($_SESSION['language'] == 'BI'){
                        echo $language['Rooms in'], $row3['b_nameBI'];
                    }else if ($_SESSION['language'] == 'BM'){
                        echo $language['Rooms in'], $row3['b_nameBM'];
                    }else{
                        echo $language['Rooms in'], $row3['b_nameBI'];
                    }
                ?>
            </h3><br>
            <div class="card shadow mb-3">
                <div class="card-body">
                    <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <thead style="color: rgb(0,0,0);">
                                <tr>
                                    <th><?php echo $language['Rooms']; ?></th>
                                    <th><?php echo $language['Room Name(English)'];?></th>
                                    <th><?php echo $language['Room Name(Malay)'];?></th>
                                    <th><?php echo $language['Location'];?></th>
                                    <th><?php echo $language['PIC Of Room'];?></th>
                                    <th><?php echo $language['Blocks'];?></th>
                                    <th><?php echo $language['Action'];?></th>
                                </tr>
                            </thead>
                            <tbody style="color: rgb(0,0,0);">
                                <?php
                                    while($row = mysqli_fetch_array($result))
                                    {
                                        echo "<tr>";
                                            echo "<td>".$row['r_roomID']."</td>";
                                            echo "<td><a href='../Rooms/roomdetail.php?id=".$row["r_roomID"]."'>".$row['r_nameBI']."</a></td>";
                                            echo "<td>".$row['r_nameBM']."</td>";
                                            if($row['location'] =='1')
                                            {
                                                echo "<td>".$language['Hostel']."</td>";
                                            }
                                            else if($row['location'] =='2')
                                            {
                                                echo "<td>".$language['College']."</td>";
                                            }
                                            else if($row['location'] =='3')
                                            {
                                                echo "<td>".$language['Others']."</td>";
                                            }
                                            echo "<td><a href='../users/detailUser.php?id=".$row["PIC"]."'>".$row['name']."</a></td>";
                                            echo "<td>";
                                            echo $row2['blok'];
                                            echo "</td>";
                                ?>
                                            <td>
                                            <a href = '../Rooms/roommodify.php?id=<?php echo $row["r_roomID"]; ?>' class = 'btn btn-warning'><?php echo $language['Edit'];?></a>&nbsp;
                                            <a style='color: rgb(14,14,14);'  href = '../Rooms/roomcancel.php?id='<?php echo $row['r_roomID'] ?> class = 'btn btn-danger' onclick="return confirm('Are you sure to delete this room?')"><strong>X</strong></a>
                                        </td>
                                        </tr>
                                <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <a href="#" onclick="history.go(-1)" class="btn btn-dark float-right"><?php echo $language["Back"]; ?></a>
        </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
<?php include ('../navbar/navbar2.php'); ?>