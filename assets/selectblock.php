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
    
    if (($_SESSION["userType"] != '1') and ($_SESSION["userType"] != '3')){
        echo $_SESSION["userType"];
        exit();
    }
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

<body>
    <!-- displays a confirmation message to tell the user that a new record has been created in the database -->
    
    <?php 
        $sql = "SELECT * FROM blocks;";

        // echo $sql;
        $results = mysqli_query($conn, $sql); 
    ?>

    <div class="container">
        <h1>Select a block before viewing the assets of that block</h1>

        <?php
            echo $_SESSION['userType'];
            if ($_SESSION['userType'] == '1'){
                $action = "mainA.php";
            } else {
                $action = "mainC.php";
            }
        ?>

        <form action="<?php echo $action; ?>" method="POST">
            <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" name="block">
            <option selected>Open this select menu</option>
                <?php
                    while($row = mysqli_fetch_array($results)){
                ?>
                    <option value="<?php echo $row["block_no"]; ?>"><?php echo $row["b_nameBI"]; ?></option>
                <?php
                    }
                ?>  
            </select>

            <input type="submit" value="View" class="btn btn-info">       
        </form>
        
    </div>

</body>
</html>
<!--
edit_btn
del_btn
-->
