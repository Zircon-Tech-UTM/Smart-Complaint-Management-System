<?php 
    require_once("../dbconfig.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../../login/login.php');
    }

    if ($_SESSION["userType"] != '2'){
        exit();
    }

    $sql = "SELECT * FROM complaints JOIN users ON c_userIC = u_userIC JOIN rooms ON PIC = u_userIC WHERE u_userIC = '".$_SESSION['ic']."' ORDER BY compID ASC;";

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
            <div class="col-4"><a href="createComplaint.php" class="btn btn-primary btn-lg">Create New Complaints</a></div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Proposed By</th>
                    <th scope="col">Issue Date</th>
                    <th scope="col">Settle Date</th>
                    <th scope="col">Status</th>
                    <th scope="col">followed by</th>
                </tr>
                <?php

                    while($row = mysqli_fetch_array($result)){
                        $pDate = explode(" ", $row["proposedDate"]);
                        $sDate = explode(" ", $row["setledDate"]);
                        
                        echo"<tr>";
                        echo "<th scope='row'>".$row["compID"]."</th>";
                        echo "<th scope='row'>".$row["c_userIC"]." (".$row["postBI"].")</th>";
                        echo "<th>".$pDate[0]."</th>";
                        echo "<th>".$sDate[0]."</th>";
                        echo "<th>".$row["c_status"]."</th>";
                        echo "<th>".$row["followedBy"]."</th>";
                    ?>
                    <th>
                        <a href="detailComplaint.php?id=<?php echo $row["compID"]; ?>" class="btn btn-primary btn-sm">VIEW</a>
                        <a href="modifyComplaint.php?id=<?php echo $row["compID"]; ?>" class="btn btn-primary btn-sm">EDIT</a>
                        <a href="deleteComplaint.php?id=<?php echo $row["compID"]; ?>" class="btn btn-primary btn-sm"><strong>X</strong></a>
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