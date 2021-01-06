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

    if(isset($_GET['id']))
    {
        $rid = $_GET['id'];
    }

    $sql = "SELECT * FROM rooms
            JOIN users
            ON PIC = u_userIC
            WHERE r_roomID = '$rid'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
<h1>Edit Room</h1>
    <div class="container">
        <form method="POST" action="roommodifyprocess.php">
            <div class="form-group">
            <label for="roomID">Room ID</label>            
                <input type="text" class="form-control" id="roomID" placeholder="Enter room ID" name="roomID" required="A room must have a unique ID" value = "<?php echo $row['r_roomID'];?>"disabled>
            </div>
            <input type="hidden" class="form-control" id="roomID" placeholder="Enter room ID" name="roomID" required="A room must have a unique ID" value = "<?php echo $row['r_roomID'];?>">


            <div class="form-group">
            <label for="name">Room's Name</label>
                <input type="text" class="form-control" id="nameBI" placeholder="Enter name in English" name="nameBI" required="A room must have a name."value = "<?php echo $row['r_nameBI'];?>">
            </div>

            <div class="form-group">
            <label for="nama">Nama Bilik</label>
                <input type="text" class="form-control" id="nameBM" placeholder="Enter name in Malay" name="nameBM" required="A room must have a name."value = "<?php echo $row['r_nameBM'];?>">
            </div>

            <div class="form-group">
            <label for="PIC">Person in charge's ID</label>
                <?php
                    $sql3= "SELECT * FROM users 
                            LEFT OUTER JOIN rooms 
                            ON (users.u_userIC = rooms.PIC)
                            WHERE userType = '2'
                            AND (rooms.PIC IS NULL)";
                    $result3 = mysqli_query($conn, $sql3);

                    echo"<select name='PIC' class='form-control' id='PIC'>";
                    echo"<option selected disabled>PIC's name</option>";
                    echo"<option selected = 'selected' value='".$row['u_userIC']."'>".$row['name']."</option>";

                    while($row3 = mysqli_fetch_array($result3))
                    {
                        
                            echo"<option value='".$row3['u_userIC']."'>".$row3['name']."</option>";
                    }
                    echo"</select>";
                ?>            
            </div>

            <div class="form-group">
                <label for="sel1">Block</label>
                <?php
                    $sql1 = "SELECT * FROM blocks";
                    $result1 = mysqli_query($conn, $sql1);
                    
                    echo"<select name='block' class='form-control' id='sel1'>";
                    echo"<option disabled>Block</option>";
                    while($row1 = mysqli_fetch_array($result1))
                    {
                        if($row1['block_no']==$row['blok'])
                        {
                            echo"<option selected = 'selected' value='".$row1['block_no']."'>".$row1['b_nameBI']."</option>";
                        }
                        else
                        {
                            echo"<option value='".$row1['block_no']."'>".$row1['b_nameBI']."</option>";
                        }
                    }
                    echo"</select>";
                ?>
            </div>
    
            <!-- <div class="form-group"> 
            <label for="img">Image of the room (if any)</label>
                <input type="file" name="img" id="img">            
            </div>-->

            <br>

            <button type="submit" class="btn btn-default">Modify Room</button>
            <button type="reset" class="btn btn-warning">Reset to initial details</button>

</body>
</html>