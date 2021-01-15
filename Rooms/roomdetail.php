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

    if ($_SESSION["userType"] != '1'){
        exit();
    }

    if (isset($_GET['id'])){
        $rid = $_GET['id'];
    }

    $sql = "SELECT * FROM rooms
        JOIN blocks
        ON rooms.blok = blocks.block_no
        JOIN users
        ON PIC = u_userIC
        WHERE r_roomID = '".$rid."'";

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms Detail</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<style>
    img{
        width: 500px;
        height: 500px;
    }
</style>
<body>
    <div class="container">
        <h1 class="display-3"><?php echo $row['r_nameBI']; ?></h1>

        <img src="<?php echo $row['r_img_path']; ?>" alt="no picture avaiable">

        <p class="display-7">Room ID: <strong><?php echo $row['r_roomID']; ?></strong></p>
        <p class="display-7">Block:  <strong><?php echo $row['blok']; ?></strong></p>


        <p class="display-7">Assets: <a href="roomassets.php?id=<?php echo $row["r_roomID"]; ?>">CLICK HERE</a></p>
        <p class="display-7">PIC: <a href="../users/detailUser.php?id=<?php echo $row["u_userIC"]; ?>"><strong><?php echo $row['name']; ?></strong></a> </strong></p>

    </div>
</body>
</html>