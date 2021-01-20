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

    $id  = "";
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }

    $sql = "SELECT * FROM complaints, rooms, blocks 
            WHERE complaints.c_roomID = rooms.r_roomID 
            AND rooms.blok = blocks.block_no  
            AND compID=".$id.";";

    $result = mysqli_query($conn, $sql);

    if (!$result){echo "ERROR:  $conn->error";
        header("refresh: 5; location: readComplaint.php");
    } 

    $row = mysqli_fetch_array($result);

    if (isset($row["c_img_path"]))
        $_SESSION["remove"] = $row["c_img_path"];

    $sql2 = "SELECT * FROM blocks;";
    $result2 = mysqli_query($conn, $sql2);

    $sql3 = "SELECT * FROM rooms WHERE blok = '".$row["blok"]."';";
    $result3 = mysqli_query($conn, $sql3);

    
    $sql4 = "SELECT * FROM assets WHERE a_roomID = '".$row['c_roomID']."';";
    $result4 = mysqli_query($conn, $sql4);
    
    include("complaintsBack/modifyPro.php");
    include("../navbar/navbar1.php");
    require_once("../dualLanguage/Languages/lang." . $_SESSION['language'] . ".php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $language['ZirconTech']; ?></title>

</head>
<style>
    .help-block{    
        color: red;
    }
    img{
        width: 200px;
        height: 200px;
    }
</style>
<body>
    <div class="container">
        <h3 class="text-dark mb-4" style="font-size: 40px;"><?php echo $language['Complaint Form']; ?></h3>

        <form action="modifyComplaint.php?id=<?php echo $id; ?>" enctype="multipart/form-data" method="POST">

            <div class="col">
                <div class="card shadow mb-3">
                    <div class="card-header py-3">
                        <p class="text-primary m-0 font-weight-bold"><?php echo $language['Complaint Detail']; ?></p>
                    </div>

                    <div class="card-body">

                        <input type="hidden" name="id" value="<?php echo $id; ?>">

                        <input type="hidden" name="u_userIC" id="complainantName" class="form-control form-control-lg" value="<?php echo $row['u_userIC']; ?>">

                        <?php
                            $datetime = strtotime($row['proposedDate']);
                            $new_date = date('Y-m-d', $datetime);
                        ?>

                        <div class="mb-3">
                            <label for="proposedDate" class="form-label <?php echo (!empty($dateErr)) ? 'is-invalid' : ''; ?>"><?php echo $language['Date:']; ?></label>
                            <input type="date" name="date" id="proposedDate" class="form-control form-control-lg" value="<?php echo $new_date; ?>">
                            <span class="help-block"><?php echo $dateErr;?></span>
                        </div>

                        <div>
                            <label for="blocks" class="form-label"><?php echo $language['Blocks']; ?></label><br>
                            <select class="form-select <?php echo (!empty($blocksErr)) ? 'is-invalid' : ''; ?>" aria-label="Default select example" id="blocks" name="blocks">
                                <option><?php echo $language['Open this select menu']; ?></option>
                                <?php
                                    while ($row2 = mysqli_fetch_array($result2)){
                                        if ($row2['block_no'] == $row['blok']){
                                            $blocks = $row2['block_no'];
                                ?>
                                        <option selected value="<?php echo $row2['block_no']; ?>">

                                            <?php
                                                if ($_SESSION['language'] == 'BI'){
                                                    echo $row2['b_nameBI'];
                                                }else if ($_SESSION['language'] == 'BM'){
                                                    echo $row2['b_nameBM'];
                                                }else{
                                                    echo $row2['b_nameBM'];
                                                }
                                            ?>
                                        </option>
                                <?php
                                        }else{
                                ?>
                                        <option value="<?php echo $row2['block_no']; ?>">
                                            <?php
                                                if ($_SESSION['language'] == 'BI'){
                                                    echo $row2['b_nameBI'];
                                                }else if ($_SESSION['language'] == 'BM'){
                                                    echo $row2['b_nameBM'];
                                                }else{
                                                    echo $row2['b_nameBM'];
                                                }                                      
                                            ?>
                                        </option>
                                <?php            
                                        }
                                    }
                                ?>
                            </select>
                            <span class="help-block"><?php echo $blocksErr;?></span>
                        </div><br>

                        <div>
                            <label for="rooms" class="form-label"><?php echo $language['Rooms']; ?></label><br>
                            <select class="form-select <?php echo (!empty($roomsErr)) ? 'is-invalid' : ''; ?>" aria-label="Default select example" id="rooms" name="rooms">
                                <option><?php echo $language['Open this select menu']; ?></option>
                                <?php
                                    while ($row3 = mysqli_fetch_array($result3)){
                                        if ($row3['blok'] == $blocks){
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
                            </select>
                            <span class="help-block"><?php echo $roomsErr;?></span>
                        </div><br>

                        <div>
                            <label for="assets" class="form-label"><?php echo $language['Assets']; ?></label><br>
                            <select class="form-select <?php echo (!empty($assetsErr)) ? 'is-invalid' : ''; ?>" aria-label="Default select example" id="assets"  name="assets">
                                <option>Open this select menu</option>
                                <?php
                                    while ($row4 = mysqli_fetch_array($result4)){
                                         if ($row4['a_assetID'] == $row['c_assetID']){
                                ?>
                                         <option selected value="<?php echo $row4['a_assetID']; ?>"><?php echo $row4['a_nameBI']; ?></option> 
                                <?php
                                         }else{
                                ?>
                                        <option value="<?php echo $row4['a_assetID']; ?>"><?php echo $row4['a_nameBI']; ?></option>
                                <?php            
                                         }
                                    }
                                ?>
                            </select>
                            <span class="help-block"><?php echo $assetsErr;?></span>
                        </div><br>

                        <script type="text/javascript">
                            document.getElementById('blocks').addEventListener('change', loadRooms);
                            document.getElementById('rooms').addEventListener('change', loadAssets);

                            function loadRooms(){
                                let block = document.getElementById('blocks').value;

                                let xhr = new XMLHttpRequest();
                                xhr.open('GET', `complaintsBack/rooms.php?blocks=${block}`, true);
                                
                                xhr.onreadystatechange = function(){
                                    if (this.status === 200 && this.readyState === 4){
                                        let rooms = JSON.parse(this.responseText);

                                        output = '';

                                        output+= `<option selected>Open this select menu</option>`;
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

                            function loadAssets(){
                                let room = document.getElementById('rooms').value;

                                let xhr = new XMLHttpRequest();
                                xhr.open('GET', `complaintsBack/assets.php?rooms=${room}`, true);
                                
                                xhr.onreadystatechange = function(){
                                    if (this.status === 200 && this.readyState === 4){
                                        let result = JSON.parse(this.responseText);
                                        console.log(result);

                                        output = '';

                                        output+= `<option selected>Open this select menu</option>`;
                                        for (var i in result){
                                            output+= `<option value="${result[i].a_assetID}">${result[i].a_nameBI}</option>`;
                                        }

                                        document.getElementById('assets').innerHTML = output;
                                    }else if(this.status == 404){
                                        console.log('Fail');
                                    }
                                }
                                xhr.send();
                            }
                        </script>

                        <div class="mb-3">
                            <label for="complainantDetail" class="form-label"><?php echo $language['Detail:']; ?></label>
                            <input type="text" name="detail" id="complainantDetail" class="form-control form-control-lg <?php echo (!empty($detailErr)) ? 'is-invalid' : ''; ?>" placeholder="complainant's detail" value="<?php echo $row['detail']; ?>">
                            <span class="help-block"><?php echo $detailErr;?></span>
                        </div>

                        <div class="form-group">
                            <label class="control-label form-label"><?php echo $language['Complaint Image']; ?></label>
                            <input class="input-group" type="file" name="image" onchange="readURL(this);" />
                            <img id="blah" src="<?php echo $row['c_img_path'];?>" alt="room image" />
                            <span class="help-block"><?php echo $errMSG;?></span>
                        </div>
                        <script>
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#blah')
                                            .attr('src', e.target.result)
                                            .width(150)
                                            .height(200);
                                    };

                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                    </div>
                </div>
            </div>
            <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>

            <input type="submit" text-align:center name="submit" onclick="return confirm('<?php echo $language['Do you want to save the changes?']; ?>')" class="btn btn-primary" value="<?php echo $language['Save']; ?>"/>
            <input type="reset" name="clear" value="<?php echo $language['Reset']; ?>"class="btn btn-warning"> 
            <a href="readComplaint.php" class="btn btn-danger float-right" "><?php echo $language['Cancel']; ?></a> 
        </form>
    </div>

    <?php
        if (!empty($sqlErr)){
    ?>
        <script>
            let error = "<?php echo $sqlErr; ?>";
            alert(error);
        </script>
    <?php
    
        }
    ?>
</body>
</html>

<?php
    include("../navbar/navbar2.php");
?>