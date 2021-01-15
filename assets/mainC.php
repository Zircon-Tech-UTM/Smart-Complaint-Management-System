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

        if (isset($_POST['rooms'])){
        $sql = "SELECT * FROM assets JOIN rooms 
                ON assets.a_roomID = rooms.r_roomID 
                WHERE a_roomID LIKE '%".$_POST['rooms']."%'";
        }else{
        $sql = "SELECT * FROM assets JOIN rooms ON assets.a_roomID = rooms.r_roomID";
        }

        if (isset($_POST['block'])){
        $sql .= " AND rooms.blok = '".$_POST["block"]."'";
        }else{
        $sql .= ";";
        }

        if ($_SESSION['userType'] == '3'){
        $sql .= " AND a_category = '1';";
        }else if ($_SESSION['userType'] == '4'){
        $sql .= " AND a_category = '2';";
        }else{
        $sql .= ";";
        }

        echo $sql;
        $results = mysqli_query($conn, $sql); 
    ?>

    <div class="container-fluid">

        <div class="row">
        <div class="col-3">
            <br>
            <h2>Filter</h2>
            <form action="mainC.php" method="POST"> 
                <label for="rooms" class="form-label">Rooms</label>
                <select class="form-select" aria-label="Default select example" name="rooms">
                    <option selected value="">Open this select menu</option>
                    <?php
                        $sql2 = "SELECT * FROM rooms";
                        $result2 = mysqli_query($conn, $sql2);

                        while($row2 = mysqli_fetch_array($result2)){
                            if ($_POST['rooms'] == $row2['r_roomID']){
                                echo "<option selected value='".$row2['r_roomID']."'>".$row2["r_nameBI"]."</option>";
                            }else{
                                echo "<option value='".$row2['r_roomID']."'>".$row2["r_nameBI"]."</option>";
                            }
                        }
                    ?>
                </select><br>

                <input type="hidden" name="block" value="<?php echo $_POST["block"]; ?>">
                
                <input type="submit" value="Apply Filter" class="btn btn-primary">
                <a href="" class="btn btn-warning">Cancel</a>
            </form>
        </div>

        <div class="col-9">
            <br>
            <h2>Manage Asset in Block <?php echo $_POST["block"]; ?></h2>
            <table class="table table-hover">
            <thead>
                <tr>
                <th>assetID</th>
                        <th>nameBI</th>
                        <th>nameBM</th>
                        <th>Category</th>
                        <!-- <th>Description</th> -->
                        <th>Cost</th>
                        <th>Rooms</th>
                        <!-- <th>Condition</th> -->
                        <!-- <th>Purchased Date</th> -->
                <th colspan="2">Action</th>
                </tr>
            </thead>
            
            <?php 
                while ($row = mysqli_fetch_array($results)) { 
            ?>
                    <tr>
                        <td><a href="assetDetail.php?id=<?php echo $row["a_assetID"]; ?>"><?php echo $row["a_assetID"]; ?></a></td> 
                        <td><?php echo $row["a_nameBI"]; ?></td>  
                        <td><?php echo $row["a_nameBM"]; ?></td>  
                        <td> 
                        <?php 
                            if($row["a_category"] == 1){
                            echo "ICT";
                            }else{
                            echo "NON ICT";
                            } 
                        ?>
                        </td> 

                        <!-- <td><?php echo $row["description"]; ?></td>   -->

                        <td><?php echo $row["cost"]; ?></td>  

                        <td><a href="../Rooms/roomdetail.php?id=<?php echo $row["a_roomID"]; ?>"><?php echo $row["r_nameBI"]; ?></a></td>  

                        <?php
                        $datetime = strtotime($row['date_purchased']);
                        $new_date = date('Y-m-d', $datetime);
                        ?>


                        <!-- <td><?php echo $new_date; ?></td>   -->
                        <td>
                        <a href = 'assetDetail.php?assetID=<?php echo $row["a_assetID"]; ?>' class = 'btn btn-warning'>View</a>&nbsp;
                        </td>      

                    </tr>
            <?php } ?>
            </table>
        </div>
        </div>
        
        
    </div>

</body>
</html>
<!--
edit_btn
del_btn
-->
