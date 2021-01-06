<?php
    require_once("dbconfig.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: login/login.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="logo/favicon.png">
    <title>Zircon Tech</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <p class="display-3">KVPJB Complaint Management System</p>
            <div class="list-group">
                <a href="complaints/readComplaint.php" class="list-group-item list-group-item-action" aria-current="true">Complaints</a>
                <a href="assets/main.php" class="list-group-item list-group-item-action">Assets</a>
                <a href="Rooms/roomlist.php" class="list-group-item list-group-item-action">Rooms</a>
                <a href="Blocks/blocklist.php" class="list-group-item list-group-item-action">Blocks</a>
                <a href="users/landing.php" class="list-group-item list-group-item-action" tabindex="-1" aria-disabled="true">Users</a>
            </div><br>
            
        <a href="login/logout.php" class="btn btn-warning">Logout</a>
    </div>
</body>
</html>