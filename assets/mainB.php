!<?php  
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
        if ($_SESSION["userType"] != '2'){
            exit();
        }

        if (isset($_POST['category'])){
        $sql = "SELECT * FROM assets JOIN rooms 
                ON assets.a_roomID = rooms.r_roomID 
                WHERE a_category LIKE '%".$_POST['category']."%'
                AND PIC = '".$_SESSION["ic"]."';";
        }else{
            $sql = "SELECT * FROM assets JOIN rooms 
                    ON assets.a_roomID = rooms.r_roomID
                    WHERE PIC = '".$_SESSION["ic"]."';";
        }

        echo $sql;
        $results = mysqli_query($conn, $sql); 

        $sql2 = "SELECT * FROM rooms WHERE PIC = '".$_SESSION["ic"]."';";
        $results2 = mysqli_query($conn, $sql2); 
        $row2 = mysqli_fetch_array($results2);
    ?>

    <div class="container-fluid">

        <div class="row">
        <div class="col-3">
            <br>
            <h2>Filter</h2>
            <form action="mainB.php" method="POST"> 
                <label for="category" class="form-label">Category</label>
                <select class="form-select" aria-label="Default select example" name="category">
                    <option selected value=''>Open this select menu</option>
                    <?php
                        $values = [1, 2];
                        $arr = ['ICT', 'Non ICT'];

                        foreach($values as $value){
                            if ($_POST['category'] == $value){
                                echo "<option selected value='".$value."'>".$arr[$value-1]."</option>";
                            }else{
                                echo "<option value='".$value."'>".$arr[$value-1]."</option>";
                            }
                        }
                    ?>
                </select><br>
                
                <input type="submit" value="Apply Filter" class="btn btn-primary">
                <a href="" class="btn btn-warning">Cancel</a>
            </form>
        </div>

        <div class="col-9">
            <br>
            <h2>Manage Asset in Room <?php echo $row2["r_nameBI"]; ?><a href = 'createB.php' class = 'btn btn-info'>Create Asset</a></h2>
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
                        <a href = 'updateB.php?assetID=<?php echo $row["a_assetID"]; ?>' class = 'btn btn-warning'>Edit</a>&nbsp;
                        <a href = 'delete.php?assetID=<?php echo $row["a_assetID"]; ?>' class = 'btn btn-danger'   onclick="return confirm('Are you sure you want to delete this assets?')">X</a>
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
