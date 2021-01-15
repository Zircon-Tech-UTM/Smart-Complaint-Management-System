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

    if (isset($row["r_img_path"]))
        $_SESSION["remove"] = $row["r_img_path"];

    include("roommodifyprocess.php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Room</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script> 

</head>
<style>
img{
    width: 200px;
    height: 200px;
}
.help-block{
        color: red;
    }
</style>
<body>
<h1>Edit Room</h1>
    <div class="container">
        <form method="POST" enctype="multipart/form-data" action="roommodify.php?id=<?php echo $rid; ?>">
            <div class="form-group">
            <label for="roomID">Room ID</label>            
                <input type="text" class="form-control <?php echo (!empty($r_roomIDErr)) ? 'is-invalid' : ''; ?>" id="roomID" placeholder="Enter room ID" name="roomID" value = "<?php echo $row['r_roomID'];?>"disabled>
                <span class="help-block"><?php echo $r_roomIDErr;?></span>
            </div>
            <input type="hidden" class="form-control" id="roomID" placeholder="Enter room ID" name="roomID" required="A room must have a unique ID" value = "<?php echo $row['r_roomID'];?>">


            <div class="form-group">
            <label for="name">Room's Name</label>
                <input type="text" class="form-control <?php echo (!empty($r_nameBIErr)) ? 'is-invalid' : ''; ?>" id="nameBI" placeholder="Enter name in English" name="nameBI" value = "<?php echo $row['r_nameBI'];?>">
                <span class="help-block"><?php echo $r_nameBIErr;?></span>
            </div>

            <div class="form-group">
            <label for="nama">Nama Bilik</label>
                <input type="text" class="form-control <?php echo (!empty($r_nameBMErr)) ? 'is-invalid' : ''; ?>" id="nameBM" placeholder="Enter name in Malay" name="nameBM" value = "<?php echo $row['r_nameBM'];?>">
            </div>

            <div class="form-group">
            <label for="PIC">Person in charge's ID</label>
            <select name='PIC' class='form-control <?php echo (!empty($r_PICErr)) ? 'is-invalid' : ''; ?>' id='PIC'  value="<?php echo $r_PIC; ?>">
                <option selected disabled>PIC's name</option>
                <?php
                    $sql3= "SELECT * FROM users 
                            LEFT OUTER JOIN rooms 
                            ON (users.u_userIC = rooms.PIC)
                            WHERE userType = '2'
                            AND (rooms.PIC IS NULL)";
                    $result3 = mysqli_query($conn, $sql3);

                    echo"<option selected = 'selected' value='".$row['u_userIC']."'>".$row['name']."</option>";

                    while($row3 = mysqli_fetch_array($result3))
                    {
                        
                            echo"<option value='".$row3['u_userIC']."'>".$row3['name']."</option>";
                    }
                ?>    
                </select>      
                <span class="help-block"><?php echo $r_PICErr; ?></span>  
            </div>

            <div class="form-group">
                <label for="sel1">Block</label>
                <select name='block' class='form-control <?php echo (!empty($r_blockErr)) ? 'is-invalid' : ''; ?>' id='sel1' value ="<?php echo $r_block; ?>">
                <option disabled>Block</option>
                <?php
                    $sql1 = "SELECT * FROM blocks";
                    $result1 = mysqli_query($conn, $sql1);
                    
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
                ?>
                </select>
                <span class="help-block"><?php echo $r_blockErr;?></span>
            </div>

            <div class="form-group">
                <label class="control-label">Room Image</label>
                <input class="input-group" type="file" name="image"  onchange="readURL(this);" />
                Current Image: <img src="<?php echo $row['r_img_path']; ?>" id="blah" alt="no picture avaiable">
                <span class="help-block"><?php echo $errMSG;?></span>
            </div>
            <script>
                function readURL(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#blah')
                                .attr('src', e.target.result)
                                .width(150)
                                .height(200);
                        };

                        reader.readAsDataURL(input.files[0]);
                    }
                }
            </script>



            <br>

            <button type="submit" class="btn btn-default"  onclick="return confirm('Do you want to save the changes?');" >Modify Room</button>
            <button type="reset" class="btn btn-warning">Reset to initial details</button>

</body>
</html>