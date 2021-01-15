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

    $sql1 = "SELECT * FROM users WHERE u_userIC = '".$_SESSION['ic']."'";
    $result1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_array($result1);

    $sql2 = "SELECT * FROM blocks JOIN rooms ON rooms.blok = blocks.block_no AND PIC = '".$_SESSION["ic"]."';";
    $result2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($result2);

    $sql3 = "SELECT * FROM assets WHERE a_roomID = '".$row2['r_roomID']."'";
    $result3 = mysqli_query($conn, $sql3);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZirconTech</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>Complaint Form</h1>
        <form action="complaintsBack\createPro.php" method="POST">
            
            <input type="hidden" name="u_userIC" id="complainantName" class="form-control form-control-lg" value="<?php echo $row1['u_userIC']; ?>">

            <div class="mb-3">
                <label for="proposedDate" class="form-label">Date:</label>
                <input type="date" name="date" id="proposedDate" class="form-control form-control-lg">
            </div>

            <div>
                <label for="blocks" class="form-label">Blocks</label><br>
                <input type="text" class="form-control" value="<?php echo $row2['b_nameBI']; ?>" disabled>
                <input type="hidden" value="<?php echo $row2['block_no']; ?>" name="blocks">
            </div><br>

            <div>
                <label for="rooms" class="form-label">Rooms</label><br>
                <input type="text" class="form-control" value="<?php echo $row2['r_nameBI']; ?>" disabled>
                <input type="hidden" value="<?php echo $row2['r_roomID']; ?>" name="rooms">
            </div><br>

            <div>
                <label for="assets" class="form-label">Assets</label><br>
                <select class="form-select" aria-label="Default select example" id="assets" name="assets">
                    <option selected>Open this menu</option>
                    <?php
                        while ($row3 = mysqli_fetch_array($result3)){
                    ?>
                        <option value="<?php echo $row3['a_assetID']; ?>"><?php echo $row3['a_nameBI']; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </div><br>

            <div class="mb-3">
                <label for="complainantDetail" class="form-label">Detail:</label>
                <input type="text" name="detail" id="complainantDetail" class="form-control form-control-lg" placeholder="complainant's detail">
            </div>

            

            <!-- <div class="input-group">
                <input type="file" class="form-control" id="imageDamage" name="image" aria-describedby="inputGroupFile" aria-label="Upload">
            </div> -->
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="landing.php" class="btn btn-primary">Cancel</a>
        </form>
    </div>
</body>
</html>