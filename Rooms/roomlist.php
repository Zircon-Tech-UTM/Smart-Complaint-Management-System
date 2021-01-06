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

    $sqlr = "SELECT * FROM rooms
            JOIN blocks
            ON rooms.blok = blocks.block_no
            JOIN users
            ON PIC = u_userIC";
    $result = mysqli_query($conn, $sqlr);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Rooms</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
<div class="container-fluid">
    <h2>Rooms in KVPJB</h2>
    <a href = 'Createroom.php?' class = 'btn btn-warning'>Create</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Room ID</th>
                    <th>Room name in English</th>
                    <th>Room name in Malay</th>
                    <th>Block</th>
                    <th>Location</th>
                    <th>PIC</th>
                    <th>Action</th>
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
                            echo "<td>".$row['blok']."</td>";
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
                            echo "<td>".$row['name']."</td>";
                            // while()
                            // {
                            //     echo "<td>".$row['a_nameBI']."</td>";
                            //     echo "<td>".$row['a_amount']."</td>";
                            // }
                            echo "<td>";
                                echo "<a href = 'roommodify.php?id=".$row['r_roomID']."' class = 'btn btn-warning'>Modify</a>&nbsp";
                                echo "<a href = 'roomcancel.php?id=".$row['r_roomID']."' class = 'btn btn-danger'>Cancel</a>";
                            echo "</td>";
                            echo "</tr>";                            
                    }
                ?>                            
                <!-- <td>
                <a href= 'roommodify.php?id=<?php echo $row['r_roomID'];?>' class='btn btn-warning'>Modify</a>
                <a href= "deleteUser.php?id=<?php echo $row["u_userIC"];?>" class="btn btn-primary btn-sm" onclick="return confirm('Are you sure you want to delete this item')"><strong>X</strong></a>  
                <a href= "roomcancel.php?id=<?php echo $row['r_roomID'];?>" class='btn btn-primary btn-sm' onclick="return confirm('Are you sure you want to delete this item')"><strong>Delete</strong></a>
                </td>
                </tr>-->
            </tbody>
        </table>
</div>
</body>
</html>