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
    
    if (isset($_GET['id'])){
        $sql = "SELECT * FROM assets JOIN rooms ON a_roomID=r_roomID JOIN categories ON a_category=catID  WHERE a_assetID LIKE '%".$_GET['id']."%'";
    }
    
    $results = mysqli_query($conn, $sql); 
    $row = mysqli_fetch_array($results);
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assets Main Page</title>
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
        <h1 class="display-3"><?php echo $row['a_nameBI']; ?></h1>

        <img src="<?php echo $row['a_img_path']; ?>" alt="no picture avaiable">

        <p class="display-7">Category: <?php echo $row["cat_nameBI"]; ?></p>

        <p class="display-7">Room: <strong><?php echo $row["r_nameBI"]."("; ?><a href=""><?php echo $row['a_roomID']; ?></a>)</strong></p>

        
    </div>

</body>
</html>
<!--
edit_btn
del_btn
-->
