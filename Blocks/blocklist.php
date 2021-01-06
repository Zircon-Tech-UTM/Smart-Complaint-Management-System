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

    $sql = "SELECT * FROM blocks
            LEFT JOIN rooms
            ON blocks.block_no = rooms.blok";

    $result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of Blocks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
<div class="container-fluid">
    <h2>Blocks in KVPJB</h2>
    <a href = 'Createblock.php?' class = 'btn btn-warning'>Create</a>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Block</th>
                    <th>Block name in English</th>
                    <th>Block name in Malay</th>
                    <th>Location</th>
                    <th>Rooms</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    while($row = mysqli_fetch_array($result))
                    {
                        echo "<tr>";
                            echo "<td>".$row['block_no']."</td>";
                            echo "<td>".$row['b_nameBI']."</td>";
                            echo "<td>".$row['b_nameBM']."</td>";
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
                            echo "<td><a href='#'>Rooms in this block</a></td>";
                            echo "<td>";
                            echo "<a href = 'blockmodify.php?id=".$row['block_no']."' class = 'btn btn-warning'>Modify</a>&nbsp";
                            echo "<a href = 'blockcancel.php?id=".$row['block_no']."' class = 'btn btn-danger'>Cancel</a>";
                        echo "</td>";
                        echo "</tr>";
                        
                    }
                ?>
            </tbody>
        </table>
</div>
</body>
</html>