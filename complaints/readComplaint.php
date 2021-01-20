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

    $sql = "SELECT * FROM complaints JOIN users ON c_userIC = u_userIC JOIN rooms ON c_roomID=r_roomID JOIN status ON c_status = s_statusID JOIN assets ON a_assetID = c_assetID JOIN blocks on blok=block_no JOIN categories ON a_category = catID";

    if (isset($_POST["status"])){
        $sql .= " WHERE c_status LIKE '%".$_POST["status"]."%'";
    }

    if (isset($_POST["blocks"])){
        $sql .= " AND blok LIKE '%".$_POST["blocks"]."%'";
    }

    if (isset($_POST["rooms"])){
        $sql .= " AND r_roomID LIKE '%".$_POST["rooms"]."%'";
    }

    if (isset($_POST["category"])){
        $sql .= " AND a_category LIKE '%".$_POST["category"]."%'";
    }

    

    if (isset($_POST["name"])){
        $sql .= " AND (name LIKE '%".$_POST["name"]."%' or postBI LIKE '%".$_POST["name"]."%' or postBM LIKE '%".$_POST["name"]."%' or a_nameBI LIKE '%".$_POST["name"]."%' or a_nameBM LIKE '%".$_POST["name"]."%' or cat_nameBM LIKE '%".$_POST["name"]."%' or cat_nameBI LIKE '%".$_POST["name"]."%' or r_nameBM LIKE '%".$_POST["name"]."%' or r_nameBI LIKE '%".$_POST["name"]."%')";
    }else{
        $_POST["name"] = "";
    }

    $sql .= " ORDER BY compID ASC;";

    $result  = mysqli_query($conn, $sql);

    if(!$result){
        echo "ERROR: $conn->error";
        exit();
    }

    include("../navbar/navbar1.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language['Complaints']; ?></title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script> -->

</head>
<body>
    <div class="container-fluid">

        <div class="row align-items-start">
            <div class="col-md-8 col-xl-8 mb-12"><h1 class="text-primary m-0 font-weight-bold" ><?php echo $language['All Complaints List']; ?></h1></div>
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

                            <form action="readComplaint.php" method="POST">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="search by proposer or follower name" aria-label="Recipient's username" aria-describedby="button-addon2" name = "name" value="<?php echo $_POST["name"]; ?>">
                                    <button type="submit" class="btn btn-outline-secondary" type="button" id="button-addon2" style="font-size: 13px;"><?php echo $language['Search']; ?></button>
                                </div>
                            </form>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col"><?php echo $language['No']; ?></th>
                                        <th scope="col"><?php echo $language['Assets']; ?></th>
                                        <th scope="col"><?php echo $language['Location']; ?></th>
                                        <th scope="col"><?php echo $language['Proposed By']; ?></th>
                                        <th scope="col"><?php echo $language['Issue Date']; ?></th>
                                        <th scope="col"><?php echo $language['Settled Date']; ?></th>
                                        <th scope="col"><?php echo $language['Status']; ?></th>
                                        <th scope="col"><?php echo $language['Accepted by']; ?></th>
                                        <th scope="col"><?php echo $language['Action']; ?></th>

                                    </tr>
                                    <?php

                                        while($row = mysqli_fetch_array($result)){
                                            $pDate = explode(" ", $row["proposedDate"]);
                                            $sDate = explode(" ", $row["setledDate"]);
                                            
                                            echo"<tr>";
                                            echo "<th scope='row'>".$row["compID"]."</th>";

                                            echo "<td scope='row'><a href='../assets/assetDetail.php?id=".$row["a_assetID"]."'>".$row["a_nameBI"]."</a></td>";

                                            echo "<td scope='row'><a href='../Rooms/roomdetail.php?id=".$row["c_roomID"]."'>".$row["r_nameBI"]."</a></td>";

                                            echo "<td scope='row'><a href='../users/detailUser.php?id=".$row["c_userIC"]."'>".$row["name"]." (".$row["postBI"].")</a></td>";

                                            echo "<td>".$pDate[0]."</td>";

                                            echo (!empty($sDate[0]))? "<td>".$sDate[0]."</td>": "<td>-</td>";

                                            echo "<td>".$row["s_nameBI"]."</td>";

                                            $sql4 = "SELECT * FROM users WHERE u_userIC = '".$row["followedBy"]."'";
                                            $result4 = mysqli_query($conn, $sql4);
                                            $row4 = mysqli_fetch_array($result4);

                                            echo (!empty($row4["name"]))? "<td><a href='../users/detailUser.php?id=".$row["followedBy"]."'>".$row4["name"]."</a></td>" : "<td>-</td>";
                                        ?>
                                        <td>
                                            <a href="detailComplaint.php?id=<?php echo $row["compID"]; ?>" class="btn btn-info btn-sm"><?php echo $language['View']; ?></a>
                                            <a href="modifyComplaint.php?id=<?php echo $row["compID"]; ?>" class="btn btn-warning btn-sm"><?php echo $language['Edit']; ?></a>
                                            <a href="deleteComplaint.php?id=<?php echo $row["compID"]; ?>" class="btn btn-danger btn-sm"  style="color: rgb(14,14,14);" onclick="return confirm('<?php echo $language['Are you sure to delete this complaint?']; ?>')" ><strong>X</strong></a>
                                        </td>
                                    <?php
                                            echo"</tr>";
                                        }

                                        
                                    ?>
                                </thead>
                            </table>

                        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-2 col-xl-3 mb-2" id="filter" style="display: none;">
                <h2>Filter</h2>
                <div class="card shadow">
                        <div class="card-body">
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">

                                <form action="readComplaint.php" method="POST"> 

                                    <label for="status" class="form-label"><?php echo $language['Status']; ?></label>
                                    <select class="form-select" aria-label="Default select example" name="status">
                                        <option value="" selected><?php echo $language['Open menu']; ?></option>
                                        <?php
                                            $sql2 = "SELECT * FROM status";
                                            $result2 = mysqli_query($conn, $sql2);

                                            while($row2 = mysqli_fetch_array($result2)){
                                                if ($_POST['status'] == $row2['s_statusID']){
                                                    

                                                    if ($_SESSION['language'] == 'BI'){
                                                        echo "<option selected value='".$row2['s_statusID']."'>".$row2["s_nameBI"]."</option>";
                                                    }else if ($_SESSION['language'] == 'BM'){
                                                        echo "<option selected value='".$row2['s_statusID']."'>".$row2["s_nameBM"]."</option>";
                                                    }else{
                                                        echo "<option selected value='".$row2['s_statusID']."'>".$row2["s_nameBM"]."</option>";
                                                    }

                    

                                                }else{
                                                    if ($_SESSION['language'] == 'BI'){
                                                        echo "<option selected value='".$row2['s_statusID']."'>".$row2["s_nameBI"]."</option>";
                                                    }else if ($_SESSION['language'] == 'BM'){
                                                        echo "<option selected value='".$row2['s_statusID']."'>".$row2["s_nameBM"]."</option>";
                                                    }else{
                                                        echo "<option selected value='".$row2['s_statusID']."'>".$row2["s_nameBM"]."</option>";
                                                    }                                                    

                                                }
                                            }
                                        ?>
                                    </select><br>
                                    
                                    <label for="status" class="form-label"><?php echo $language['Blocks']; ?></label>
                                    <select class="form-select" aria-label="Default select example" name="blocks" id="blocks">
                                        <option value="" selected><?php echo $language['Open menu']; ?></option>
                                        <?php
                                            $sql3 = "SELECT * FROM blocks";
                                            $result3 = mysqli_query($conn, $sql3);

                                            while($row3 = mysqli_fetch_array($result3)){
                                                if ($_POST['blocks'] == $row3['block_no']){

                                                    if ($_SESSION['language'] == 'BI'){
                                                        echo "<option selected value='".$row3['block_no']."'>".$row3["b_nameBI"]."</option>";
                                                    }else if ($_SESSION['language'] == 'BM'){
                                                        echo "<option selected value='".$row3['block_no']."'>".$row3["b_nameBM"]."</option>";
                                                    }else{
                                                        echo "<option selected value='".$row3['block_no']."'>".$row3["b_nameBM"]."</option>";
                                                    }
                                                    
                                                }else{
                                                    if ($_SESSION['language'] == 'BI'){
                                                        echo "<option  value='".$row3['block_no']."'>".$row3["b_nameBI"]."</option>";
                                                    }else if ($_SESSION['language'] == 'BM'){
                                                        echo "<option  value='".$row3['block_no']."'>".$row3["b_nameBM"]."</option>";
                                                    }else{
                                                        echo "<option  value='".$row3['block_no']."'>".$row3["b_nameBM"]."</option>";
                                                    }
                                                    
                                                }
                                            }
                                        ?>
                                    </select><br>


                                    <div>
                                        <label for="rooms" class="form-label"><?php echo $language['Rooms']; ?></label><br>
                                        <select class="form-select" aria-label="Default select example" id="rooms" name="rooms">
                                            <option value="" selected><?php echo $language['Choose A Block']; ?></option>
                                            <?php
                                            if(isset($_POST["rooms"])){
                                                $sql3 = "SELECT * FROM rooms WHERE blok = '".$_POST['blocks']."';";
                                                $result3 = mysqli_query($conn, $sql3);
                                                    while ($row3 = mysqli_fetch_array($result3)){
                                                        
                                                        if ($row3['r_roomID'] == $_POST['rooms']){
                                                ?>
                                                            <option selected value="<?php echo $row3['r_roomID']; ?>">
                                                            
                                                                <?php 
                                                                    if ($_SESSION['language'] == 'BI'){
                                                                        echo $row3['r_nameBI'];
                                                                    }else if ($_SESSION['language'] == 'BM'){
                                                                        echo $row3['r_nameBM'];
                                                                    }else{
                                                                        echo $row3['r_nameBM'];
                                                                    }

                                                                ?>
                                                            </option>
                                                    <?php
                                                        }else{
                                                    ?>

                                                            <option value="<?php echo $row3['r_roomID']; ?>">
                                                                <?php 
                                                                
                                                                    if ($_SESSION['language'] == 'BI'){
                                                                        echo $row3['r_nameBI'];
                                                                    }else if ($_SESSION['language'] == 'BM'){
                                                                        echo $row3['r_nameBM'];
                                                                    }else{
                                                                        echo $row3['r_nameBM'];
                                                                    }
                                                                ?>
                                                            </option>
                                                    
                                                    <?php            
                                                            }
                                                    }
                                                    ?>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div><br>


                                    <script type="text/javascript">
                                    document.getElementById('blocks').addEventListener('change', loadRooms);

                                    function loadRooms(){
                                        let block = document.getElementById('blocks').value;

                                        let xhr = new XMLHttpRequest();
                                        xhr.open('GET', `complaintsBack/rooms.php?blocks=${block}`, true);
                                        
                                        xhr.onreadystatechange = function(){
                                            if (this.status === 200 && this.readyState === 4){
                                                let rooms = JSON.parse(this.responseText);

                                                output = '';

                                                output+= `<option value="" selected>Open this select menu</option>`;
                                                for (var i in rooms){
                                                    output+= `<option value="${rooms[i].r_roomID}">${rooms[i].r_nameBI}</option>`;
                                                }
                                                
                                                document.getElementById('rooms').innerHTML = output;
                                                
                                                loadAssets();
                                            }else if(this.status == 404){
                                                console.log('Fail');
                                            }
                                        }
                                        xhr.send();
                                    }
                                    </script>

                                    <label for="category" class="form-label"><?php echo $language['Asset Category']; ?></label>
                                    <select class="form-select" aria-label="Default select example" name="category">
                                        <option value="" selected><?php echo $language['Choose A Category']; ?></option>
                                        <?php
                                            
                                            $sql2 = "SELECT * FROM categories";
                                            $result2 = mysqli_query($conn, $sql2);

                                            while($row2 = mysqli_fetch_array($result2)){

                                                if ($_SESSION['language'] == 'BI'){
                                                    if ($_POST['category'] == $row2['catID']){
                                                        echo "<option selected value='".$row2['catID']."'>".$row2["cat_nameBI"]."</option>";
                                                    }else{
                                                        echo "<option value='".$row2['catID']."'>".$row2["cat_nameBI"]."</option>";
                                                    }
                                                }else if ($_SESSION['language'] == 'BM'){
                                                    if ($_POST['category'] == $row2['catID']){
                                                        echo "<option selected value='".$row2['catID']."'>".$row2["cat_nameBM"]."</option>";
                                                    }else{
                                                        echo "<option value='".$row2['catID']."'>".$row2["cat_nameBM"]."</option>";
                                                    }
                                                }else{
                                                    if ($_POST['category'] == $row2['catID']){
                                                        echo "<option selected value='".$row2['catID']."'>".$row2["cat_nameBM"]."</option>";
                                                    }else{
                                                        echo "<option value='".$row2['catID']."'>".$row2["cat_nameBM"]."</option>";
                                                    }
                                                }


                                            }
                                        ?>
                                    </select><br>
                                            
                                    <input type="submit" value="Apply Filter" class="btn btn-primary">
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