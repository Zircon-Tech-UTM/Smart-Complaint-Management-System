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
            header("refresh: 5; location: allComplaint.php");
        } 

        $row = mysqli_fetch_array($result);

        echo $row['c_status']
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

        <form action="complaintsBack\updatePro.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <input type="hidden" name="u_userIC" id="complainantName" class="form-control form-control-lg" value="<?php echo $row['followedBy']; ?>">

            <?php
                if (isset($row['setledDate'])){
                    $datetime = strtotime($row['setledDate']);
                    $new_date = date('Y-m-d', $datetime);
                }else{
                    $new_date = "";
                }

            ?>

            <div class="mb-3">
                <label for="settledDate" class="form-label">Settled Date:</label>
                <input type="date" name="sdate" id="settledDate" class="form-control form-control-lg" value="<?php echo $new_date; ?>">
            </div>

            <div>
                <label for="status" class="form-label">Status</label><br>
                <select class="form-select" aria-label="Default select example" id="status"  name="status">
                <option>Open this select menu</option>
                    <?php
                    $sql4 = "SELECT * FROM status;";
                    $result4 = mysqli_query($conn, $sql4);
                        while ($row4 = mysqli_fetch_array($result4)){
                            if ($row4['s_statusID'] == $row['c_status']){
                    ?>
                            <option selected value="<?php echo $row4['s_statusID']; ?>"><?php echo $row4['s_nameBI']; ?></option>
                    <?php
                            }else{
                    ?>
                            <option value="<?php echo $row4['s_statusID']; ?>"><?php echo $row4['s_nameBI']; ?></option>
                    <?php            
                            }
                        }
                    ?>
                </select>
            </div><br>

            <div class="mb-3">
                <label for="actionDetail" class="form-label">Action Taken:</label>
                <input type="text" name="action" id="actionDetail" class="form-control form-control-lg" placeholder="action taken" value="<?php echo isset($row['action_desc'])? $row['action_desc']: " "; ?>">
            </div>



            <!-- <div class="input-group">
                <input type="file" class="form-control" id="imageDamage" name="image" aria-describedby="inputGroupFile" aria-label="Upload">
            </div> -->
            <input type="submit" class="btn btn-primary" value="Submit">
            <a href="#" class="btn btn-primary">Cancel</a>
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