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

    if (isset($_POST['blocks'])){
        $sqlr = "SELECT * FROM rooms
        JOIN blocks
        ON rooms.blok = blocks.block_no
        JOIN users
        ON PIC = u_userIC
        WHERE blok = '".$_POST['blocks']."'";
    }else{
        $sqlr = "SELECT * FROM rooms
        JOIN blocks
        ON rooms.blok = blocks.block_no
        JOIN users
        ON PIC = u_userIC";
    }
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
<div class="container">
    <div class="row">

        <div class="col-3">
            <h2>Filter</h2>
            <form action="" method="POST"> 
                <label for="blocks" class="form-label">Blocks</label>
                <select class="form-select" aria-label="Default select example" name="blocks">
                    <option selected>Open this select menu</option>
                    <?php
                        $sql2 = "SELECT * FROM blocks";
                        $result2 = mysqli_query($conn, $sql2);

                        while($row2 = mysqli_fetch_array($result2)){
                            if ($_POST['blocks'] == $row2['block_no']){
                                echo "<option selected value='".$row2['block_no']."'>".$row2["b_nameBI"]."</option>";
                            }else{
                                echo "<option value='".$row2['block_no']."'>".$row2["b_nameBI"]."</option>";
                            }
                        }
                    ?>
                </select><br>
                
                <input type="submit" value="Apply Filter" class="btn btn-primary">
                <a href="" class="btn btn-warning">Cancel</a>
            </form>
        </div>

        <div class="col-9">
            <h2>Rooms in KVPJB</h2>
            <a href = 'Createroom.php?' class = 'btn btn-warning'>Create</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Room ID</th>
                        <th>Room name</th>
                        <th>Nama Bilik</th>
                        <th>Block</th>
                        <th>PIC</th>
                        <th>Assets</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($row = mysqli_fetch_array($result))
                        {
                            echo "<tr>";
                                
                    ?>                                
                        <td><a href = "roomdetail.php?id=<?php echo $row['r_roomID'] ?>"><?php echo $row['r_roomID']; ?></a></td>

                    <?php 
                                echo "<td>".$row['r_nameBI']."</td>";
                                echo "<td>".$row['r_nameBM']."</td>";
                                echo "<td>".$row['blok']."</td>";
                                // if($row['location'] =='1')
                                // {
                                //     echo "<td>Asrama</td>";
                                // }
                                // else if($row['location'] =='2')
                                // {
                                //     echo "<td>Kolej</td>";
                                // }
                                // else if($row['location'] =='3')
                                // {
                                //     echo "<td>Others</td>";
                                // }

                                echo "<td>";
                                    echo "<a href = '../users/detailUser.php?id=".$row["u_userIC"]."'>".$row['name']."</a>&nbsp";
                                echo "</td>";

                                echo "<td>";
                                    echo "<a href = 'roomassets.php?id=".$row["r_roomID"]."'>"."Link"."</a>&nbsp";
                                echo "</td>";

                                echo "<td>";
                                    echo "<a href = 'roommodify.php?id=".$row['r_roomID']."' class = 'btn btn-warning'>Modify</a>&nbsp";
                    ?>              
                                <a href = "roomcancel.php?id=<?php echo $row['r_roomID'] ?>"  onclick="return confirm('Are you sure you want to delete this room?')" class = 'btn btn-danger'>X</a>
                    <?php                
                                echo "</td>";
                                echo "</tr>";                            
                        }
                    ?>     
                </tbody>
            </table>        
        </div>
    </div>

</div>
</body>
</html>