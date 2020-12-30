<?php 
    require_once("UsersBack/dbconfigUser.php");

    $sql = "SELECT * FROM users ORDER BY u_userIC ASC;";

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
    <title>Read List</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <div class="row align-items-start">
            <div class="col-8"><h1 class="display-4">Users List</h1></div>
            <div class="col-4"><a href="createUser.php" class="btn btn-primary btn-lg">Create New User</a></div>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">User IC</th>
                    <th scope="col">Position</th>
                    <th scope="col">Number of Complaints</th>
                    <th scope="col">Contact</th>
                </tr>
                <?php
                    $num=1;
                    while($row = mysqli_fetch_array($result))
                    {
                        echo"<tr>";
                        echo "<th scope='row'>".$num."</th>";
                        echo "<th>".$row["name"]."</th>";
                        echo "<th>".$row["u_userIC"]."</th>";
                        echo "<th>".$row["postBI"]."</th>";
                        echo "<th>".$row["no_aduan"]."</th>";
                        echo "<th>".$row["contact"]."</th>";
                        $num++;
                    ?>
                    <th>
                        <a href="detailUser.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-primary btn-sm">VIEW</a>
                        <a href="updateUser.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-primary btn-sm">EDIT</a>
                        <a href="deleteUser.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-primary btn-sm"><strong>X</strong></a>
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