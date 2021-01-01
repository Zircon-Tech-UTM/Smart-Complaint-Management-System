<?php
    require_once("UsersBack\dbconfigUser.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../loginlogout/login.php');
    }

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE u_userIC=".$id.";";

        $result = mysqli_query($conn, $sql);

        if ($result){
            $row = mysqli_fetch_array($result);
?>          

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">

        <h1><strong>Username: </strong><?php echo $row["u_userIC"];?></h1>
        
        <?php $EndingDate=date('Y-m-d h:i:s', strtotime('+1 year', strtotime($row["dateRegistered"])) ); ?> 

        <p>Name: <?php echo $row["name"];?></p>
        <p>IC: <?php echo $row["u_userIC"];?></p>
        <p>Position: <?php echo $row["postBI"];?></p>
        <p>Contact: <?php echo $row["contact"];?></p>
        <p>Registered Date: <?php echo $row["dateRegistered"];?></p>
        <p>Ending Date: <?php echo $EndingDate;?></p>
        <p>Number of Complaints: <?php echo $row["no_aduan"];?></p>
        <p>Address: <?php echo $row["address"];?></p>
        <h2>User Contact Section:</h2>
        <p>Contact: <?php echo $row["contact"];?></p>
        <p>Email Addrses: <?php echo $row["email"];?></p>

        <a href="updateUser.php?id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Edit</a>
        <a href="deleteUser.php?id=<?php echo $id; ?>" class="btn btn-primary btn-sm">Delete</a>
    </div>
</body>
</html>



<?php
        } else{
            echo "ERROR:  $conn->error";
            header("refresh: 6; location: readUser.php");
        }

    } else {
        echo "ERROR Occur! Will direct back to the same page in 5 seconds";
        header("refresh: 6; location: readUser.php");
    }
    mysqli_close($conn);
?>