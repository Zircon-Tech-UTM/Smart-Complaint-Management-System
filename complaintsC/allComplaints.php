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
    $parameter = "";

    $sql = "SELECT * FROM complaints JOIN users ON c_userIC = u_userIC JOIN assets ON c_assetID = a_assetID JOIN rooms ON r_roomID = c_roomID JOIN status ON c_status = s_statusID JOIN categories ON a_category = catID WHERE s_statusID = '1'";

    if (isset($_GET["blocks"])){
        $sql .= " AND blok LIKE '%".$_GET["blocks"]."%'";
        $parameter.= "&blocks=".$_GET['blocks'];
    }

    if (isset($_GET["rooms"])){
        $sql .= " AND r_roomID LIKE '%".$_GET["rooms"]."%'";
        $parameter.= "&rooms=".$_GET['rooms'];
    }

    if ($_SESSION['userType'] == '3'){
        $sql .= " AND a_category = '1'";
    }else if ($_SESSION['userType'] == '4'){
        $sql .= " AND a_category = '2'";
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

    if ($_SESSION["userType"] == '3'){
        include("../navbar/navbarC.php");
      }elseif ($_SESSION["userType"] == '4'){
        include("../navbar/navbarD.php");
      }
        require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language['Pending Complaints'];?></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body>
    <script>
        $('.lang').click(function(){

                    $.ajax({
                        type: 'POST',
                        url: 'testing.php',
                        success: function(data) {
                            alert(data);
                        }
                    });
        });
    </script>

    <div class="container-fluid">

        <div class="row align-items-start">
            <div class="col-md-8 col-xl-8 mb-6"><h1 class="text-dark mb-4"><?php echo $language['Pending Complaints'];?></h1></div>
            <div class="col-md-3 col-xl-3 mb-4"><a href="acceptedComplaints.php" class="btn btn-primary btn-lg"><?php echo $language['View Accepted Complaints'];?></a></div>

            <div class="col-md-1 col-xl-1 mb-2"><button class="btn btn-success" onclick="hide()"><?php echo $language['Filter'];?></button></div>
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

                            <form action="allComplaints.php" method="GET">
                                <div class="input-group mb-3">
                                    <input type="text" class="form-control" placeholder="<?php echo $language['type here...'];?>" aria-label="Recipient's username" aria-describedby="button-addon2" name = "name" value="<?php echo $_GET["name"]; ?>">
                                    <button type="submit" class="btn btn-outline-info" type="button" id="button-addon2" style="font-size: 13px;"><?php echo $language['Search'];?></button>
                                </div>
                            </form>

                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col"><?php echo $language['Assets'];?></th>
                                        <th scope="col"><?php echo $language['Location'];?></th>
                                        <th scope="col"><?php echo $language['Proposed By'];?></th>
                                        <th scope="col"><?php echo $language['Issue Date'];?></th>
                                        <th scope="col"><?php echo $language['Status'];?></th>
                                        <th scope="col"><?php echo $language['Action'];?></th>
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
                                                    if ($_SESSION['language'] == 'BI'){
                                                        echo "<th scope='row'>".$row["a_nameBI"]."</th>";
                                                        echo "<th scope='row'>".$row["r_nameBI"]."</th>";
                                                        echo "<th scope='row'>".$row["name"]." (".$row["postBI"].")</th>";
                                                    }else if ($_SESSION['language'] == 'BM'){
                                                        echo "<th scope='row'>".$row["a_nameBM"]."</th>";
                                                        echo "<th scope='row'>".$row["r_nameBM"]."</th>";
                                                        echo "<th scope='row'>".$row["name"]." (".$row["postBM"].")</th>";
                                                    }else{
                                                        echo "<th scope='row'>".$row["a_nameBI"]."</th>";
                                                        echo "<th scope='row'>".$row["r_nameBI"]."</th>";
                                                        echo "<th scope='row'>".$row["name"]." (".$row["postBI"].")</th>";
                                                    }
                                                    echo "<th>".$pDate[0]."</th>";
                                    ?>
                                                        <th>
                                                <?php
                                                        $sql2 = "SELECT * FROM status;";
                                                        $result2 = mysqli_query($conn, $sql2);

                                                        while($row2 = mysqli_fetch_array($result2)){
                                                            if ($row['c_status'] == $row2['s_statusID']){
                                                                if ($_SESSION['language'] == 'BI'){
                                                                    echo $row2['s_nameBI'];
                                                                }else if ($_SESSION['language'] == 'BM'){
                                                                    echo $row2['s_nameBM'];
                                                                }else{
                                                                    echo $row2['s_nameBI'];
                                                                }
                                                            }
                                                        }

                                                ?>
                                                        </th>
                                                        
                                                        <th>
                                                        <a href='complaintsBack\acceptPro.php?comp_id=<?php echo $row["compID"]; ?>' class='btn btn-success' onclick="return confirm('Are you sure you want to accept this request?')"><?php echo $language['Accept'];?></a>
                                                        </th>
                                                    <th>
                                                        <a href="detailComplaint.php?id=<?php echo $row["compID"]; ?>" class="btn btn-info"><?php echo $language['View'];?></a>
                                                    </th>
                                    <?php
                                            echo"</tr>";
                                            }
                                        }
                                    }  
                                    ?>
                                </thead>
                            </table>

                        </div>
                    </div>
                </div>
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
                                                    ?>"><?php echo $language['Previous'];?></a></li>
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
                                                                            
                                                                    ?>"><?php echo $language['Next'];?></a>
                                </li>
            </ul>
        </nav>

            </div>

            <div class="col-md-3 col-xl-3 mb-3" id="filter"  style="display: none;">
                <div class="card shadow">
                    <div class="card-body">
                        <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">

                            <form action="allComplaints.php" method="GET"> 

                                <label for="status" class="form-label"><?php echo $language['Blocks'];?></label>
                                <select class="form-select" aria-label="Default select example" name="blocks" id="blocks">
                                    <option value="" selected><?php echo $language['Open this select menu'];?></option>
                                    <?php
                                        $sql3 = "SELECT * FROM blocks";
                                        $result3 = mysqli_query($conn, $sql3);

                                        while($row3 = mysqli_fetch_array($result3)){
                                            if ($_GET['blocks'] == $row3['block_no']){
                                                if ($_SESSION['language'] == 'BI'){
                                                    echo "<option selected value='".$row3['block_no']."'>".$row3["b_nameBI"]."</option>";
                                                }else if ($_SESSION['language'] == 'BM'){
                                                    echo "<option selected value='".$row3['block_no']."'>".$row3["b_nameBM"]."</option>";
                                                }else{
                                                    echo "<option selected value='".$row3['block_no']."'>".$row3["b_nameBI"]."</option>";
                                                }
                                            }else{
                                                if ($_SESSION['language'] == 'BI'){
                                                    echo "<option value='".$row3['block_no']."'>".$row3["b_nameBI"]."</option>";
                                                }else if ($_SESSION['language'] == 'BM'){
                                                    echo "<option value='".$row3['block_no']."'>".$row3["b_nameBM"]."</option>";
                                                }else{
                                                    echo "<option value='".$row3['block_no']."'>".$row3["b_nameBI"]."</option>";
                                                }
                                            }
                                        }
                                    ?>
                                </select><br>


                                <div>
                                    <label for="rooms" class="form-label"><?php echo $language['Rooms'];?></label><br>
                                    <select class="form-select" aria-label="Default select example" id="rooms" name="rooms">
                                        <option value="" selected><?php echo $language['Please Choose A Block'];?></option>
                                        <?php
                                        if(isset($_GET["rooms"])){
                                            $sql3 = "SELECT * FROM rooms WHERE blok = '".$_GET['blocks']."';";
                                            $result3 = mysqli_query($conn, $sql3);
                                                while ($row3 = mysqli_fetch_array($result3)){
                                                    if ($row3['r_roomID'] == $_GET['rooms']){
                                            ?>
                                                    <option selected value="<?php echo $row3['r_roomID']; ?>"><?php echo $row3['r_nameBI']; ?></option>
                                            <?php
                                                    }else{
                                            ?>
                                                    <option value="<?php echo $row3['r_roomID']; ?>"><?php echo $row3['r_nameBI']; ?></option>
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

                                            let lang = "<?php echo $_SESSION["language"]; ?>";

                                            output = '';
                                            
                                            if (lang === "BI"){
                                                output+= `<option value="" selected>Open this select menu</option>`;
                                                for (var i in rooms){
                                                    output+= `<option value="${rooms[i].r_roomID}">${rooms[i].r_nameBI}</option>`;
                                                }
                                            }else{
                                                output+= `<option value="" selected>Tunjuk menu</option>`;
                                                for (var i in rooms){
                                                    output+= `<option value="${rooms[i].r_roomID}">${rooms[i].r_nameBM}</option>`;
                                                }
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
                                        
                                <input type="submit" value="<?php echo $language['Apply'];?>" class="btn btn-primary">
                                <a href="allComplaints.php" class="btn btn-warning"><?php echo $language['Cancel'];?></a>
                            </form>

                        </div>
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