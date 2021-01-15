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

    $bid;
    if(isset($_GET['id']))
    {
        $bid = $_GET['id'];
    }

    $sql = "SELECT * FROM rooms
            LEFT JOIN blocks
            ON blocks.block_no = rooms.blok
            WHERE blok = '$bid'";

    $result = mysqli_query($conn, $sql);
    
    $sql2 = "SELECT * FROM rooms
            WHERE blok = '$bid'";

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
    <h2>Rooms in block <?php echo (isset($row2['blok']))? ($row2['blok']): ("-"); ?></h2>
    <!-- <a href = 'Createblock.php?' class = 'btn btn-warning'>Create</a> -->
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Rooms</th>
                    <th>Room name in English</th>
                    <th>Room name in Malay</th>
                    <th>Location</th>
                    <th>PIC</th>
                    <th>Block</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($result))
                    {
                        echo "<tr>";
                            echo "<td>".$row['r_roomID']."</td>";
                            echo "<td>".$row['r_nameBI']."</td>";
                            echo "<td>".$row['r_nameBM']."</td>";
                            if($row['location'] =='1')
                            {
                                echo "<td>Asrama</td>";
                            }
                            else if($row['location'] =='2')
                            {
                                echo "<td>Kolej</td>";
                            }
                            else if($row['location'] =='3')
                            {
                                echo "<td>Others</td>";
                            }
                            echo "<td><a href='../users/detailUser.php?id=".$row["PIC"]."'>".$row['PIC']."</a></td>";
                            echo "<td>";
                            echo $row2['blok'];
                            echo "</td>";
                            echo "<td>";
                            echo "<a href = '../Rooms/roommodify.php?id=".$row['r_roomID']."' class = 'btn btn-warning'>Modify</a>&nbsp";
                            echo "<a href = '../Rooms/roomcancel.php?id=".$row['r_roomID']."' class = 'btn btn-danger'>X</a>";
                        echo "</td>";
                        echo "</tr>";
                        
                    }
                ?>
            </tbody>
        </table>
</div>
</body>
</html>