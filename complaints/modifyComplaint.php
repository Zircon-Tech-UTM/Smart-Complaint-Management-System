<?php
    require_once("complaintsBack\dbconfig.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM complaints WHERE complaintsID=".$id.";";

        $result = mysqli_query($conn, $sql);

        if (!$result){echo "ERROR:  $conn->error";
            header("refresh: 6; location: readComplaint.php");
        } 

        $row = mysqli_fetch_array($result);
    
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
            <div class="mb-3">
                <label for="complainantName" class="form-label">Name:</label>
                <input type="text" name="name" id="complainantName" class="form-control form-control-lg" placeholder="complainant's name" value="dummy">
            </div>

            <div>
                <label for="proposeDate" class="form-label">Proposed Date:</label>
                <input type="date" name="pdate" id="proposeDate" value="<?php echo $row["pDate"]; ?>">
            </div><br>

            <div>
                <label for="settledDate" class="form-label">Settled Date:</label>
                <input type="date" name="sdate" id="settledDate" value="<?php echo $row["sDate"]; ?>">
            </div><br>

            <div>
                <label for="radio" class="form-label">Buildings Category</label><br>
                <?php 
                    $temps = ["Asrama", "Kolej"];
                    $i = 1;
                    foreach($temps as $temp){
                        echo "<div class='form-check form-check-inline'>";

                        $str = "radio.$i";
                        if ($row["buildingID"] == $i){
                            echo "<input type='radio' value=".$i." class='form-check-input' id='$str' name='building' checked>";
                            echo "<label for='$str' class='form-check-label'>$temp</label>";
                        } else {
                            echo "<input type='radio' value=".$i." class='form-check-input' id='$str' name='building'>";
                            echo "<label for='$str' class='form-check-label'>$temp</label>";
                        }
                        echo "</div>";
                        $i++;
                    }
                ?>
            </div><br>

            <div>
                <label for="check" class="form-label">Location</label>
                <select name="location" id="check" class="form-select form-select-lg mb-3" aria-label="form-select-lg example">
                <option value="">Choose an option</option>
                <?php 
                    $temps = ["Block A", "Block B", "Block C", "Block M", "Block N", "Block R", "Block S", "Main Hall", "Others"];
                    $i = 1;
                    foreach($temps as $temp){
                        if ($row["roomID"] == $i){
                            echo "<option value='$i' selected>$temp</option> ";
                        } else {
                            echo "<option value='$i'>$temp</option> ";
                        }
                        $i++;
                    }
                ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="roomtName" class="form-label">Room Name:</label>
                <input type="text" name="room" id="roomName" class="form-control form-control-lg" placeholder="Name of the Room" value="dummy">
            </div>

            <div class="mb-3">
                <label for="check2" class="form-label">Type of Damage</label>
                <select name="damage" id="check2" class="form-select form-select-lg mb-3" aria-label="form-select-lg example">
                    <option value="" selected>Choose an option</option>
                    <?php 
                        $temps = ["Door", "Glass", "Light", "Fan", "Toilet"];
                        $i = 1;
                        foreach($temps as $temp){
                            if ($row["damage"] == $i){
                                echo "<option value='$i' selected>$temp</option> ";
                            } else {
                                echo "<option value='$i'>$temp</option> ";
                            }
                            $i++;
                        }
                    ?>
                    <!-- type of damages -->
                </select>
            </div>

            <div>
                <label for="totalDamage" class="form-label">Total</label>
                <input type="text" name="total" id="totalDamage" class="form-control" placeholder="Total Number of Damages" value="<?php echo $row["total"]; ?>">
            </div><br>

            <div class="mb-3">
                <label for="complainantDetail" class="form-label">Detail:</label>
                <input type="text" name="detail" id="complainantDetail" class="form-control form-control-lg" placeholder="complainant's detail" value="<?php echo $row["detail"]; ?>">
            </div>
            
            <input type="hidden" name="id" value="<?php echo $id; ?>">

            <div class="mb-3">
                <label for="check3" class="form-label">Status</label>
                <select name="status" id="check3" class="form-select form-select-lg mb-3" aria-label="form-select-lg example">
                    <option value="" selected>Choose an option</option>
                    <?php 
                        $temps = [0, 1, 2];
                        $i = 0;
                        foreach($temps as $temp){
                            if ($row["status"] == $i){
                                echo "<option value='$i' selected>$temp</option> ";
                            } else {
                                echo "<option value='$i'>$temp</option> ";
                            }
                            $i++;
                        }
                    ?>
                    <!-- type of damages -->
                </select>
            </div>

            <!-- <div class="input-group">
                <input type="file" class="form-control" id="imageDamage" name="image" aria-describedby="inputGroupFile" aria-label="Upload">
            </div> -->
            <input type="submit" class="btn btn-primary" value="Save Changes">
            <a href="readComplaint.php" class="btn btn-primary">Cancel</a>
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