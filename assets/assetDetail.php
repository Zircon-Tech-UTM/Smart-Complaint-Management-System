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

    $sql = "";
    if (isset($_GET['id'])){
        $sql = "SELECT * FROM assets JOIN rooms ON a_roomID=r_roomID JOIN categories ON a_category=catID  WHERE a_assetID LIKE '%".$_GET['id']."%'";
    }
    
    $results = mysqli_query($conn, $sql); 
    $row = mysqli_fetch_array($results);
    
    if ($_SESSION['userType'] == '1')
        include("../navbar/navbar1.php");
    else if ($_SESSION['userType'] == '2')
        include("../navbar/navbarB1.php");
    else if ($_SESSION['userType'] == '3')
        include("../navbar/navbarC.php");
    else if ($_SESSION['userType'] == '4')
        include("../navbar/navbarD.php");
        
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
?> 

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language['Asset Details']; ?></title>
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
    <div class="container-fluid-float-left">
    <h3 class="text-dark mb-4" style="font-size: 40px;"><?php echo $language['Asset Information']; ?></h3>
    <div class="col">
    <div class="card shadow">
        <div class="card-body">
            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                <img src="<?php echo $row['a_img_path']; ?>" alt="<?php echo $language['no picture avaiable']; ?>">
                <table class="table my-0" id="dataTable">
                    <thead  style="color: rgb(0,0,0);">
                        <tr>
                            <th><?php echo $language['Name:']; ?></th>
                            <th><?php echo $row['a_nameBI']; ?></th>
                        </tr>
                    </thead>
                    <tbody style="color: rgb(0,0,0);">
                        <tr></tr>
                            <tr>
                                <td><strong><?php echo $language['Category']; ?></strong></td>
                                <td><?php echo $row["cat_nameBI"]; ?></td>
                            </tr>
                                <tr></tr>
                                <tr></tr>
                                    <tr>
                                        <td><strong><?php echo $language['Room:']; ?></strong></td>
                                        <td><strong><?php echo $row["r_nameBI"].""; ?><a href=""><?php //echo $row['a_roomID']; ?></a></strong></td>
                                    </tr>
                                    <tr>
                                        <td><strong><?php echo $language['Amount']; ?></strong></td>
                                        <td><?php echo $row["amount"]; ?></td>
                                    </tr>

                                    <tr>
                                        <td><strong><?php echo $language['Date Purchased']; ?></strong></td>
                                        <td><?php echo $row["date_purchased"]; ?></td>
                                    </tr>

                                    <tr>
                                        <td><strong><?php echo $language['Asset ID']; ?></strong></td>
                                        <td><?php echo $row["a_assetID"]; ?></td>
                                    </tr>

                                    <tr>
                                        <td><strong><?php echo $language['Description']; ?></strong></td>
                                        <td><?php echo $row["description"]; ?></td>
                                    </tr>

                                    <tr>
                                        <td><strong><?php echo $language['Cost']; ?></strong></td>
                                        <td><?php echo $row["cost"]; ?></td>
                                    </tr>

                                    <!-- <tr>
                                        <td><strong><?php echo $language['Mantainance']; ?></strong></td>
                                        <?php 
                                            // if($row["maintain"] == 1){
                                            //     echo "<td>".$language['Need']."</td>";
                                            // }else{
                                            //     echo "<td>".$language['No need']."</td>";
                                            // }
                        
                                        ?>
                                        
                                    </tr> -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>

        <div>
        <a href="update.php?id=<?php echo $_GET['id'];?>" class="btn btn-warning btn-sm"><?php echo $language['Edit']; ?></a>
        <?php
        if ($_SESSION["userType"] == '1' or $_SESSION["userType"] == '2'){
        ?>
        <a href="delete.php?id=<?php echo $_GET['id'];?>" style="color: rgb(14,14,14);" onclick="return confirm('<?php echo $language['Are you sure you want to delete this assets?']; ?>')" class="btn btn-danger btn-sm"><strong>X</strong></a>
        <?php
            }else{
        ?>
                <a href="delete.php?id=<?php echo $_GET['id'];?>" onclick="return confirm('<?php echo $language['Are you sure you want to delete this assets?']; ?>')" class="btn btn-danger btn-sm disabled"><strong>X</strong></a>
        <?php
            }
        ?>
        </div>
    </div>
        <a class="border rounded d-inline scroll-to-top" href="#page-top" ><i class="fas fa-angle-up"></i></a>
    </div>
</body>
</html>


<?php
    mysqli_close($conn);
    include("../navbar/navbar2.php");  
?>







