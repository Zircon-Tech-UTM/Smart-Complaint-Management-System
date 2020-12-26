<?php 
    require_once("complaintsBack/dbconfig.php");

    $sql = "SELECT * FROM complaints ORDER BY complaintsID ASC;";

    $result  = mysqli_query($conn, $sql);

    if(!$result){
        echo "ERROR: $conn->error";
        exit();
    }
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
        <div class="row align-items-start">
            <div class="col-8"><h1 class="display-4">Complaints List</h1></div>
            <div class="col-4"><a href="newComplaint.php" class="btn btn-primary btn-lg">Create New Complaints</a></div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Complaint Type</th>
                    <th scope="col">Issue Date</th>
                    <th scope="col">Settle Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">Actions</th>
                </tr>
                <?php
                    while($row = mysqli_fetch_array($result)){
                        echo"<tr>";
                        echo "<th scope='row'>".$row["complaintsID"]."</th>";
                        echo "<th>".$row["damage"]."</th>";
                        echo "<th>".$row["pDate"]."</th>";
                        echo "<th>".$row["sDate"]."</th>";
                        echo "<th>".$row["status"]."</th>";
                    ?>
                    <th>
                        <a href="detailComplaint.php?id=<?php echo $row["complaintsID"]; ?>" class="btn btn-primary btn-sm">VIEW</a>
                        <a href="modifyComplaint.php?id=<?php echo $row["complaintsID"]; ?>" class="btn btn-primary btn-sm">EDIT</a>
                        <a href="deleteComplaint.php?id=<?php echo $row["complaintsID"]; ?>" class="btn btn-primary btn-sm"><strong>X</strong></a>
                    </th>
                <?php
                        echo"</tr>";
                    }

                    mysqli_close($conn);
                ?>
            </thead>
        </table>
    </div>
</body>
</html>