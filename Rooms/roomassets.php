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

    $bid;
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

    // if ($result2)
        $row2 = mysqli_fetch_array($result2);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
<div class="container">
    <h2>Assets in room <?php echo (isset($row2['r_nameBI']))? ($row2['r_nameBI']): ("-"); ?></h2>
    <!-- <a href = 'Createblock.php?' class = 'btn btn-warning'>Create</a> -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Assets</th>
                    <th>Asset Name</th>
                    <th>Nama Aset</th>
                    <th>Category</th>
                    <th>Descriptions</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($result))
                    {
                        echo "<tr>";
                            echo "<td>".$row['a_assetID']."</td>";
                            echo "<td>".$row['a_nameBI']."</td>";
                            echo "<td>".$row['a_nameBM']."</td>";

                            if ($row['a_category'] == '1'){
                                echo "<td>"."ICT"."</td>";
                            }else{
                                echo "<td>"."Non-ICT"."</td>";
                            }
                            


                            echo "<td>".$row['description']."</td>";
                            echo "<td>".'-'."</td>";

                        echo "</td>";
                        echo "</tr>";
                        
                    }
                ?>
            </tbody>
        </table>
</div>
</body>
</html>