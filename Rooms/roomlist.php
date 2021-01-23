<?php 
    if(!session_id())//if session_id is not found
    {
        session_start();
    }
    
    if(isset($_SESSION['u_userIC']) != session_id() )
    {
        header('location: ../login/login.php');
    }

    require_once("../dbconfig.php");

    if ($_SESSION["userType"] != '1'){
        exit();
    }

    $sql1 = "SELECT * FROM users WHERE u_userIC=".$_SESSION['ic'].";";

    $result1 = mysqli_query($conn, $sql1);

    if (!$result1)
    {
        echo "ERROR:  $conn->error";
        header("refresh: 5; location: ../dashboard.php");
    } 

    $row1 = mysqli_fetch_array($result1);

    $parameter = "";

    if (isset($_GET['blocks'])){
        $sqlr = "SELECT * FROM rooms
        JOIN blocks
        ON rooms.blok = blocks.block_no
        JOIN users
        ON PIC = u_userIC
        WHERE blok LIKE '%".$_GET['blocks']."%'";

    $parameter.= "blocks=".$_GET['blocks'];
    }else{
        $sqlr = "SELECT * FROM rooms
        JOIN blocks
        ON rooms.blok = blocks.block_no
        JOIN users
        ON PIC = u_userIC";
    }
    $resultr = mysqli_query($conn, $sqlr);
    include ('..\navbar\navbar1.php');    
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $language["ROOMS' LIST"];?></title>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>        
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
            <div class="col-md-5 col-xl-10 mb-12"><h1 class="text m-0 font-weight-bold" style = "text-align: center;"><?php echo $language["ROOMS' LIST"];?></h1></div>
            <div class="col-md-5 col-xl-2 mb-12 d-flex justify-content-center"><a href="createroom.php" class="btn btn-primary" style="font-size=17px"><?php echo $language['New Room'];?></a></div>
        </div>
        <br>
        <h3><?php echo $language['Filter'];?></h3>
        <form action="" method="GET"> 
        <label for="blocks" class="form-label"><?php echo $language['Blocks'];?></label>
        <div class = "row">
            <div class="col-md-5 col-lg-5 col-xl-3 mb-12">                
                    <select class="form-select" aria-label="Default select example" name="blocks">
                        <option value="" selected><?php echo $language['Open this select menu'];?></option>
                        <?php
                            $sql2 = "SELECT * FROM blocks";
                            $result2 = mysqli_query($conn, $sql2);

                            while($row2 = mysqli_fetch_array($result2)){
                                if ($_GET['blocks'] == $row2['block_no']){
                                    if ($_SESSION['language'] == 'BI'){
                                        echo "<option selected value='".$row2['block_no']."'>".$row2["b_nameBI"]."</option>";
                                    }else if ($_SESSION['language'] == 'BM'){
                                        echo "<option selected value='".$row2['block_no']."'>".$row2["b_nameBM"]."</option>";
                                    }else{
                                        echo "<option selected value='".$row2['block_no']."'>".$row2["b_nameBI"]."</option>";
                                    }
                                }else{
                                    if ($_SESSION['language'] == 'BI'){
                                        echo "<option value='".$row2['block_no']."'>".$row2["b_nameBI"]."</option>";
                                    }else if ($_SESSION['language'] == 'BM'){
                                        echo "<option value='".$row2['block_no']."'>".$row2["b_nameBM"]."</option>";
                                    }else{
                                        echo "<option value='".$row2['block_no']."'>".$row2["b_nameBI"]."</option>";
                                    }
                                }
                            }
                        ?>
                    </select>
            </div>
            <div class="col-md-5 col-lg-5 col-xl-3 mb-12 d-flex justify-content-center">                         
                <input type="submit" value="<?php echo $language['Apply'];?>" class="btn btn-primary">&nbsp      
                <a href="?" class="btn btn-warning"><?php echo $language['Cancel'];?></a>             
            </div>
        </div>
        </form><br>
        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                    <table class="table my-0" id="dataTable">
                        <thead>
                            <tr>
                                <th><?php echo $language['Room ID'];?></th>
                                <th><?php echo $language["Room's Name(English)"];?></th>
                                <th><?php echo $language["Room's Name(Malay)"];?></th>
                                <th><?php echo $language['Blocks'];?></th>
                                <th><?php echo $language['PIC Of Room'];?></th>
                                <th><?php echo $language['Assets'];?></th>
                                <th><?php echo $language['Action'];?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($_GET["page"])){
                                    $pageNum = $_GET["page"] - 1;
                                }else{
                                    $pageNum = 1 - 1;
                                }


                                $initItemNum = 5 * $pageNum + 1;
                                $finalItemNum = 5* $pageNum + 5;

                                $numOfRows = mysqli_num_rows($resultr);
                                $numOfPages = ceil($numOfRows / 5);
                                $counter = 0;
                                $counter = 0;
                                if ($numOfRows > 0) {

                                    while($rowr = mysqli_fetch_array($resultr))
                                    {
                                        $counter++;
                                        if($counter >= $initItemNum && $counter <= $finalItemNum){
                                            echo "<tr>";
                                                
                            ?>                                
                                        <td><?php echo $rowr['r_roomID']; ?></a></td>

                                            <?php 
                                                echo "<td><a href = 'roomdetail.php?id=".$rowr['r_roomID']."'>".$rowr['r_nameBI']."</a></td>";
                                                echo "<td>".$rowr['r_nameBM']."</td>";
                                                echo "<td>".$rowr['blok']."</td>";

                                                echo "<td>";
                                                    echo "<a href = '../users/detailUser.php?id=".$rowr["u_userIC"]."'>".$rowr['name']."</a>&nbsp";
                                                echo "</td>";

                                                echo "<td>";
                                                    echo "<a href = 'roomassets.php?id=".$rowr["r_roomID"]."'>"."Link"."</a>&nbsp";
                                                echo "</td>";
                                            ?>
                                                <td>
                                                <a href = 'roommodify.php?id=<?php echo $rowr['r_roomID'];?>' class="btn btn-warning btn-sm" type="button" style="color: rgb(6,6,6);font-size: 17px;"><?php echo $language['Edit'];?></a>              
                                                <a href = "roomcancel.php?id=<?php echo $rowr['r_roomID']; ?>" class="btn btn-danger btn-sm" type="button" style="color: rgb(14,14,14);font-size: 17px;" onclick="return confirm('<?php echo $language['Are you sure to delete this room?']; ?>')"><strong>X</strong></a>
                            <?php                
                                                echo "</td>";
                                                echo "</tr>";
                                        }                            
                                    }
                                }
                            ?>     
                        </tbody>
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
    <div>
    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
<?php include ('..\navbar\navbar2.php');?>