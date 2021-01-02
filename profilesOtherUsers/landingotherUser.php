<?php

    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../loginlogout/login.php');
    }
    require_once("../CRUDusers/UsersBack/dbconfigUser.php");
     if(isset($_GET['id']))
    {
        $id = $_GET['id'];
        $sql = "SELECT * FROM users WHERE u_userIC=".$id.";";

        $result = mysqli_query($conn, $sql);

        if (!$result)
        {
          echo "ERROR:  $conn->error";
          exit();
        } 
        $row = mysqli_fetch_array($result);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing For Other Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <h1>Landing For Other Users</h1>
        <a href="editprofile.php?id=<?php echo $row["u_userIC"]; ?>" class="btn btn-info">View Profile</a>
        <a href="../loginlogout/logout.php" class="btn btn-info">Logout</a>    
    </div>
</body>
</html>

<?php
}
?>