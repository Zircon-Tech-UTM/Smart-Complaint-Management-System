<?php
    require_once("../dbconfig.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['ic']) != session_id() )
    {
        header('location: ../login/login.php');
    }
    // include("../navbar/navbar1.php");
    include("createroomprocess.php");
?>

<!DOCTYPE html>
<html lang="en">
<style>
.error {color: #FF0000;}
.help-block{color:red;}
</style>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

</head>
<body>
    <h1>Create a new Room</h1>
    <div class="container">
        <form method="POST" action="">
            <div class="form-group">
                <label for="roomID">Room ID</label>
                        <input type="text" class="form-control <?php echo (!empty($r_roomIDErr)) ? 'is-invalid' : ''; ?>" id="roomID" placeholder="Enter room ID" name="roomID"  value="<?php echo $r_roomID; ?>">
                        <span class="help-block"><?php echo $r_roomIDErr;?></span>
            </div>

            <div class="form-group">
            <label for="name">Room's Name</label>
                <input type="text" class="form-control <?php echo (!empty($r_nameBIErr)) ? 'is-invalid' : ''; ?>" id="nameBI" placeholder="Enter name in English" name="nameBI" value="<?php echo $r_nameBI; ?>">
                 <span class="help-block"><?php echo $r_nameBIErr;?></span>
            </div>

            <div class="form-group">
            <label for="nama">Nama Bilik</label>
                <input type="text" class="form-control <?php echo (!empty($r_nameBMErr)) ? 'is-invalid' : ''; ?>" id="nameBM" placeholder="Enter name in Malay" name="nameBM" value="<?php echo $r_nameBM; ?>">
                <span class="help-block"><?php echo $r_nameBMErr;?></span>
            </div>

            <div class="form-group">
            <label for="PIC">Person in charge's ID</label>
            <select name='PIC' class="form-control <?php echo (!empty($r_PICErr)) ? 'is-invalid' : ''; ?>" id='PIC' value="<?php echo $r_PIC; ?>">";
            <option selected disabled>PIC's name</option>";
                <?php
                    $sql = "SELECT * FROM users 
                            LEFT OUTER JOIN rooms 
                            ON (users.u_userIC = rooms.PIC) 
                            WHERE userType = '2' 
                            AND (rooms.PIC IS NULL)";
                    $result = mysqli_query($conn, $sql);

                    while($row = mysqli_fetch_array($result))
                    {
                            echo"<option value='".$row['u_userIC']."'>".$row['name']."</option>";
                    }
                ?>
            </select>";
            <span class="help-block"><?php echo $r_PICErr;?></span>
            </div>

            <div class="form-group">
                <label for="sel1">Block</label>
                <select name='block' class="form-control <?php echo (!empty($r_blockErr)) ? 'is-invalid' : ''; ?>" id='sel1' value ="<?php echo $r_block; ?>">";
                <option selected disabled>Block</option>";
                <?php
                    $sql = "SELECT * FROM blocks";
                    $result = mysqli_query($conn, $sql);
                    
                    while($row = mysqli_fetch_array($result))
                    {
                        echo"<option value='".$row['block_no']."'>".$row['b_nameBI']."</option>";
                    }
                ?>
               </select>";
               <span class="help-block"><?php echo $r_blockErr;?></span>
            </div>
    
            <!-- <div class="form-group"> 
            <label for="img">Image of the room (if any)</label>
                <input type="file" name="img" id="img">            
            </div>-->

            <br>

            <button type="submit" class="btn btn-default">Create</button>
            <button type="reset" class="btn btn-warning">Reset</button>

    </div>

</body>
</html>
<!-- <?php include("../navbar/navbar2.php");?> -->