<?php
    require_once("complaintsBack\dbconfig.php");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM complaints WHERE complaintsID=".$id.";";

        $result = mysqli_query($conn, $sql);

        if ($result){
            $row = mysqli_fetch_array($result);
?>          


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zircon Tech</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1><strong>Complaints ID: </strong><?php echo $row["complaintsID"];?></h1>
        <span>Building: </span><p><?php echo $row["buildingID"];?></p>
        <span>Room: </span><p><?php echo $row["roomID"];?></p>

        <ul class="list-inline">
            <li class="list-inline-item"><p class="lead">Proposed Date: </p><p><?php echo $row["pDate"];?></p></li>
            <li class="list-inline-item"></li>
            <li class="list-inline-item">
                <p class="lead">Settled Date: </p><p><?php if(empty($row["sDate"])){echo "-";} else {echo $row["sDate"];}?></p>
            </li>
        </ul>
        
        
        <p>Damage Type: <?php echo $row["damage"];?></p>
        <p>Total: <?php echo $row["total"];?></p>
        <p>Status: <?php echo $row["status"];?></p>

        <a href="modifyComplaint.php?id=<?php echo $id; ?>" class="btn btn-primary btn-sm">EDIT</a>
        <a href="deleteComplaint.php?id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Delete</a>
    </div>
</body>
</html>



<?php
        } else{
            echo "ERROR:  $conn->error";
            header("refresh: 6; location: readComplaint.php");
        }

    } else {
        echo "ERROR Occur! Will direct back to the same page in 5 seconds";
        header("refresh: 6; location: readComplaint.php");
    }
    mysqli_close($conn);
?>