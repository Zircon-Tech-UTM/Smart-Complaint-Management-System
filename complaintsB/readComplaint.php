<?php 
    require_once("../dbconfig.php");
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../../login/login.php');
    }

    if ($_SESSION["userType"] != '2'){
        exit();
    }

    $parameter = "";

    $sql = "SELECT * FROM complaints JOIN users ON c_userIC = u_userIC JOIN rooms ON PIC = u_userIC JOIN assets ON a_assetID = c_assetID JOIN status ON c_status = s_statusID JOIN categories ON a_category = catID  WHERE u_userIC = '".$_SESSION['ic']."'";

    if (isset($_GET["status"])){
        $sql .= " AND c_status LIKE '%".$_GET["status"]."%'";
        $parameter.= "status=".$_GET['status'];
    }

    if (isset($_GET["category"])){
        $sql .= " AND a_category LIKE '%".$_GET["category"]."%'";
        $parameter.= "&category=".$_GET['category'];
    }

    if (isset($_GET["name"])){
        $sql .= " AND (name LIKE '%".$_GET["name"]."%' or postBI LIKE '%".$_GET["name"]."%' or postBM LIKE '%".$_GET["name"]."%' or a_nameBI LIKE '%".$_GET["name"]."%' or a_nameBM LIKE '%".$_GET["name"]."%' or cat_nameBM LIKE '%".$_GET["name"]."%' or cat_nameBI LIKE '%".$_GET["name"]."%' or r_nameBM LIKE '%".$_GET["name"]."%' or r_nameBI LIKE '%".$_GET["name"]."%')";
        $parameter.= "&name=".$_GET['name'];
    }else{
        $_GET["name"] = "";
    }

    $sql .= " ORDER BY compID ASC;";

    $result  = mysqli_query($conn, $sql);

    if(!$result){
        echo "ERROR: $conn->error";
        exit();
    }
    include("../navbar/navbarB1.php");
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ZirconTech</title>
</head>
<body>
<div class="container-fluid">

        <div class="row align-items-start">
            <div class="col-md-8 col-xl-8 mb-12"><h1 class="text m-0 font-weight-bold" ><?php echo $language['All Complaints']; ?></h1></div>
            <!-- style = "text-align: center;" -->
            <!-- <div class="col-md-8 col-xl-8 mb-6"><h1 class="text-dark mb-4">All Complaints List</h1></div> -->
            <div class="col-md-3 col-xl-3 mb-4"><a href="createComplaint.php" class="btn btn-primary btn-lg"><?php echo $language['New Complaint']; ?></a></div>

            <div class="col-md-1 col-xl-1 mb-2"><button class="btn btn-success" onclick="hide()"><?php echo $language['Filter']; ?></button></div>
        </div>

        <script>
            function hide() {
                var x = document.getElementById("filter");
                if (x.style.display === "none") {
                    x.style.display = "block";
                } else {
                    x.style.display = "none";
                }
            }
        </script>

        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">

                            <form action="readComplaint.php" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="<?php echo $language["type here..."]; ?>" aria-label="Recipient's username" aria-describedby="button-addon2" name = "name" value="<?php echo $_GET["name"]; ?>">
                                    <button type="submit" class="btn btn-outline-dark" type="button" id="button-addon2" style="font-size: 13px;"><?php echo $language['Search']; ?></button>
                                </div>
                            </form>

                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col"><?php echo $language['No']; ?></th>
                                    <th scope="col"><?php echo $language['Proposed By']; ?></th>
                                    <th scope="col"><?php echo $language['Issue Date']; ?></th>
                                    <th scope="col"><?php echo $language['Settled Date']; ?></th>
                                    <th scope="col"><?php echo $language['Status']; ?></th>
                                    <th scope="col"><?php echo $language['Accepted by']; ?></th>
                                    <th scope="col"><?php echo $language['Action']; ?></th> <!--yc add-->
                                    </tr>
                                    <?php
                                        if(isset($_GET["page"])){
                                            $pageNum = $_GET["page"] - 1;
                                        }else{
                                            $pageNum = 1 - 1;
                                        }

                                        
                                        $initItemNum = 5 * $pageNum + 1;
                                        $finalItemNum = 5* $pageNum + 5;

                                        $numOfRows = mysqli_num_rows($result);
                                        $numOfPages = ceil($numOfRows / 5);
                                        $counter = 0;

                                        if ($numOfRows > 0) {
                                            while($row = mysqli_fetch_array($result)){
                                                $counter++;
                                                if($counter >= $initItemNum && $counter <= $finalItemNum){
                                                    $pDate = explode(" ", $row["proposedDate"]);
                                                    $sDate = explode(" ", $row["setledDate"]);
                                                    echo"<tr>";
                                                    echo "<th scope='row'>".$row["compID"]."</th>";
                                                    echo "<th scope='row'>".$row["name"]." (".$row["postBI"].")</th>";
                                                    echo "<th>".$pDate[0]."</th>";
                                                    echo "<th>".$sDate[0]."</th>";
                                                    echo "<th>".$row["s_nameBI"]."</th>";
                                                    echo "<th>".$row["followedBy"]."</th>";
                                        ?>
                                        <th>
                                            <a href="detailComplaint.php?id=<?php echo $row["compID"]; ?>" class="btn btn-info btn-sm"><?php echo $language['View']; ?></a>
                                            <a href="modifyComplaint.php?id=<?php echo $row["compID"]; ?>" class="btn btn-warning btn-sm"><?php echo $language['Edit']; ?></a>
                                            <a href="deleteComplaint.php?id=<?php echo $row["compID"]; ?>" style="color: rgb(14,14,14);" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this room?')"><strong>X</strong></a>
                                        </th>
                                    <?php
                                            echo"</tr>";
                                            }
                                        }
                                    }

                                    ?>
                                </thead>
                            </table>

                        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
                    </div>
                </div>
                 <!-- Pager -->
        <nav aria-label="Page navigation news">
            <ul class="pagination justify-content-end flex-wrap">
                <li class="page-item <?php if ($_GET['page'] == 1 || !isset($_GET['page'])) 
                                                echo "disabled"; ?>">

                    <a class="page-link" href="<?php echo (!empty($parameter))? "?".$parameter."&" : '?'; ?>page=<?php if (isset($_GET['page'])){
                                                                if ($_GET["page"] == 1)
                                                                    echo  $_GET["page"];
                                                                else 
                                                                    echo  $_GET["page"] - 1;
                                                                }else{
                                                                    echo "1";
                                                                }
                                                    ?>">Previous</a></li>
                                <?php
                                    for ($i = 1 ; $i <= $numOfPages ; $i++){ 
                                ?>
                                        <li class="page-item">
                                            <a class="page-link" href="<?php echo (!empty($parameter))? "?".$parameter."&" : '?'; ?>page=<?php echo $i; ?>"><?php echo $i; ?></a>
                                        </li>
                                <?php
                                    }
                                ?>
                                <li class="page-item <?php if($_GET['page'] == $numOfPages)
                                                        echo "disabled"; ?>">
                                    <a class="page-link" href="<?php echo (!empty($parameter))? "?".$parameter."&" : '?'; ?>page=<?php if (isset($_GET['page'])){
                                                                                if($_GET["page"] + 1 > $numOfPages)
                                                                                    echo  $_GET["page"];
                                                                                else 
                                                                                    echo  $_GET["page"]+1;
                                                                            }else{
                                                                                echo "2";
                                                                            }
                                                                            
                                                                    ?>">Next</a>
                                </li>
            </ul>
        </nav>
            </div>

            <div class="col-md-2 col-xl-3 mb-2" id="filter" style="display: none;">
                <h2>Filter</h2>
                <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">

                                <form action="readComplaint.php" method="GET"> 
                                <h2><?php echo $language['Filter']; ?></h2>
                                    <form action="readComplaint.php" method="GET"> 
                                        <label for="status" class="form-label"><?php echo $language['Status']; ?></label>
                                        <select class="form-select" aria-label="Default select example" name="status">
                                            <option value="" selected><?php echo $language['Open menu']; ?></option>
                                            <?php
                                                $sql2 = "SELECT * FROM status";
                                                $result2 = mysqli_query($conn, $sql2);

                                                while($row2 = mysqli_fetch_array($result2)){
                                                    if ($_GET['status'] == $row2['s_statusID']){
                                                                        

                                                        if ($_SESSION['language'] == 'BI'){
                                                            echo "<option selected value='".$row2['s_statusID']."'>".$row2["s_nameBI"]."</option>";
                                                        }else if ($_SESSION['language'] == 'BM'){
                                                            echo "<option selected value='".$row2['s_statusID']."'>".$row2["s_nameBM"]."</option>";
                                                        }else{
                                                            echo "<option selected value='".$row2['s_statusID']."'>".$row2["s_nameBM"]."</option>";
                                                        }

                                                    }else{
                                                        if ($_SESSION['language'] == 'BI'){
                                                            echo "<option value='".$row2['s_statusID']."'>".$row2["s_nameBI"]."</option>";
                                                        }else if ($_SESSION['language'] == 'BM'){
                                                            echo "<option value='".$row2['s_statusID']."'>".$row2["s_nameBM"]."</option>";
                                                        }else{
                                                            echo "<option value='".$row2['s_statusID']."'>".$row2["s_nameBM"]."</option>";
                                                        }                                                    

                                                    }
                                                }
                                            ?>
                                        </select><br>

                                        <label for="category" class="form-label"><?php echo $language['Asset Category']; ?></label>
                                        <select class="form-select" aria-label="Default select example" name="category">
                                            <option value="" selected><?php echo $language['Open menu']; ?></option>
                                            <?php
                                                $sql2 = "SELECT * FROM categories";
                                                $result2 = mysqli_query($conn, $sql2);

                                                while($row2 = mysqli_fetch_array($result2)){

                                                    if ($_SESSION['language'] == 'BI'){
                                                        if ($_GET['category'] == $row2['catID']){
                                                            echo "<option selected value='".$row2['catID']."'>".$row2["cat_nameBI"]."</option>";
                                                        }else{
                                                            echo "<option value='".$row2['catID']."'>".$row2["cat_nameBI"]."</option>";
                                                        }
                                                    }else if ($_SESSION['language'] == 'BM'){
                                                        if ($_GET['category'] == $row2['catID']){
                                                            echo "<option selected value='".$row2['catID']."'>".$row2["cat_nameBM"]."</option>";
                                                        }else{
                                                            echo "<option value='".$row2['catID']."'>".$row2["cat_nameBM"]."</option>";
                                                        }
                                                    }else{
                                                        if ($_GET['category'] == $row2['catID']){
                                                            echo "<option selected value='".$row2['catID']."'>".$row2["cat_nameBM"]."</option>";
                                                        }else{
                                                            echo "<option value='".$row2['catID']."'>".$row2["cat_nameBM"]."</option>";
                                                        }
                                                    }
                                                }
                                            ?>
                                        </select><br>
                                                
                                        <input type="submit" value="<?php echo $language['Apply']; ?>" class="btn btn-primary">
                                        <a href="readComplaint.php" class="btn btn-warning"><?php echo $language['Cancel']; ?></a>
                                </form>

                            </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
</body>
</html>
<?php
    mysqli_close($conn);
    include("../navbar/navbar2.php");
?>
