<?php
include ('dbconnect.php');

$sql = "SELECT * FROM rooms
        LEFT JOIN assets
        ON rooms.r_assetID = assets.a_assetID";

$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
<div class="container-fluid">
    <h2>Rooms in KVPJB</h2>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Room ID</th>
                    <th>Room name in English</th>
                    <th>Room name in Malay</th>
                    <th>Block</th>
                    <th>Location</th>
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
                            else
                            {
                                echo "<td>Kolej</td>";
                            }
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
             </tbody>
        </table>
    </h2>
    </div>



   </div>
</body>
</html>