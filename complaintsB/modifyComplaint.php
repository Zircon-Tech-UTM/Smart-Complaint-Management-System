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

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM complaints, rooms, blocks 
                WHERE complaints.c_roomID = rooms.r_roomID 
                AND rooms.blok = blocks.block_no  
                AND compID=".$id.";";

        $result = mysqli_query($conn, $sql);

        if (!$result){echo "ERROR:  $conn->error";
            header("refresh: 5; location: readComplaint.php");
        } 

        $row = mysqli_fetch_array($result);

        $sql2 = "SELECT * FROM blocks;";
        $result2 = mysqli_query($conn, $sql2);
    
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

        <form action="complaintsBack\modifyPro.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <input type="hidden" name="u_userIC" id="complainantName" class="form-control form-control-lg" value="<?php echo $row['u_userIC']; ?>">

            <?php
                $datetime = strtotime($row['proposedDate']);
                $new_date = date('Y-m-d', $datetime);
            ?>

            <div class="mb-3">
                <label for="proposedDate" class="form-label">Date:</label>
                <input type="date" name="date" id="proposedDate" class="form-control form-control-lg" value="<?php echo $new_date; ?>">
            </div>

            <div>
                <label for="blocks" class="form-label">Blocks</label><br>
                <input type="text" class="form-control" value="<?php echo $row['b_nameBI']; ?>" disabled>
                <input type="hidden" value="<?php echo $row['block_no']; ?>" name="blocks">
            </div><br>

            <div>
                <label for="rooms" class="form-label">Rooms</label><br>
                <input type="text" class="form-control" value="<?php echo $row['r_nameBI']; ?>" disabled>
                <input type="hidden" value="<?php echo $row['r_roomID']; ?>" name="rooms">
            </div><br>

            <div>
                <label for="assets" class="form-label">Assets</label><br>
                <select class="form-select" aria-label="Default select example" id="assets"  name="assets">
                <option>Open this select menu</option>
                    <?php
                    $sql4 = "SELECT * FROM assets WHERE a_roomID = '".$row['r_roomID']."';";
                    $result4 = mysqli_query($conn, $sql4);
                        while ($row4 = mysqli_fetch_array($result4)){
                            if ($row4['a_assetID'] == $row['c_assetID']){
                    ?>
                            <option selected value="<?php echo $row4['a_assetID']; ?>"><?php echo $row4['a_nameBI']; ?></option>
                    <?php
                            }else{
                    ?>
                            <option value="<?php echo $row4['a_assetID']; ?>"><?php echo $row4['a_nameBI']; ?></option>
                    <?php            
                            }
                        }
                    ?>
                </select>
            </div><br>

            

            <div class="mb-3">
                <label for="complainantDetail" class="form-label">Detail:</label>
                <input type="text" name="detail" id="complainantDetail" class="form-control form-control-lg" placeholder="complainant's detail" value="<?php echo $row['detail']; ?>">
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

<?php
    }
?>

<!-- 
userID
buildings ID
roomID
pDate
sDate
Type of damage
Total
detail
status
img path
-->